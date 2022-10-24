<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserCollection;
use App\Models\BalanceRequest;
use App\Traits\ApiResponseTrait;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Validator;

use App\Models\Transaction;
use App\Models\PublicOrder;
use App\Models\PrivateOrder;
use App\Models\eservices_orders;
use Illuminate\Support\Collection;
use App\Models\UserLog;
use App\Http\Resources\User\UserLogCollection;
use App\Traits\SMSTrait;
use App\Notifications\SendCustomEmailsToUser;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Traits\CommonTrait;

class UsersController extends Controller
{
    use ApiResponseTrait, SMSTrait, CommonTrait;

    /**
     * @return Application|Factory|View
     */

    public function __construct()
    {
        // PREMISSIONS MIDDLEWARE

        $this->middleware('auth:admin');
        $this->middleware('canPermission:READ_USERS', ['only' => ['indexUser', 'indexProvider']]);
        $this->middleware('canPermission:CREATE_USERS', ['only' => ['create', 'store']]);
        $this->middleware('canPermission:UPDATE_USERS', ['only' => ['edit', 'update']]);

    }

    public function indexUser()
    {
        // $users = User::where('level', 'user')->orderBy('id', 'desc')->get();
        return view('admin.users.indexUser');
    }

    public function indexWrongUser()
    {
        if (!can('READ_WRONG_USER')) {
            abort(404);
        }
        return view('admin.users.indexWrongUser');
    }

    public function get_all_wrong(Request $request)
    {
        $page = $request->input('pagination.page', '1');
        $search = $request->input('query.generalSearch', null);
        $perpage = $request->input('pagination.perpage', 10);
        $sortOrder = $request->input('sort.sort', 'desc');
        $sortField = $request->input('sort.field', 'id');
        $offset = ($page - 1) * $perpage;
        $query = User::whereRaw('available_balance + pinding_balance != total_balance')
            ->orWhere('total_balance', '<', 0)->orWhere('available_balance', '<', 0)->orWhere('pinding_balance', '<', 0)->where('level', 'user');
        // dd($query->get());
        // if ($request->input('query.generalSearch') != null) {
        //     $query->where('name', $request->input('query.generalSearch'));
        // }
        if ($request->input('query.phone') != null) {
            $query->where('phone', 'LIKE', "%{$request->input('query.phone')}%");
        }
        if ($request->input('query.name') != null) {
            $query->where('name', 'LIKE', "%{$request->input('query.name')}%");
        }
        if ($request->input('query.email') != null) {
            $query->where('email', 'LIKE', "%{$request->input('query.email')}%");
        }

        $totalCount = $query->count();

        $query->offset($offset)
            ->limit($perpage)
            ->orderBy($sortField, $sortOrder);
        $data = $query->get();
        $request->offsetSet('pages', ceil($totalCount / $perpage));
        $request->offsetSet('total', $totalCount);
        foreach ($data as $item) {
            $number_of_reference_orders = 0;
            if (!empty($item->reference_code)) {
                $private_orders_count = PrivateOrder::where('reference_code', $item->reference_code)->count();
                $eservice_orders_count = eservices_orders::where('reference_code', $item->reference_code)->count();
                $number_of_reference_orders += $private_orders_count += $eservice_orders_count;
            }
            $item->number_of_reference_orders = $number_of_reference_orders;

            $owner_amount_of_reference_orders = 0;
            if (!empty($item->reference_code)) {
                $private_orders_count = PrivateOrder::where('reference_code', $item->reference_code)->sum('owner_discount');
                $eservice_orders_count = eservices_orders::where('reference_code', $item->reference_code)->sum('owner_discount');
                $owner_amount_of_reference_orders += $private_orders_count += $eservice_orders_count;
            }
            $item->owner_amount_of_reference_orders = $owner_amount_of_reference_orders;

            $user_amount_of_reference_orders = 0;
            if (!empty($item->reference_code)) {
                $private_orders_count = PrivateOrder::where('user_id', $item->id)->sum('user_discount');
                $eservice_orders_count = eservices_orders::where('user_id', $item->id)->sum('user_discount');
                $user_amount_of_reference_orders += $private_orders_count += $eservice_orders_count;
            }
            $item->user_amount_of_reference_orders = $user_amount_of_reference_orders;
        }
        return (new UserCollection($data))->response()->setStatusCode(200);

    }

