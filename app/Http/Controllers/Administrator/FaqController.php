<?php

namespace App\Http\Controllers\Administrator; //admin add

use App\Http\Requests;
use App\Http\Controllers\Controller;   // using controller class
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\PaymentGatwaySetting;
use App\Models\Faq;
use App\Models\Category;
use DB;
use MongoDB\BSON\ObjectId;
use URL;
use File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class FaqController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth.admin:admin');
    }
    public function index()
    {
        // dd('pppp');
        return view('administrator.faqs.index');
    }
    //get list of record of subadmin...........................................................
    public function getfaqData(Request $request)
    {
        $requestData = $request->toArray();
        $columns = array(
            // column index  => database column name
            0 => 'faqs.id',
            1 => 'faqs.banned',
            2 => 'faqs.title',
            3 => 'faqs.description',
            // 3 => 'banners.position',
        );

        $totalItems = Faq::get()->count();
        $totalFiltered = $totalItems;
        $items = Faq::where('id', '!=', 0);

        $searchString = str_replace("%", "zzempty", $requestData['search']['value']);
        $searchString = str_replace("'", "\'", $searchString);
        if (!empty($requestData['search']['value'])) {
            $items->whereRaw("title LIKE '%" . $searchString . "%'")->orWhereHas('main_category', function ($query) use ($searchString) {
                $query->whereRaw("categories.name  LIKE '%" . $searchString . "%'");
            });
            $totalFiltered = Slider::whereRaw("title LIKE '%" . $searchString . "%'")->orWhereHas('main_category', function ($query) use ($searchString) {
                $query->whereRaw("categories.name  LIKE '%" . $searchString . "%'");
            })->get()->count();
        }

        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];

        $items = $items->offset($offset)->limit((int)$limit)->orderBy($orderColumn, $orderColumnDir)->get();
        $data = array();
        $i = $offset;
        foreach ($items as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = strip_tags($item->title);
            $nestedData[] = strip_tags($item->description);

            $nestedData[] = $item->created_at->format('F d, Y');
            if ($item->banned == 1) {
                $class = "on";
                $title = "active";
            } else {
                $class = "off";
                $title = "inactive";
            }
            $deleteLink = '<a href="' . URL::to('/') . '/administrator/faq/delete/' . $item->id . ' " title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            $editLink = '<a href="' . URL::to('/') . '/administrator/faq/faq-edit/' . $item->id . ' " title="Edit"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>';
            $activateLink = '<a href="' . URL::to('/') . '/administrator/faq/update-status/' . $item->id . '" title="' . $title . '"><i class=" btn btn-primary fa fa-toggle-' . $class . '" aria-hidden="true" ></i></a>';
            $nestedData[] = $activateLink . " | " . $editLink . " | " . $deleteLink;
            $data[] = $nestedData;
        }
        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalItems),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    public function add_faq()
    {
        return view('administrator.faqs.create');
    }
    public function add_instruction()
    {
        $data = DB::table('instructions')->first();
        return view('administrator.faqs.instuctioncreate', compact('data'));
    }
    public function add_notice()
    {
        $data = DB::table('notices')->first();
        return view('administrator.faqs.notice_create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $sliderData = array(
            'title' => $request->input('title'),
            'description' => $request->input('description'),

            // 'position' =>$request->input('position'),

        );
        // dd($sliderData);
        // die();
        $rules = array(
            'title' => 'required',
            'description' => 'required',
            // 'position'=>'required|unique:banners',


        );

        $validator = Validator::make($sliderData, $rules);
        if ($validator->fails()) {
            return redirect('administrator/faq/add-faq')->withInput()->withErrors($validator);
        } else {
            $slider = new Faq($request->all());
            //$slider['type'] = 'slider';
            //Upload Image

        }
        $slider->save();

        // redirect
        Session::flash('success_message', 'Your Faq has been added successfully');
        return redirect('/administrator/faq/faq-list');
    }
    public function store_instruction(Request $request)
    {
        // dd($request->all());
        $sliderData = array(
            'description' => $request->input('description'),

            // 'position' =>$request->input('position'),

        );
        // dd($sliderData);
        // die();
        $rules = array(
            'description' => 'required',
            // 'position'=>'required|unique:banners',


        );

        $validator = Validator::make($sliderData, $rules);
        if ($validator->fails()) {
            return redirect('administrator/add-instruction')->withInput()->withErrors($validator);
        } else {
            $slider = DB::table('instructions')->where('id', 1)->update($sliderData);
        }

        // redirect
        Session::flash('success_message', 'Your Instruction has been Updated successfully');
        return redirect('/administrator/add-instruction');
    }
    public function store_Notice(Request $request)
    {
        // dd($request->all());
        $sliderData = array(
            'description' => $request->input('description'),

            // 'position' =>$request->input('position'),

        );
        // dd($sliderData);
        // die();
        $rules = array(
            'description' => 'required',
            // 'position'=>'required|unique:banners',


        );

        $validator = Validator::make($sliderData, $rules);
        if ($validator->fails()) {
            return redirect('administrator/add-notice')->withInput()->withErrors($validator);
        } else {
            $slider = DB::table('notices')->where('id', 1)->update($sliderData);
        }

        // redirect
        Session::flash('success_message', 'Your Notice has been Updated successfully');
        return redirect('/administrator/add-notice');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        // get the testimonial
        $plans = $this->model->findOrFail($id);


        // show the view and pass the nerd to it
        return view('admin.plans.show')
            ->with('plans', $plans);
    }

    /**
     * Match FAQ by route id (Mongo ObjectId hex, BSON ObjectId, or string _id in BSON).
     */
    private function findFaqByRouteId($id): ?Faq
    {
        if ($id === null || $id === '') {
            return null;
        }

        $id = preg_replace('/[\x{200B}-\x{200D}\x{FEFF}]/u', '', rawurldecode(trim((string) $id)));
        if ($id === '') {
            return null;
        }

        $faq = Faq::find($id);
        if ($faq) {
            return $faq;
        }

        $faq = Faq::where('_id', $id)->first();
        if ($faq) {
            return $faq;
        }

        if (preg_match('/^[a-f\d]{24}$/i', $id)) {
            try {
                $faq = Faq::where('_id', new ObjectId($id))->first();
                if ($faq) {
                    return $faq;
                }
            } catch (\Throwable $e) {
                // invalid ObjectId
            }

            $doc = Faq::raw(function ($collection) use ($id) {
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
                    return (new Faq)->newFromBuilder($attrs);
                }
            }
        }

        return null;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit_faq($id)
    {
        $slider = $this->findFaqByRouteId($id);
        if (!$slider) {
            abort(404, 'FAQ not found.');
        }

        return view('administrator.faqs.edit')->with(['slider' => $slider]);
    }


    public function updatefaq($id, Request $request)
    {
        $slider = $this->findFaqByRouteId($id);
        if (!$slider) {
            Session::flash('error_message', 'FAQ not found.');

            return redirect('administrator/faq/faq-list');
        }

        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'description' => 'required',


            ],
            [
                'title.required' => 'This field is required.',
                'description.required' => 'This field is required.',

            ]
        );

        if ($validator->fails()) {
            return redirect('/administrator/faq/faq-edit/' . $id)->withInput()->withErrors($validator);
        }

        $slider->fill($request->only(['title', 'description']));
        $slider->save();

        Session::flash('success_message', 'Faq Successfully updated');

        return redirect('administrator/faq/faq-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {
        $slider = Faq::findOrFail($id);
        if (!empty($slider->delete())) {
            Session::flash('success_message', 'Faq has been deleted successfully!');
        } else {
            Session::flash('error_message', 'Unable to delete the Faq');
        }
        return redirect('/administrator/faq/faq-list');
    }
    public function update_status($id = null)
    {
        $faq = Faq::find($id);

        if ($faq) {
            $faq->banned = $faq->banned == 1 ? 0 : 1;
            $faq->save();
            Session::flash('success_message', 'Status has been updated successfully!');
        } else {
            Session::flash('error_message', 'Unable to update status');
        }

        return redirect('/administrator/faq/faq-list');
    }

    /**
     * @return mixed
     */
}
