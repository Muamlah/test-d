<?php

namespace App\Http\Controllers;

use App\Http\Resources\Eservices\EservicesCollection;
use App\Traits\FirebaseTrait;
use App\Models\{eservices, SearchedWord, eservices_orders, sections, Settings,PublicOrder};
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Fees;
use App\Models\Favorite;
use App\Traits\FeesTrait;
use App\Models\User;
use Auth;
use App\Traits\CommonTrait;

class EservicesController extends Controller
{
    use FirebaseTrait,CommonTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function __construct()
//    {
//        // PREMISSIONS MIDDLEWARE
//
//        $this->middleware('auth:admin');
//        $this->middleware('permission:READ_ELECTRONIC_SERVICES' , ['only' => ['list']]);
//        $this->middleware('permission:CREATE_ELECTRONIC_SERVICES' , ['only' => ['create', 'store']]);
//        $this->middleware('permission:UPDATE_ELECTRONIC_SERVICES' , ['only' => ['edit', 'update']]);
//
//    }

    public function webdetails($slug)
    {
        // dd(12);
        $id=request()->id;
            $status             = Settings::getSetting('eservices_orders_status');
        if ($status != 'active') {
            return view('website.passive');
        }
        // $settings               = Settings::query()->first();
        // $electronic_user_count  = eservices_orders::where('user_id', Auth::id())->whereDate('created_at', '=', Carbon::today()->toDateString())->count();

        // if ($electronic_user_count >= $settings->electronic_order_limit) {
        //     abort(401);
        // }

        $eservices          = eservices::findorfail($id);
        $views              = $eservices->views;
        $eservices->views   = $views + 1;
        $eservices->save();

//        $fees =  \Cache::rememberForever('fees',  function () {
//            return Fees::first();
//          });
//        $e_fees                             = ($eservices->price / 100 * $fees['service_client_fees']);
//        $value_added_tax                    = (($fees['value_added_tax'] /100) * ($eservices->price / 100 * $fees['service_client_fees']) );
//        $total_amount                       = $eservices->price + $e_fees +  $value_added_tax;
//        $total_cost                         = $total_amount;

//        if(!empty(auth()->user())){
//            $users                              = User::findorfail(Auth::id());
//            $net                                = $users->available_balance - $total_cost;
//            return view('website/eservices/details', compact('eservices','net'));
//        }
        return view('website/eservices/details', compact('eservices'));

    }

    public function shareCount(Request $request)
    {

        $status                 = Settings::getSetting('eservices_orders_status');
        if ($status != 'active') {
            return '';
        }

        $eservices          = eservices::findorfail($request->eservice_id);
        $shares             = $eservices->shares;
        $eservices->shares  = $shares + 1;
        $eservices->save();

    }

