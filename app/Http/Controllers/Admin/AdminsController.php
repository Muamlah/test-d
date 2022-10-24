<?php

namespace App\Http\Controllers\Admin;


use App\Models\Admin;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Image;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use App\Http\Resources\Admin\AdminCollection;
use App\Http\Resources\Admin\LogCollection;
use App\Traits\CommonTrait;


class AdminsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //
       public function __construct()
       {
           // PREMISSIONS MIDDLEWARE
           $this->middleware('canPermission:READ_ADMINS')->only(['index', 'get_all_logs', 'get_all', 'logs']);
           $this->middleware('canPermission:CREATE_ADMINS')->only(['create', 'store']);
           $this->middleware('canPermission:UPDATE_ADMINS')->only(['edit', 'update']);

       }

    use CommonTrait;

    public function logs(){
        return view('admin.admins.logs');
    }

    public function get_all_logs(Request $request) {
        $page = $request->input('pagination.page','1');
        $search = $request->input('query.generalSearch',null);
        $perpage = $request->input('pagination.perpage',10);
        $sortOrder = $request->input('sort.sort','asc');
        $sortField = $request->input('sort.field','id');
        $offset = ($page - 1) * $perpage;
        $query = Log::orderBy('id','DESC');
        if ( $request->input('query.generalSearch')!=null) {
            $query->where('admin_name','like','%'.$request->input('query.generalSearch').'%')
            ->orWhere('admin_email','like','%'.$request->input('query.generalSearch').'%')
            ->orWhere('action','like','%'.$request->input('query.generalSearch').'%')
            ->orWhere('description','like','%'.$request->input('query.generalSearch').'%');
        }

        $totalCount = $query->count();

        $query->offset($offset)
            ->limit($perpage)
            ->orderBy($sortField,$sortOrder);
        $data = $query->get();
        $request->offsetSet('pages',ceil($totalCount / $perpage));
        $request->offsetSet('total',$totalCount);

         return (new LogCollection($data));
    }

    public function index(Request $request)
    {
      return view('admin.admins.index');

    }

    public function get_all(Request $request) {
        $page = $request->input('pagination.page','1');
        $search = $request->input('query.generalSearch',null);
        $perpage = $request->input('pagination.perpage',10);
        $sortOrder = $request->input('sort.sort','asc');
        $sortField = $request->input('sort.field','id');
        $offset = ($page - 1) * $perpage;
        $query = Admin::query();
        if ( $request->input('query.generalSearch')!=null) {
            $query->where('name','like','%'.$request->input('query.generalSearch').'%');
        }

        $totalCount = $query->count();

        $query->offset($offset)
            ->limit($perpage)
            ->orderBy($sortField,$sortOrder);
        $data = $query->get();
        $request->offsetSet('pages',ceil($totalCount / $perpage));
        $request->offsetSet('total',$totalCount);
        return (new AdminCollection($data));
    }

    public function destroy($id)
    {

        $item = Admin::query()->findOrFail($id);

        $description = ' تم حذف ادمن باسم  '.$item->name.' ';
        $this->addLog('حذف ادمن ',$description);
        \Cache::flush();

        if ($item && $item->type != 1) {
            Admin::query()->where('id', $id)->delete();
            return back();
        }
        return "fail";
    }


    public function create()
    {

        $roles=Role::query()->get();
        return view('admin.admins.create',[
            'roles'=>$roles
        ]);
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'=>'required|string',
            'email'=>'required|email|unique:admins',
            'second_password'=>'nullable|min:6',
            'password'=>'required|min:6',
            'confirm_password'=>'required|same:password|min:6',
            'role'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $newAdmin = new Admin();
        $newAdmin->name=$request->name;
        $newAdmin->email=$request->email;
        $newAdmin->phone=$request->phone;

        $newAdmin->password=bcrypt($request->password);
        $newAdmin->second_password=$request->second_password ? bcrypt($request->second_password) : null;
        $newAdmin->user_type=$request->user_type;
        $newAdmin->save();

        $role=Role::findOrFail($request->role);
        $newAdmin->assignRole($role);

        $newAdmin->syncPermissions($role->permissions);

        $description = ' تم إضافة أدمن جديد بإسم '.$request->name.' ';
        $this->addLog('إضافة أدمن جديد',$description);
        \Cache::flush();

        return redirect()->back()->with('success', __('common.success_add'));

    }


    public function edit($id)
    {
        $item = Admin::findOrFail($id);
        $roles=Role::get();

        return view('admin.admins.edit',[
            'item'=>$item ,
            'roles'=>$roles ,
        ]);
    }

    public function my_profile(Request $request)
    {
        $item = auth()->guard('admin')->user();
        return view('admin.admins.edit',[
            'item'=>$item
        ]);
    }

    public function show($id)
    {
        $item = Admin::findOrFail($id);
        $roles=Role::get();

        return view('admin.admins.edit',[
            'item'=>$item ,
            'roles'=>$roles ,
        ]);
    }


    public function update(Request $request, $id)
    {
        $admin= Admin::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name'=>'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $check = Admin::where('email',$request->email)->where('id','<>',$id)->first();
        if($check){
            $validator='الايميل غير صحيح أو تم التسجيل به من قبل';
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $admin->name=$request->name;
        $admin->email=$request->email;
        $admin->phone=$request->phone;
        $admin->password=$request->password ? bcrypt($request->password) : $admin->password;
        $admin->second_password=$request->second_password ? bcrypt($request->second_password) : $admin->second_password;

        $role=Role::findOrFail($request->role);

        $admin->syncRoles($request->role);
        $admin->syncPermissions($role->permissions);

        $description = ' تم تعديل أدمن بإسم '.$request->name.' ';
        $this->addLog('تعديل أدمن',$description);

        $admin->user_type=$request->user_type;
        $admin->save();
        \Cache::flush();

        return redirect()->back()->with('success', __('common.success_edit'));

    }
    public function update_my_profile(Request $request)
    {

        $admin = auth()->guard('admin')->user();

        $id = $admin->id;

        $validator = Validator::make($request->all(), [
            'name'=>'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $check = Admin::where('email',$request->email)->where('id','<>',$id)->first();
        if($check){
            $validator='الايميل غير صحيح أو تم التسجيل به من قبل';
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $admin->name=$request->name;
        $admin->email=$request->email;
        $admin->phone=$request->phone;
        $admin->password=$request->password ? bcrypt($request->password) : $admin->password;
        $admin->save();

        $description = ' تم تعديل الحساب الشخصي باسم  '.$request->name.' ';
        $this->addLog('تعديل الحساب الشخصي ',$description);
        \Cache::flush();

        return redirect()->back()->with('success', __('common.success_edit'));

    }

    public function verify_form($type = null){
        // dd($type);
        return view('admin.include.access_form', compact('type'));
    }

    public function verify(Request $request)
    {

        $admin = auth()->guard('admin')->user();

        $validator = Validator::make($request->all(), [
            'second_password'=>'required',
            'type'=>'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        \Cache::flush();

        if (\Hash::check($request->second_password, $admin->second_password))
         {
            $admin->access_life_time = \Carbon\Carbon::now();
            $admin->save();
            if($request->type == 'wallet')
            {
                return redirect()->route('admin.wallet');
            }
            else
            {
                return redirect()->route('admin.balance_requests');
            }
        }else
        {
            return redirect()->back()->withErrors(['msg' => 'كلمة المرور غير صحيحة']);
        }

    }

}
