<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Coupon\Store;
use App\Http\Requests\Admin\Coupon\Update;
use App\Models\Coupon;
use App\Models\User;
use App\Http\Resources\Coupon\CouponCollection;
class CouponsController extends Controller
{
    protected $data = [];
    public function __construct()
    {
        // PREMISSIONS MIDDLEWARE
        $this->middleware('canPermission:READ_COUPONS');
 
    }
    public function index()
    {
        return view('admin.coupon.index', $this->data);
    }

    public function get_all(Request $request) {
        $page = $request->input('pagination.page','1');
        $search = $request->input('query.generalSearch',null);
        $perpage = $request->input('pagination.perpage',10);
        $sortOrder = $request->input('sort.sort','asc');
        $sortField = $request->input('sort.field','id');
        $offset = ($page - 1) * $perpage;
        $query = Coupon::with('owner');
        if ( $request->input('query.generalSearch')!=null) {
            $query->where('code','like','%'.$request->input('query.generalSearch').'%');
        }

        $totalCount = $query->count();

        $query->withCount('Instances AS used_instances_count')->offset($offset)
            ->limit($perpage)
            ->orderBy($sortField,$sortOrder);
        $data = $query->get();
        $request->offsetSet('pages',ceil($totalCount / $perpage));
        $request->offsetSet('total',$totalCount);
        return (new CouponCollection($data));
    }

    public function create()
    {
        $this->data['types'] = Coupon::getTypes();
        $this->data['discount_types'] = Coupon::getDiscountTypes();
        return view('admin.coupon.create', $this->data);

    }
    public function edit(Coupon $coupon)
    {
        $this->data['coupon'] = $coupon;
        $this->data['types'] = Coupon::getTypes();
        $this->data['discount_types'] = Coupon::getDiscountTypes();
        $this->data['user_phone'] = null;
        if(!empty($user = $coupon->owner)){
            $user = User::find($coupon->owner_id);
            if(!is_null($user)){
                $this->data['user_phone'] = $user->phone;
            }
        }
        return view('admin.coupon.update', $this->data);

    }
    public function store(Store $request)
    {
        $owner_id = NULL;
        if($request->has('user_phone')){
            $user_phone = $request->user_phone;
            $user = User::where('phone', $user_phone)->first();
            if(is_null($user)){
                return redirect()->route('admin.coupon.create')->with("error","رقم هاتف المزود غير صحيح أو غير موجود");
            }
            $owner_id = $user->id;
        }
        $request->merge(['owner_id' => $owner_id]);
        Coupon::create($request->only(['code', 'type', 'instances_count', 'discount', 'owner_id', 'owner_discount', 'discount_type', 'max_discount', 'number_of_use', 'end_date']));
        return redirect()->route('admin.coupon.create')->with("success","تم الانشاء بنجاح");
    }

    public function save(Update $request, Coupon $coupon)
    {
        
        $owner_id = NULL;
        if($request->has('user_phone')){
            $user_phone = $request->user_phone;
            $user = User::where('phone', $user_phone)->first();
            if(is_null($user)){
                return redirect()->route('admin.coupon.edit',['coupon' => $coupon->id])->with("error","رقم هاتف المزود غير صحيح أو غير موجود");
            }
            $owner_id = $user->id;
        }
        $request->merge(['owner_id' => $owner_id]);

        $check_code = Coupon::where('id','!=',$coupon->id)->where('code',$request->code)->first();
        if(!empty($check_code))
        {
            return redirect()->route('admin.coupon.edit',['coupon' => $coupon->id])->with("used","يرجى تغيير الكود لأنه مستخدم في كوبون آخر");
        }

        $coupon->update($request->only(['code', 'type', 'instances_count', 'discount', 'owner_id', 'owner_discount', 'discount_type', 'max_discount', 'number_of_use', 'end_date']));

        return redirect()->route('admin.coupon.edit',['coupon' => $coupon->id])->with("success","تم التعديل بنجاح");
    }

    public function delete(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupon.index');

    }
}