    public function databysection($id)
    {
        $eservices = eservices::where('section_id', $id)->orderBy('updated_at', 'DESC')->paginate('10');
        $section = sections::findorfail($id);
        $electronic_user_count = 0;
        if(auth()->check()){
            $electronic_user_count=eservices_orders::where('user_id',auth()->id())->
                  whereDate('created_at', '=', Carbon::today()->toDateString())->count();
        }
        return view('website.eservices.services_by_section', compact('eservices', 'section', 'electronic_user_count'));
    }

//    public function ajaxlist($last_id){
//
//        $eservices = eservices::where('id','>',$last_id)->orderby('id','asc')->get();
//
//        $num = $eservices->count();
//      //  dd(session()->get('a')." and count is ".$num);
//
//     //   session()->forget('a');
//
//       // dd($eservices);
//
//        if(session()->get('a') == null) {
//
//         for($i=1;$i<=10;$i++) {
//            session()->put('a','0');
//
//       session()->put('output','<div class="card card-style">
//                <div class="content">
//                    <div class="d-flex mb-4">
//                        <div class="align-self-center">
//                            <span class="icon icon-xxl rounded-m me-3"><img src="'.asset('public/storage').'/'.$eservices[session()->get('a')]['img'].'"
//                                    width="80" class="rounded-sm"></span>
//                        </div>
//                        <div class="align-self-center w-100 mr-2">
//                            <h4>'.$eservices[session()->get('a')]['service_name'].'
//                                <strong
//                                    class="bg-green2-dark rounded-xs text-uppercase float-left font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
//                                    '.$eservices[session()->get('a')]['price'].'
//                                    ريال</strong>
//                            </h4>
//                            <p class="mb-0 opacity-60 line-height-s font-14">
//                                '.$eservices[session()->get('a')]['details'].'
//                            </p>
//                        </div>
//                    </div>
//                    <div class="divider mb-2 mt-n2"></div>
//                    <div class="row mb-n2 text-center">
//                        <div class="col-12">
//                            <a href="'.url('eservices').'/'.$eservices[session()->get('a')]['id'].'"
//                                class="color-yellow1-dark text-uppercase font-800 font-14 opacity-90">
//                                أطلب الخدمة
//                            </a>
//                        </div>
//                    </div>
//                </div>
//            </div>');
//
//
//
//
//         //   echo session()->get('output');
//            session()->put('a',session()->get('a') + 1);
//
//
//
//       session()->put('output8','<div class="card card-style">
//                <div class="content">
//                    <div class="d-flex mb-4">
//                        <div class="align-self-center">
//                            <span class="icon icon-xxl rounded-m me-3"><img src="'.asset('public/storage').'/'.$eservices[session()->get('a')]['img'].'"
//                                    width="80" class="rounded-sm"></span>
//                        </div>
//                        <div class="align-self-center w-100 mr-2">
//                            <h4>'.$eservices[session()->get('a')]['service_name'].'
//                                <strong
//                                    class="bg-green2-dark rounded-xs text-uppercase float-left font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
//                                    '.$eservices[session()->get('a')]['price'].'
//                                    ريال</strong>
//                            </h4>
//                            <p class="mb-0 opacity-60 line-height-s font-14">
//                                '.$eservices[session()->get('a')]['details'].'
//                            </p>
//                        </div>
//                    </div>
//                    <div class="divider mb-2 mt-n2"></div>
//                    <div class="row mb-n2 text-center">
//                        <div class="col-12">
//                            <a href="'.url('eservices').'/'.$eservices[session()->get('a')]['id'].'"
//                                class="color-yellow1-dark text-uppercase font-800 font-14 opacity-90">
//                                أطلب الخدمة
//                            </a>
//                        </div>
//                    </div>
//                </div>
//            </div>');
//
//            session()->put('a',session()->get('a') + 1);
//
//            session()->put('output',session()->get('output') . session()->get('output8'));
//
//           // dd( "hiiii ".session()->get('a');
//
//        } // end for loop
//             echo session()->get('output');
//        } // end if
//
//         else {
//         //   dd(session()->get('a'));
//
//for($i=1;$i<=10;$i++) {
//
//            if(session()->get('a') < $num) {
//
//   session()->put('output2','<div class="card card-style">
//                <div class="content">
//                    <div class="d-flex mb-4">
//                        <div class="align-self-center">
//                            <span class="icon icon-xxl rounded-m me-3"><img src="'.asset('public/storage').'/'.$eservices[session()->get('a')]['img'].'"
//                                    width="80" class="rounded-sm"></span>
//                        </div>
//                        <div class="align-self-center w-100 mr-2">
//                            <h4>'.$eservices[session()->get('a')]['service_name'].'
//                                <strong
//                                    class="bg-green2-dark rounded-xs text-uppercase float-left font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
//                                    '.$eservices[session()->get('a')]['price'].'
//                                    ريال</strong>
//                            </h4>
//                            <p class="mb-0 opacity-60 line-height-s font-14">
//                                '.$eservices[session()->get('a')]['details'].'
//                            </p>
//                        </div>
//                    </div>
//                    <div class="divider mb-2 mt-n2"></div>
//                    <div class="row mb-n2 text-center">
//                        <div class="col-12">
//                            <a href="'.url('eservices').'/'.$eservices[session()->get('a')]['id'].'"
//                                class="color-yellow1-dark text-uppercase font-800 font-14 opacity-90">
//                                أطلب الخدمة
//                            </a>
//                        </div>
//                    </div>
//                </div>
//            </div>');
//
//            session()->put('output',session()->get('output') . session()->get('output2'));
//          //  echo session()->get('output');
//            session()->put('a',session()->get('a') + 1);
//
//        }
//
//        else {
//          //  echo session()->get('output');
//        }
//
//    } // end for loop
//
//    echo session()->get('output');
//
//        }
//
//
//    }

