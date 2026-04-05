<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\User;
use App\Models\UserCoin;
use App\Models\Point;
use App\Models\ScannerPayment;
use Session;
use Hash;
use DB;
use URL;
use App\Helpers\Helper;
use MongoDB\BSON\ObjectId;

class ScannerPaymentController extends Controller
{
    public function __construct()
    {
    }

    /*-------Show List Page ---------*/
    public function index()
    {
        return view('administrator.scanner_payment.index');
    }

    public function Get_ScannerpaymentData(Request $request)
    {
        $requestData = $_REQUEST;
        $total = ScannerPayment::count();
        $Market = ScannerPayment::whereNotNull('_id')->orderBy('id', 'desc');
        if ($requestData['search']['value']) {
            $Market = $Market->where('title', 'like', '%' . $requestData['search']['value'] . '%')->orWhere('id', 'like', '%' . $requestData['search']['value'] . '%');
        }
        if ($request->orderBy) {
            $Market = $Market->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $Market = $Market->paginate($request->limit ? $request->limit : 20);
        $i = 0;
        $datas = [];
        foreach ($Market as $item) {
            $i++;
            $nestedData = array();
            $routeId = (string) $item->getKey();
            $imageUrl = $this->paymentQrImageUrl($item->image);
            $nestedData[] = $i;
            $nestedData[] = $item->title;
            $nestedData[] = '<img src="' . $imageUrl . '" height="100" width="150">';

            if ($item->status) {
                $message = "'Are you sure you want to Inactive the Banner Status?'";
                $nestedData[] = '<a href="' . url('/administrator/update-qr-code-status/' . $routeId) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            } else {
                $message = "'Are you sure you want to Active the Banner Status?'";
                $nestedData[] = '<a href="' . url('/administrator/update-qr-code-status/' . $routeId) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            }

            $editLink = '<a href="' . url('/administrator/edit-qr-code/' . $routeId) . '" title="Edit"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>';
            $deleteLink = '<a href="' . url('/administrator/delete-qr-code/' . $routeId) . '" onclick="return confirm(\'Are you sure want to delete?\')" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            $ViewLink = '<a href="' . url('/administrator/qr-code-details/' . $routeId) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
            $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink;
            // $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink . " " . $result . " " . $history;
            $datas[] = $nestedData;
        }
        ;

        return [
            'data' => $datas,
            'total' => intval($total),
            "recordsTotal" => intval($total),
            "recordsFiltered" => intval($total),
            'draw' => $request['draw']
        ];
    }


    public function Add_qrcode()
    {
        return view('administrator.scanner_payment.add_qrcode');
    }

    public function StoreQrcode(Request $request)
    {
        $validator = Validator::make($request->only(['title']), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('add_qrcode')->withErrors($validator)->withInput();
        }

        if (!$request->hasFile('image')) {
            return redirect()->route('add_qrcode')->withErrors(['image' => 'Image is required.'])->withInput();
        }

        // dd($request->all());
        $insert = new ScannerPayment;
        $insert->title = $request->title;
        // $insert->slug = str_slug($request->title, "-");
        // $insert->status = $request->status;

        if ($request->hasFile('image')) {
            $photo_name = $this->storePaymentQrImage($request->file('image'));
            if (!$photo_name) {
                return redirect()->route('add_qrcode')->withErrors(['image' => 'Invalid or unsupported image file.'])->withInput();
            }
            $insert->image = $photo_name;
            $insert->status = 1;
        }

        $insert->save();

        return redirect()->route('scanner_payment')->with('success_message', 'One New Qr Code has been created successfully.');
    }


    /**
     * Resolve scanner_payment row by route id (Mongo ObjectId hex vs string _id in BSON).
     */
    private function findScannerPaymentByRouteId($id): ?ScannerPayment
    {
        if ($id === null || $id === '') {
            return null;
        }

        $id = preg_replace('/[\x{200B}-\x{200D}\x{FEFF}]/u', '', rawurldecode(trim((string) $id)));
        if ($id === '') {
            return null;
        }

        $row = ScannerPayment::find($id);
        if ($row) {
            return $row;
        }

        $row = ScannerPayment::where('_id', $id)->first();
        if ($row) {
            return $row;
        }

        if (preg_match('/^[a-f\d]{24}$/i', $id)) {
            try {
                $row = ScannerPayment::where('_id', new ObjectId($id))->first();
                if ($row) {
                    return $row;
                }
            } catch (\Throwable $e) {
                // invalid ObjectId
            }

            $doc = ScannerPayment::raw(function ($collection) use ($id) {
                try {
                    return $collection->findOne(
                        ['$or' => [
                            ['_id' => $id],
                            ['_id' => new ObjectId($id)],
                        ]],
                        ['typeMap' => ['root' => 'array', 'document' => 'array', 'array' => 'array']]
                    );
                } catch (\Throwable $e) {
                    return null;
                }
            });

            if ($doc !== null) {
                $attrs = is_array($doc) ? $doc : json_decode(json_encode($doc), true);
                if (is_array($attrs) && isset($attrs['_id'])) {
                    return (new ScannerPayment)->newFromBuilder($attrs);
                }
            }
        }

        return null;
    }

    /**
     * Store QR upload without Symfony MIME guessing (avoids ext-fileinfo requirement on some hosts).
     */
    private function storePaymentQrImage(UploadedFile $file): ?string
    {
        if ($file->getError() !== UPLOAD_ERR_OK) {
            return null;
        }

        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $ext = strtolower($file->getClientOriginalExtension());
        if (!in_array($ext, $allowed, true)) {
            return null;
        }

        $dir = public_path('backend/uploads/Payment_qrcode');
        if (!is_dir($dir) && !@mkdir($dir, 0755, true) && !is_dir($dir)) {
            return null;
        }

        $original = $file->getClientOriginalName();
        $safe = preg_replace('/[^a-zA-Z0-9._-]/', '_', basename($original));
        if ($safe === '' || $safe === '.' || $safe === '..') {
            $safe = 'upload.' . $ext;
        }
        $photo_name = uniqid('qr-', true) . '-' . $safe;
        $dest = $dir . DIRECTORY_SEPARATOR . $photo_name;

        $tmp = $file->getPathname();
        if (is_uploaded_file($tmp)) {
            return move_uploaded_file($tmp, $dest) ? $photo_name : null;
        }
        if (@rename($tmp, $dest)) {
            return $photo_name;
        }
        if (@copy($tmp, $dest)) {
            return $photo_name;
        }

        return null;
    }

    private function paymentQrImagePath($image): string
    {
        return public_path('backend/uploads/Payment_qrcode/' . (string) $image);
    }

    private function paymentQrImageUrl($image): string
    {
        $image = (string) $image;
        $url = url('backend/uploads/Payment_qrcode/' . rawurlencode($image));
        $path = $this->paymentQrImagePath($image);

        if ($image !== '' && is_file($path)) {
            return $url . '?v=' . filemtime($path);
        }

        return $url;
    }

    private function deletePaymentQrImage($image): void
    {
        $image = (string) $image;
        if ($image === '') {
            return;
        }

        $path = $this->paymentQrImagePath($image);
        if (is_file($path)) {
            @unlink($path);
        }
    }

    public function update_qrcode_status($id)
    {
        $selectedPayment = $this->findScannerPaymentByRouteId($id);

        if ($selectedPayment) {
            $selectedPayment->status = $selectedPayment->status == 1 ? 0 : 1;
            $selectedPayment->save();
            ScannerPayment::where('_id', '!=', $selectedPayment->_id)->update(['status' => 0]);
            Session::flash('success_message', 'Status has been updated successfully!');
        } else {
            Session::flash('error_message', 'Unable to update status');
        }

        return redirect()->back();
    }

    public function Qr_Code_Edit($id)
    {
        $select = $this->findScannerPaymentByRouteId($id);
        if (!$select) {
            abort(404, 'QR code not found.');
        }

        return view('administrator.scanner_payment.edit_qrcode', compact('select'));
    }


    public function Qr_code_Update(Request $request)
    {
        // dd($request->all());

        // Do not pass uploaded file into Validator::make($request->all()) — that can trigger Symfony MIME guessing.
        $validator = Validator::make($request->only(['title']), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $row = $this->findScannerPaymentByRouteId($request->input('markets_id'));
        if (!$row) {
            return redirect()->route('scanner_payment')->with('error_message', 'QR code not found.');
        }

        $insert['title'] = $request->title;
        if ($request->hasFile('image')) {
            $photo_name = $this->storePaymentQrImage($request->file('image'));
            if (!$photo_name) {
                return redirect()->back()->withErrors(['image' => 'Invalid or unsupported image file.'])->withInput();
            }
            $oldImage = $row->image;
            $insert['image'] = $photo_name;
        }

        $row->update($insert);

        if (isset($oldImage) && $oldImage !== $row->image) {
            $this->deletePaymentQrImage($oldImage);
        }

        return redirect()->route('scanner_payment')->with('success_message', 'Qr Code updated successfully.');
    }

    public function viewQrcodeDetails($id)
    {
        $select = $this->findScannerPaymentByRouteId($id);
        if (!$select) {
            abort(404, 'QR code not found.');
        }

        return view('administrator.scanner_payment.viewqrcodeDetails', compact('select'));
    }

    public function delete_Qr_Code($id)
    {
        //   dd('dasds');
        if ($select = $this->findScannerPaymentByRouteId($id)) {
            $this->deletePaymentQrImage($select->image);
            $select->delete();
            Session::flash('success_message', 'One Qr Code has been deleted successfully!');
        } else {
            Session::flash('error_message', 'Please Try Again!');
        }
        return redirect()->back();
    }

}