    public function indexReportUser()
    {
        return view('admin.users.indexReportUser');
    }

    public function indexAllReportUser($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('admin.users.indexAllReportUser', compact('user'));
    }

    public function get_all_report(Request $request)
    {
        $page = $request->input('pagination.page', '1');
        $search = $request->input('query.generalSearch', null);
        $perpage = $request->input('pagination.perpage', 10);
        $sortOrder = $request->input('sort.sort', 'desc');
        $sortField = $request->input('sort.field', 'id');
        $offset = ($page - 1) * $perpage;
        $query = User::whereHas('publicOrdersReport')->orWhereHas('privateOrdersReport')->orWhereHas('eservicesOrdersReport');
        // dd($query->get());
        // if ($request->input('query.generalSearch') != null) {
        //     $query->where('name', $request->input('query.generalSearch'));
        // }
        if ($request->input('query.phone') != null) {
            $query->where('phone', 'LIKE', "%{$request->input('query.phone')}%");
        }
        if ($request->input('query.name') != null) {
            $query->where('name', 'LIKE', "%{$request->input('query.name')}%");
        }
        if ($request->input('query.email') != null) {
            $query->where('email', 'LIKE', "%{$request->input('query.email')}%");
        }

        $totalCount = $query->count();

        $query->offset($offset)
            ->limit($perpage)
            ->orderBy($sortField, $sortOrder);
        $data = $query->get();
        $request->offsetSet('pages', ceil($totalCount / $perpage));
        $request->offsetSet('total', $totalCount);
        foreach ($data as $item) {
            $number_of_reference_orders = 0;
            if (!empty($item->reference_code)) {
                $private_orders_count = PrivateOrder::where('reference_code', $item->reference_code)->count();
                $eservice_orders_count = eservices_orders::where('reference_code', $item->reference_code)->count();
                $number_of_reference_orders += $private_orders_count += $eservice_orders_count;
            }
            $item->number_of_reference_orders = $number_of_reference_orders;

            $owner_amount_of_reference_orders = 0;
            if (!empty($item->reference_code)) {
                $private_orders_count = PrivateOrder::where('reference_code', $item->reference_code)->sum('owner_discount');
                $eservice_orders_count = eservices_orders::where('reference_code', $item->reference_code)->sum('owner_discount');
                $owner_amount_of_reference_orders += $private_orders_count += $eservice_orders_count;
            }
            $item->owner_amount_of_reference_orders = $owner_amount_of_reference_orders;

            $user_amount_of_reference_orders = 0;
            if (!empty($item->reference_code)) {
                $private_orders_count = PrivateOrder::where('user_id', $item->id)->sum('user_discount');
                $eservice_orders_count = eservices_orders::where('user_id', $item->id)->sum('user_discount');
                $user_amount_of_reference_orders += $private_orders_count += $eservice_orders_count;
            }
            $item->user_amount_of_reference_orders = $user_amount_of_reference_orders;
        }
        return (new UserCollection($data))->response()->setStatusCode(200);

    }

    public function indexProvider(Request $r)
    {
        // $users = User::where('level', 'provider')->orderBy('id', 'desc')->get();
        return view('admin.users.indexProvider');
    }