    public function weblist(Request $request)
    {

        $status = Settings::getSetting('eservices_orders_status');
        if ($status != 'active') {
            return view('website.passive');
        }
        $sections = sections::all();
        $settings =  \Cache::rememberForever('settings',  function () {
            return Settings::first();
          });
        $sections = sections::all();
        $eservices_count = eservices::count();
        $eservices = collect([]);
        $electronic_user_count = 0;
        if(auth()->check()){
            $electronic_user_count=eservices_orders::where('user_id',auth()->id())->
                  whereDate('created_at', '=', Carbon::today()->toDateString())->count();
        }
        return view('website.eservices.eservices', compact('eservices', 'sections', 'eservices_count', 'electronic_user_count'));
    }

    public function eserviceFavorite(Request $request){

        $provider   = auth()->user();
        $type       = $request->type;

        if($type == 'add'){

            if(!empty($provider->services->toArray())){

                $provider->services()->sync(array_merge($provider->services->pluck('id')->toArray(),[(int)$request->service_id]));

            }else{
                $provider->services()->sync([$request->service_id]);
            }

            return response()->json([
                'status'            => true,
                'type'              => 'added_to_favorite',
            ]);

        }else{

            $services_ids = $provider->services->pluck('id')->toArray();

            $id = (int)$request->service_id;

            if (($key = array_search($id, $services_ids)) !== false) {
                unset($services_ids[$key]);
            }

            $provider->services()->sync($services_ids);

            return response()->json([
                'status'            => true,
                'type'              => 'deleted_from_favorite',
            ]);

        }

    }

 public function eserviceFavoriteIndex(Request $request){
     $user           = Auth::user();
     return view('website.user.eservice_favorite_index', compact('user'));
    }
    public function eserviceFavoriteUpdate(Request $request){

        \DB::table('user_favoriteable')
            ->where('favoriteable_id', $request->service_id)->where('user_id', $request->user_id)
            ->update(['price' => $request->price,'date' => $request->date]);
  return redirect()->back();
    }

    public function seeMore(Request $request)
    {
        $eservices  = eservices::orderBy('updated_at', 'DESC')->when($request->keyword, function ($q, $keyword) {
            return $q->where('service_name', 'like', '%' . $keyword . '%')->orWhere('details', 'like', '%' . $keyword . '%');
        })->paginate(10);
        $electronic_user_count = 0;
        if(auth()->check()){
            $electronic_user_count=eservices_orders::where('user_id',auth()->id())->
                  whereDate('created_at', '=', Carbon::today()->toDateString())->count();
        }
        $view       = view('website.eservices.ajax-view.data', compact('eservices', 'electronic_user_count'))->render();

        if(!empty($request->keyword)){
            $model = SearchedWord::where('word',$request->keyword)->first();

            if(empty($model)){
                $searched_word          = new SearchedWord;
                $searched_word->word    = $request->keyword;
                $searched_word->count   = 1;
                $searched_word->save();
            }else{
                $count                  = $model->count;
                $model->count           = $count + 1;
                $model->save();
            }
        }

        return response()->json(['html' => $view]);
    }

    public function sectionEservicesSeeMore(Request $request)
    {
        $eservices = eservices::where('section_id', $request->id)->orderBy('updated_at', 'DESC')->paginate(10);
        $electronic_user_count = 0;
        if(auth()->check()){
            $electronic_user_count=eservices_orders::where('user_id',auth()->id())->
                  whereDate('created_at', '=', Carbon::today()->toDateString())->count();
        }
        $view = view('website.eservices.ajax-view.section_eservices_data', compact('eservices', 'electronic_user_count'))->render();
        return response()->json(['html' => $view]);
    }

