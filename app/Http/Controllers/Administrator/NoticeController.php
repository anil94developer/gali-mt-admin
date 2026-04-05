<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserCoin;
use App\Models\Point;
use App\Models\Admin;
use App\Models\Market;
use App\Models\Notice;
use App\Models\AppNotice;
use App\Models\BonusReport;
use Session;
use Hash;
use DB;
use App\Helpers\Helper;
use MongoDB\BSON\ObjectId;

class NoticeController extends Controller
{
    public function __construct()
    {
    }

    /*-------Show List Page ---------*/
    public function index()
    {
        return view('administrator.notice.index');
    }
    public function add_notice()
    {
        return view('administrator.notice.add_notice');
    }
    public function getNoticeData(Request $request)
    {
        $requestData = $_REQUEST;
        $total = Notice::count();
        $Market = Notice::whereNotNull('_id')->orderBy('_id', 'desc');
        if ($requestData['search']['value']) {
            $Market = $Market->where('description', 'like', '%' . $requestData['search']['value'] . '%');
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
            $nestedData[] = $i;
            $nestedData[] = $item->description;
            // $nestedData[] = date("d-m-Y h:i a", strtotime($item->created_at));
            // if ($item->status) {
            //     $message = "'Are you sure you want to Inactive the user?'";
            //     $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            // } else {
            //     $message = "'Are you sure you want to Active the user?'";
            //     $nestedData[] = '<a href="' . url('/administrator/update-status/' . $item->id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            // }
            $result = '<a href="' . url('/administrator/result/' . $item->_id) . '" title="Result"><button class="btn btn-primary ">Open Result</button></a>';
            $resultclose = '<a href="' . url('/administrator/result-close/' . $item->_id) . '" title="Result"><button class="btn btn-primary ">Close Result</button></a>';
            $history = '<a href="' . url('/administrator/market/history/') . '" title="History"><button class="btn btn-warning ">History</button></a>';

            $editLink = '<a href="' . url('/administrator/notice-edit/' . $item->_id) . '" title="Edit Notice"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>';
            $deleteLink = '<a href="' . url('/administrator/delete-data/' . $item->_id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            // $ViewLink = '<a href="' . url('/administrator/user/view/' . $item->id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
            $nestedData[] = $editLink. "  " . $deleteLink .  "<br><br> ";
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
    function edit_notice_data($id)
    {
        $description = Notice::where('_id', $id)->first();      
        return view('administrator.notice.edit', compact('description'));
    }

    public function StoreNoticeData(Request $request)
    {
         $this->validate($request, [
                'description'=>'required',
                
            ]
        );
         $template= Notice::where('_id',$request->id)->update(['description'=>$request->description]);        
        return redirect()->route('notice_list')->with('success_message', 'Notice has been updated successfully.');
    }

    public function DeleteNotice(Request $request)
    {
        // dd('Hello');
        $notice = Notice::findOrFail($request->id);
        $notice->delete();
        return redirect('administrator/notice-list')->with('success_message', 'Notice has been Delete successfully.');
    }

    public function store(Request $request)
    {
         $this->validate($request, [
                'description'=>'required',
                
            ]
        );

        $record= new Notice();

        $record->description = request('description');

        $record->save();

        // $data = 'description'= $request->description
        //  $template= Notice::new([]);        
        return redirect()->route('notice_list')->with('success_message', 'Notice has been Add successfully.');
    }

    public function app_index()
    {
        return view('administrator.notice.app_index');
    }

    public function getAppNoticeData(Request $request)
    {
        $requestData = $_REQUEST;
        $total = AppNotice::count();
        $Market = AppNotice::whereNotNull('_id')->orderBy('id', 'desc');
        if ($requestData['search']['value']) {
            $Market = $Market->where('description', 'like', '%' . $requestData['search']['value'] . '%');
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
            $nestedData[] = $i;
            $nestedData[] = $item->title;
            $nestedData[] = $item->description;
            // $nestedData[] = date("d-m-Y h:i a", strtotime($item->created_at));
            if ($item->is_display==1) {
                $message = "'Are you sure you want to not display the notice ?'";
                $nestedData[] = '<a href="' . url('/administrator/update-is-disaplay/' . $item->_id) . '" onclick="return confirm(' . $message . ')" title="Active"><i class="fa fa-toggle-on"></i></a>';
            } else {
                $message = "'Are you sure you want to display the notice ?'";
                $nestedData[] = '<a href="' . url('/administrator/update-is-disaplay/' . $item->_id) . '" onclick="return confirm(' . $message . ')" title="Inactive"><i class="fa fa-toggle-off"></i></a>';
            }
            $result = '<a href="' . url('/administrator/result/' . $item->_id) . '" title="Result"><button class="btn btn-primary ">Open Result</button></a>';
            $resultclose = '<a href="' . url('/administrator/result-close/' . $item->_id) . '" title="Result"><button class="btn btn-primary ">Close Result</button></a>';
            $history = '<a href="' . url('/administrator/market/history/') . '" title="History"><button class="btn btn-warning ">History</button></a>';

            $editLink = '<a href="' . url('/administrator/app-notice-edit/' . $item->_id) . '" title="Edit Notice"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>';
            $deleteLink = '<a href="' . url('/administrator/delete-data/' . $item->_id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            // $ViewLink = '<a href="' . url('/administrator/user/view/' . $item->id) . ' " title="View"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';
            $nestedData[] = $editLink.  "<br><br> ";
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

    /**
     * Match AppNotice by route id (Mongo ObjectId hex, BSON ObjectId, or string _id in BSON).
     * jenssegers where('_id', $hex) can miss documents when _id is stored as a string vs ObjectId.
     */
    private function findAppNoticeByRouteId($id): ?AppNotice
    {
        if ($id === null || $id === '') {
            return null;
        }

        $id = preg_replace('/[\x{200B}-\x{200D}\x{FEFF}]/u', '', rawurldecode(trim((string) $id)));
        if ($id === '') {
            return null;
        }

        $notice = AppNotice::find($id);
        if ($notice) {
            return $notice;
        }

        $notice = AppNotice::where('_id', $id)->first();
        if ($notice) {
            return $notice;
        }

        if (preg_match('/^[a-f\d]{24}$/i', $id)) {
            try {
                $notice = AppNotice::where('_id', new ObjectId($id))->first();
                if ($notice) {
                    return $notice;
                }
            } catch (\Throwable $e) {
                // invalid ObjectId
            }

            $doc = AppNotice::raw(function ($collection) use ($id) {
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
                    return (new AppNotice)->newFromBuilder($attrs);
                }
            }
        }

        return null;
    }

    function edit_app_notice_data($id)
    {
        $app_description = $this->findAppNoticeByRouteId($id);
        if (!$app_description) {
            abort(404, 'App notice not found.');
        }

        return view('administrator.notice.app_edit', compact('app_description'));
    }

    public function StoreAppNoticeData(Request $request)
    {
         $this->validate($request, [
                'description'=>'required',                
            ]
        );

        $notice = $this->findAppNoticeByRouteId($request->id);
        if (!$notice) {
            return redirect()->route('app_notice_list')->with('error_message', 'App notice not found.');
        }

        $notice->description = $request->description;
        $notice->save();

        return redirect()->route('app_notice_list')->with('success_message', 'App Notice has been updated successfully.');
    }

    public function update_is_display($id)
    {
        $notice = AppNotice::find($id);

        if ($notice) {
            $notice->is_display = $notice->is_display == 1 ? 0 : 1;
            $notice->save();

            Session::flash('success_message', 'is_display has been updated successfully!');
        } else {
            Session::flash('error_message', 'Notice not found.');
        }

        return redirect()->back();
    }
}