    public function get_all_p(Request $request)
    {
        $page = $request->input('pagination.page', '1');
        $search = $request->input('query.generalSearch', null);
        $perpage = $request->input('pagination.perpage', 10);
        $sortOrder = $request->input('sort.sort', 'desc');
        $sortField = $request->input('sort.field', 'id');
        $offset = ($page - 1) * $perpage;
        $query = User::where('level', 'provider');
        // if ($request->input('query.generalSearch') != null) {
        //     $query->where('name', $request->input('query.generalSearch'));
        // }
        if ($request->input('query.phone') != null) {
            $query->where('phone', 'LIKE', "%{$request->input('query.phone')}%");
        }
        if ($request->input('query.name') != null) {
            $query->where('name', 'LIKE', "%{$request->input('query.name')}%");
        }
        if ($request->input('query.email') != null) {
            $query->where('email', 'LIKE', "%{$request->input('query.email')}%");
        }

        $totalCount = $query->count();

        $query->offset($offset)
            ->limit($perpage)
            ->orderBy($sortField, $sortOrder);
        $data = $query->get();
        $request->offsetSet('pages', ceil($totalCount / $perpage));
        $request->offsetSet('total', $totalCount);
        foreach ($data as $item) {
            $number_of_reference_orders = 0;
            if (!empty($item->reference_code)) {
                $private_orders_count = PrivateOrder::where('reference_code', $item->reference_code)->count();
                $eservice_orders_count = eservices_orders::where('reference_code', $item->reference_code)->count();
                $number_of_reference_orders += $private_orders_count += $eservice_orders_count;
            }
            $item->number_of_reference_orders = $number_of_reference_orders;

            $owner_amount_of_reference_orders = 0;
            if (!empty($item->reference_code)) {
                $private_orders_count = PrivateOrder::where('reference_code', $item->reference_code)->sum('owner_discount');
                $eservice_orders_count = eservices_orders::where('reference_code', $item->reference_code)->sum('owner_discount');
                $owner_amount_of_reference_orders += $private_orders_count += $eservice_orders_count;
            }
            $item->owner_amount_of_reference_orders = $owner_amount_of_reference_orders;

            $user_amount_of_reference_orders = 0;
            if (!empty($item->reference_code)) {
                $private_orders_count = PrivateOrder::where('user_id', $item->id)->sum('user_discount');
                $eservice_orders_count = eservices_orders::where('user_id', $item->id)->sum('user_discount');
                $user_amount_of_reference_orders += $private_orders_count += $eservice_orders_count;
            }
            $item->user_amount_of_reference_orders = $user_amount_of_reference_orders;

        }
        return (new UserCollection($data))->response()->setStatusCode(200);

    }

    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * @param UserRequest $request
     * @return Application|Factory|View|RedirectResponse|Redirector
     * @throws GuzzleException
     * @throws Throwable
     */