    public function payment()
    {
        return view('website.eservices.payment');
    }


    public function list()
    {
        // $job = dispatch(new \App\Jobs\EservicesOrders())->delay(\Carbon\Carbon::now()->addMinutes(1));
        // dd("d");
        // return '213';
        $eservices = sections::pluck('name', 'id')->prepend('ارجاء اختيار قسم', '');
        return view('admin.eservices.list', compact('eservices'));
    }
    public function get_all(Request $request)
    {
        $page = $request->input('pagination.page', '1');
        $search = $request->input('query.generalSearch', null);
        $perpage = $request->input('pagination.perpage', 10);
        $sortOrder = $request->input('sort.sort', 'asc');
        $sortField = $request->input('sort.field', 'id');
        $offset = ($page - 1) * $perpage;
        $query = eservices::with('sections');
        if ($request->input('query.generalSearch') != null) {
            $query->where('service_name', $request->input('query.generalSearch'));
        }
        if ($request->input('query.status') != null) {
            $query->where('status', $request->input('query.status'));
        }
        $totalCount = $query->count();

        $query->offset($offset)
            ->limit($perpage)
            ->orderBy($sortField, $sortOrder);
        $data = $query->get();
        $request->offsetSet('pages', ceil($totalCount / $perpage));
        $request->offsetSet('total', $totalCount);
        return (new EservicesCollection($data));
    }


    public function index()
    {
        $eservices = eservices::all(); // Select
        return view('admin.eservices.list', compact('eservices')); // while query
    }


    public function create()
    {

        return view('admin.eservices.create');
    }


    public function store()
    {

        $eservice = eservices::create($this->validateData()); // insert
        $this->storeImage($eservice);
        return redirect('/admin/e_services/create')->with("success", "تم الانشاء بنجاح"); // send id of inserted

    }

    public function show(eservices $eservices)
    {
        //
    }


    public function edit(eservices $eservices)
    {

        $sections = sections::where('id', '<>', $eservices->section_id)->get();
        return view('admin.eservices.edit', compact('eservices', 'sections'));
    }


    public function update(Request $request, eservices $eservices)
    {
        $eservices->update($this->validateData());
        $this->storeImage($eservices);
        return redirect('/admin/e_services/' . $eservices->id . "/edit")->with('success', 'successfully updated');

    }


    public function delete($id)
    {

        $eservices = eservices::findOrFail($id);
        $eservices->delete();
        return true;
    }


    private function storeImage($eservice)
    {


        if (request()->hasFile('img')) {

            $file = request()->file('img');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;
            $path = public_path() . '/storage/uploads';
            $uplaod = $file->move($path, $fileName);

            $eservice->img = 'uploads/' . $fileName;
            $eservice->save();


        }

    }


    protected function validateData()
    {


        $mydata = [
            'service_name' => 'required',
            'details' => 'required',
            'how_do' => '',
            'policies' => '',
            'status' => '',
            'section_id' => 'required',
        ];


        if (request()->hasFile('img')) {
            $mydata['img'] = 'file|image';
        }

        $validatedData = request()->validate($mydata);


        return $validatedData;


    }

    public function supervisors($service_id){
        // $supervisors = Favorite::with('providers')->where('favoriteable_id', $service_id)->where('favoriteable_type', eservices::class)->get();
        $supervisors = [];
        return view('website.eservices.supervisors',compact('supervisors', 'service_id'));
    }
    public function more_supervisors(Request $request){
        // dd($request->all());
        $view = "";
        $supervisors = Favorite::with(['provider' => function($q){
            $q->with('avgReviews');
        }])->where('favoriteable_id', $request->service_id)->where('favoriteable_type', eservices::class)->paginate(10);
        if(count($supervisors)){
            $view = view('website.eservices.ajax-view.supervisor',['supervisors' => $supervisors])->render();
        }
        return response()->json(['html' => $view]);
    }




}
