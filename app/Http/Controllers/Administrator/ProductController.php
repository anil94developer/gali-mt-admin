<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserCoin;
use App\Models\Point;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Market;
use App\Models\BlockUser;
use App\Models\BonusReport;
use Session;
use Redirect;
use URL;
use Hash;
use DB;
use App\Helpers\Helper;

class ProductController extends Controller
{
    public function __construct()
    {

    }
 
    public function index()
    {
        return view('administrator.product.index');
    }

    public function create()
    {
        return view('administrator.product.create');
    }


    public function store(Request $request)
    {
        // dd($request->all());
    
            $validator = Validator::make($request->all(), [
             
                'name' => 'required',
                'description' => 'required',
                'amount' => 'required',
                'sale_price' => 'required',
               
               
               
                ]);
    
                if ($validator->fails()) {
                    return redirect('administrator/product-create')->withInput()->withErrors($validator);
                }
               
                $insert = new Product;
                $insert->name = $request->name;
                $insert->description = $request->description;
                $insert->amount = $request->amount;
                $insert->sale_price = $request->sale_price;
               
    
               

                $image = $request->file('product_image');
                if($image) {
                    $path_original = public_path() . '/public/backend/uploads/product';
                    $file = $request->product_image;
                    $photo_name = time() . '-' . $file->getClientOriginalName();
                    $file->move($path_original, $photo_name);
                    $insert->product_image = $photo_name;
                }
    
                $insert->save();
    
                 return Redirect::to('administrator/product');
            
    }
    

    public function getproductData(Request $request)
    {
        // dd($request->all());    
         
         $requestData = $_REQUEST;
        $total = Product::count();
		$feedback = Product::whereNotNull('id')->orderBy('created_at', 'desc');
        // dd($requestData['search']['value']);
		// if ($requestData['search']['value']) {
		// 	$feedback = $feedback->where('name', 'like', '%' . $requestData['search']['value'] . '%');
		// }
		// if ($request->orderBy) {
		// 	$feedback = $feedback->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
		// }
		$feedback = $feedback->paginate($request->limit ? $request->limit : 20);
		$i = 0;
		$datas = [];
		foreach ($feedback as $item) {
			$i++;
			$nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $item->name;
            $img=empty($item->product_image) ? '':$item->product_image;
            //    dd($item->description);
               // $nestedData[] = '<img src="'.asset('/backend/uploads/brands/'.$item->image).'" alt="category" width="80px">';
                $nestedData[] = '<img src="' . URL::to('/') . '/public/backend/uploads/product/'.$img.'" height="100" width="150">';
            $nestedData[] = $item->description;
            $nestedData[] = $item->amount;
            $nestedData[] = $item->sale_price;

         
            
        

            $editLink = '<a href="' .url('/administrator/product/edit/'.$item->id).'" title="Edit"><button class="btn btn-warning btn-icon-anim btn-circle"><i class="fa fa-pencil"></i></button></a>';
             $deleteLink = '<a href="' .url('/administrator/sub-admin/delete/'.$item->id).' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info btn-icon-anim btn-circle"><i class="icon-trash"></i></button></a>';
            $ViewLink = '<a href="' . url('/administrator/product/view/' . $item->id) . ' " title="View"><button class="btn btn-primary btn-icon-anim btn-circle"><i class="fa fa-eye"></i></button></a>';

            $nestedData[] = $ViewLink." ". $editLink."  ".$deleteLink;
			$datas[] = $nestedData;
    }

    return [
        'data' => $datas,
        'total' => intval($total),
        "recordsTotal" => intval($total),
        "recordsFiltered" => intval($total),
        'draw' => $request['draw']
    ];
    }



    public function view($id)
    {
        // get the testimonial
        $plans = Product::findOrFail($id);
        // show the view and pass the nerd to it
        return view('administrator.product.show')
            ->with('plans', $plans);
    }


    public function edit($id)
    {
        //$Package = Package::first();
        $slider = Product::find($id);
        return view('administrator.product.edit')->with(['slider' => $slider]);
    }


    public function edit_store($id, Request $request)
    {
        // validate
        $slider = Product::find($id);
        $validator = Validator::make(
            $request->all(),
            [
                
                'name' => 'required',
                'description' => 'required',
                'amount' => 'required',
                'sale_price' => 'required',

            ]
        );

        if ($validator->fails()) {
            return redirect('/administrator/product/edit/' . $id)->withInput()->withErrors($validator);
        } else {

            if ($slider) {
                $data = $request->all();

                $update_data = Product::find($slider->id)->fill($data);

                $update_data->update();
            }


            // redirect
            Session::flash('success_message', 'Product Successfully updated');
            return redirect('administrator/product');
        }
    }


}