    public function store(UserRequest $request)
    {

        try {
            $newUser = new User();
            $newUser->name = $request->name;
            $newUser->email = $request->email;
            $newUser->phone = $request->phone;
            $newUser->level = $request->level;
            $newUser->status = $request->has('status') ? 'active' : 'not_active';
            $newUser->verification_code = rand(100000, 999999);
            $newUser->password = bcrypt($request->password);
            $newUser->save();

            if ($request->level == 'provider') {
                return redirect(route('admin.indexProvider'))->with(['success' => 'تم الاضافة بنجاح']);
            } else {
                return redirect(route('admin.indexUser'))->with(['success' => 'تم الاضافة بنجاح']);
            }

        } catch (Throwable $throwable) {
            throw $throwable;
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', [
            'user' => $user
        ]);
    }

    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.reset_password', [
            'user' => $user
        ]);
    }

    public function resetPasswordPost(Request $request, $id)
    {


        if ($request->reset_password != 'email' && $request->reset_password != 'phone') {
            return redirect(route('admin.users.resetPassword', ['id' => $id]))->withErrors(['msg' => 'قيمة خاظئة']);
        }

        $user = User::findOrFail($id);

        if ($request->reset_password == 'email' && empty($user->email)) {
            return redirect(route('admin.users.resetPassword', ['id' => $id]))->withErrors(['msg' => 'لايوجد ايميل لهذا المستخدم']);
        }
        if ($request->reset_password == 'phone' && empty($user->phone)) {
            return redirect(route('admin.users.resetPassword', ['id' => $id]))->withErrors(['msg' => 'لايوجد رقم هاتف لهذا المستخدم']);
        }

        try {
            $password = $this->generateRandomString();
            if ($request->reset_password == 'email') {
                $title = 'السلام عليكم ' . $user->name;
                $message1 = 'تم اعادة تعين كلمة المرور بنجاح';
                $message2 = 'رقم المستخدم ' . $user->phone;
                $message3 = 'كلمة المرور ' . $password;

                $this->sendEmail($title, $message1, $message2, $message3, $user->email);
            } elseif ($request->reset_password == 'phone') {
                $message = "عزيزي العميل ..
                تم اعادة تعين كلمة المرور
                اسم المستخدم:$request->phone
                كلمة المرور:$password
                الرابط https://app.muamlah.com
                نسعد بخدمتكم على مدار ٢٤ ساعة";
                $this->sendSMS($user->phone, $message);
                $mass = "سوف تصلك رسالة SMS بكلمة المرور الجديدة خلال دقائق";
            }
            $user->update(['password' => bcrypt($password), 'active' => 1]);
            return redirect(route('admin.users.resetPassword', ['id' => $id]))->withErrors(['msg' => 'success']);

        } catch (Throwable $throwable) {
            throw $throwable;
        }
    }

    public function sendEmail($title, $message1, $message2, $message3, $email)
    {

        $info = [
            'title' => $title,
            'message1' => $message1,
            'message2' => $message2,
            'message3' => $message3,
        ];

        Mail::to($email)->send(new SendCustomEmailsToUser($info));
    }

    public function generateRandomString($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function log($id)
    {
        $user = User::find($id);
        return view('admin.users.log', [
            'user' => $user
        ]);
    }

    public function updateOrder($id)
    {
        if (!can('UPDATE_WRONG_USER')) {
            abort(404);
        }
        $user = User::findOrFail($id);
        return view('admin.users.update_order', [
            'user' => $user
        ]);
    }

    public function updateOrderPost(Request $request, $id)
    {
        if (!can('UPDATE_WRONG_USER')) {
            abort(404);
        }

        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'total_balance' => 'nullable|numeric|max:999999999',
            'available_balance' => 'nullable|numeric|max:999999999',
            'pinding_balance' => 'nullable|numeric|max:999999999',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $check_balance = $this->checkUserBalance($user);

        if ($check_balance) {
            return back()->with(['error' => 'عذراً لايمكنك تعديل الرصيد لأن الرصيد صحيح']);
        }

        $user->total_balance = $request->total_balance;
        $user->available_balance = $request->available_balance;
        $user->pinding_balance = $request->pinding_balance;
        $user->save();

        return redirect()->back()->with('success', '');
    }

    public function userInformations($id)
    {
        $user = User::with('creditCard')->find($id);
        $items = Transaction::where('user_id', $user->id)->orderBy('updated_at', 'DESC')->get();
        $invoices = collect([]);
        $public_orders = PublicOrder::whereHas('offers')->with(['offers', 'provider', 'user'])->where(function ($q) use ($user) {
            $q->where('user_id', $user->id)->orWhere('provider_id', $user->id);
        })->where('status', 5)->orderBy('updated_at', 'DESC')->paginate(5);
        foreach ($public_orders as $order) {
            $item = new \stdClass;
            $item->id = $order->id;
            $item->order_id = $order->id;
            $item->type = 'public';
            $item->created_at = $order->updated_at;
            $item->order = $order;
            $invoices->push($item);
        }

        $private_orders = PrivateOrder::with(['provider', 'user'])->where('status_id', '5')->where(function ($q) use ($user) {
            $q->where('user_id', $user->id)->orWhere('provider_id', $user->id);
        })->orderBy('updated_at', 'DESC')->paginate(5);

        foreach ($private_orders as $order) {
            $item = new \stdClass;
            $item->id = $order->id;
            $item->order_id = $order->id;
            $item->type = 'private';
            $item->created_at = $order->updated_at;
            $item->order = $order;
            $invoices->push($item);
        }
        $eservices_orders = eservices_orders::with(['provider', 'user'])->where(function ($q) use ($user) {
            $q->where('user_id', $user->id)->orWhere('provider_id', $user->id);
        })->where('provider_id', '!=', 0)->where('pay_status', 'complete_convert')->orderBy('updated_at', 'DESC')->paginate(5);
        foreach ($eservices_orders as $order) {
            $item = new \stdClass;
            $item->id = $order->id;
            $item->order_id = $order->id;
            $item->type = 'eservice';
            $item->created_at = $order->updated_at;
            $item->order = $order;
            $invoices->push($item);
        }

        $invoices = $invoices->sortByDesc('created_at');

        return view('admin.users.user_informations', [
            'user' => $user,
            'items' => $items,
            'invoices' => $invoices,
        ]);
    }


    public function get_all(Request $request)
    {
        $page = $request->input('pagination.page', '1');
        $search = $request->input('query.generalSearch', null);
        $perpage = $request->input('pagination.perpage', 10);
        $sortOrder = $request->input('sort.sort', 'desc');
        $sortField = $request->input('sort.field', 'id');
        $offset = ($page - 1) * $perpage;
        if ($request->has('in_review') && $request->in_review == 1) {
            $query = User::where('in_review', '1');

        } else {
            $query = User::where('level', 'user');

        }
        // if ($request->input('query.generalSearch') != null) {
        //     $query->where('name', $request->input('query.generalSearch'));
        // }
        if ($request->input('query.phone') != null) {
            $query->where('phone', 'LIKE', "%{$request->input('query.phone')}%");
        }
        if ($request->input('query.name') != null) {
            $query->where('name', 'LIKE', "%{$request->input('query.name')}%");
        }
        if ($request->input('query.email') != null) {
            $query->where('email', 'LIKE', "%{$request->input('query.email')}%");
        }

        $totalCount = $query->count();

        $query->offset($offset)
            ->limit($perpage)
            ->orderBy($sortField, $sortOrder);
        $data = $query->get();
        $request->offsetSet('pages', ceil($totalCount / $perpage));
        $request->offsetSet('total', $totalCount);
        foreach ($data as $item) {
            $number_of_reference_orders = 0;
            if (!empty($item->reference_code)) {
                $private_orders_count = PrivateOrder::where('reference_code', $item->reference_code)->count();
                $eservice_orders_count = eservices_orders::where('reference_code', $item->reference_code)->count();
                $number_of_reference_orders += $private_orders_count += $eservice_orders_count;
            }
            $item->number_of_reference_orders = $number_of_reference_orders;

            $owner_amount_of_reference_orders = 0;
            if (!empty($item->reference_code)) {
                $private_orders_count = PrivateOrder::where('reference_code', $item->reference_code)->sum('owner_discount');
                $eservice_orders_count = eservices_orders::where('reference_code', $item->reference_code)->sum('owner_discount');
                $owner_amount_of_reference_orders += $private_orders_count += $eservice_orders_count;
            }
            $item->owner_amount_of_reference_orders = $owner_amount_of_reference_orders;

            $user_amount_of_reference_orders = 0;
            if (!empty($item->reference_code)) {
                $private_orders_count = PrivateOrder::where('user_id', $item->id)->sum('user_discount');
                $eservice_orders_count = eservices_orders::where('user_id', $item->id)->sum('user_discount');
                $user_amount_of_reference_orders += $private_orders_count += $eservice_orders_count;
            }
            $item->user_amount_of_reference_orders = $user_amount_of_reference_orders;
        }
        return (new UserCollection($data))->response()->setStatusCode(200);

    }

    public function get_log(Request $request)
    {
        $id = \Str::of(url()->previous())->after('https://app.muamlah.com/admin/users/log/');

        $page = $request->input('pagination.page', '1');
        $search = $request->input('query.generalSearch', null);
        $perpage = $request->input('pagination.perpage', 10);
        $sortOrder = $request->input('sort.sort', 'desc');
        $sortField = $request->input('sort.field', 'id');
        $offset = ($page - 1) * $perpage;
        $query = UserLog::query();
        $query->where('user_id', $id);

        $totalCount = $query->count();

        $query->offset($offset)
            ->limit($perpage)
            ->orderBy($sortField, $sortOrder);
        $data = $query->get();
        $request->offsetSet('pages', ceil($totalCount / $perpage));
        $request->offsetSet('total', $totalCount);

        return (new UserLogCollection($data))->response()->setStatusCode(200);

    }

    public function update(UserRequest $request, $id)
    {

        try {
            $newUser = User::find($id);
            $old_is_agent = $newUser->is_agent;
            $old_verified = $newUser->verified;
            $newUser->name = $request->name;
            $newUser->email = $request->email;
            $newUser->phone = $request->phone;
            $newUser->level = $request->level;
            $newUser->available_balance = $request->available_balance;
            $newUser->pinding_balance = $request->pinding_balance;
            $newUser->total_balance = $request->pinding_balance + $request->available_balance;
            $newUser->reference_code = $request->reference_code;
            $newUser->status = $request->has('status') ? 'active' : 'not_active';
            $newUser->verified = $request->has('verified') ? $request->verified : 0;
            //  $newUser->password = bcrypt($request->password);
            $newUser->is_agent = $request->has('is_agent') ? $request->is_agent : '0';
            $newUser->in_review = '0';

            //  $newUser->password = bcrypt($request->password);
            $newUser->balance_withdrawal = $request->balance_withdrawal;
            $newUser->save();
            if (!empty($newUser->reference_code)) {
                $newUser->createCoupon();
            }
            if ($old_is_agent != $newUser->is_agent) {
                $msg = "";
                if ($newUser->is_agent == '1') {
                    $msg = "تم الموافقة على طلب الوكالة الذي قدمته (السجل التجاري)";
                }
                if ($newUser->is_agent == '0') {
                    $msg = "تم رفض طلب الوكالة الذي قدمته (السجل التجاري)";
                }
                $message = [
                    'message' => $msg,
                    'link' => route('user.profile'),
                ];
                Notification::send($newUser, new \App\Notifications\NotifyAgent([], $message));
            }
            if ($old_verified != $newUser->verified) {
                $msg = "";
                if ($newUser->verified == '1') {
                    $msg = "تم الموافقة على طلب توثيق الحساب الذي قدمته (الهوية الشخصية)";
                }
                if ($newUser->verified == '0') {
                    $msg = "تم رفض طلب توثيق الحساب الذي قدمته (الهوية الشخصية)";
                }
                $message = [
                    'message' => $msg,
                    'link' => route('user.profile'),
                ];
                Notification::send($newUser, new \App\Notifications\NotifyAgent([], $message));
            }
            if ($request->level == 'provider') {
                return redirect(route('admin.indexProvider'))->with(['success' => 'تم التعديل بنجاح']);
            } else {
                return redirect(route('admin.indexUser'))->with(['success' => 'تم التعديل بنجاح']);
            }

        } catch (Throwable $throwable) {
            throw $throwable;
        }
    }

    public function createBalanceRequest($id)
    {
        $user = User::with('creditCard')->find($id);
        return view('admin.balance_requests.create', [
            'user' => $user,
        ]);

    }

    public function storeBalanceRequest(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = User::find($request->user_id);
            if ($user->balance_withdrawal == 'no') {
                return back()->with(['error' => 'عذراً لايمكنك سحب رصيد لأنه تم ايقاف سحب رصيدك من المشرفين']);
            }
            if (!$this->checkUserBalance($user)) {
                return back()->with(['error' => 'عذراً لايمكنك سحب رصيد لأنه يوجد خطأ في رصيدك يرجى اصلاح الرصيد قبل الطلب']);
            }
            if (!$this->checkUserBalancewithdrawal($user)) {
                return back()->with(['error' => 'عذراً لايمكنك سحب رصيد لأنه يوجد خطأ في رصيدك يرجى اصلاح الرصيد قبل الطلب']);
            }
            $user->available_balance = $user->available_balance - $request->amount;
            $user->total_balance = $user->total_balance - $request->amount;
            $user->update();
            $description = 'طلب سحب رصيد ';
            $this->addLog('سحب رصيد ', $description);

            $data = new BalanceRequest();
            $data->user_id = $request->user_id;
            $data->amount = $request->amount;
            $data->payment_status = $request->payment_status;
            $data->ref = $request->ref;
            $data->description = $request->description;
            if ($request->hasFile('file')) {
                $file_name = time() . Str::random(10) . '.' . $request->file('file')->getClientOriginalExtension();
                $filePath = $request->file('file')->move(public_path('files'), $file_name);
                $data->file = $file_name;
            }
            $data->save();
            DB::commit();
            $description = ' تم اضافة طلب سحب رصيد رقم  ' . $data->id . ' ';
            $this->addLog('اضافة طلب سحب رصيد ', $description);
            return back()->with('success', 'تم الطلب بنجاح');
        } catch (\Throwable $throwable) {
            DB::rollBack();
            throw $throwable;
        }
    }
}
