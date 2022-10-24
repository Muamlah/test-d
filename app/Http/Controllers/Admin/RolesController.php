<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Traits\CommonTrait;
use App\Http\Resources\Admin\RoleCollection;

class RolesController extends Controller
{
       public function __construct()
       {
           // PREMISSIONS MIDDLEWARE
           $this->middleware('canPermission:READ_ADMINS');
    
       }
    use CommonTrait;
    public function index(Request $request)
    {
        $items = Role::query();
        $items = $items->orderBy('id', 'desc')->get();
        return view('admin.roles.index', [
            'items' => $items,
        ]);
    }
    public function get_all(Request $request) {
        $page = $request->input('pagination.page','1');
        $search = $request->input('query.generalSearch',null);
        $perpage = $request->input('pagination.perpage',10);
        $sortOrder = $request->input('sort.sort','asc');
        $sortField = $request->input('sort.field','id');
        $offset = ($page - 1) * $perpage;
        $query = Role::orderBy('id','DESC');
        if ( $request->input('query.generalSearch')!=null) {
            $query->where('name','like','%'.$request->input('query.generalSearch').'%')
            ->orWhere('guard_name','like','%'.$request->input('query.generalSearch').'%');
        }

        $totalCount = $query->count();

        $query->offset($offset)
            ->limit($perpage)
            ->orderBy($sortField,$sortOrder);
        $data = $query->get();
        $request->offsetSet('pages',ceil($totalCount / $perpage));
        $request->offsetSet('total',$totalCount);
        return (new RoleCollection($data));
    }
    public function create()
    {
        return view('admin.roles.create');
    }
    public function store(Request $request)
    {

        $roles['name'] = 'required';

        $this->validate($request, $roles);

        $role = New Role();
        $role->name=$request->name;
        $role->guard_name='admin';
        $role->save();

        $role->syncPermissions($request->role_permissions);

        $description = ' تم اضافة صلاحية باسم  '.$request->name.' ';
        $this->addLog('اضافة صلاحية ',$description);

      //  return redirect()->route('admin.roles.index')->with('status', __('common.create'));
        return redirect()->back()->with('success', __('common.success_add'));
    }

    public function edit($id)
    {
        $role = Role::query()->find($id);
        $permissions= $role->permissions->pluck('name')->toArray();
        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    public function update(request $request, $id) {
        $data = $request->all() ;

        // FIND THE Role
        $role = Role::query()->find($id);

        // UPDATE ROLE DATA
        $role->update($data);

        // UPDATE PERMISSIONS
        $role->syncPermissions($request->role_permissions);

        $description = ' تم تعديل صلاحية باسم  '.$role->name.' ';
        $this->addLog('تعديل صلاحية ',$description);

        return redirect()->back()->with('success', __('common.success_edit'));

      //  return redirect()->route('admin.roles.index')->with('status', __('common.success_edit'));
    }


}
