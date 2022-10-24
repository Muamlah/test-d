<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
//use App\Models\eservices_orders;
use App\Models\PublicOrder;
use App\Models\PrivateOrder;
use App\Models\WalletMuamlah;
//use App\Models\eservices;
use App\Models\BalanceRequest;
use \Carbon\Carbon;
use \Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $data = [];
    public function index(Request $request)
    {

        $this->data['since'] = $request->since ? Carbon::parse($request->since) : Carbon::parse('2020/1/1');
        $this->data['until'] = $request->until ? Carbon::parse($request->until)    : Carbon::now();
        $this->data['now'] = Carbon::now();
        $this->data['today'] = Carbon::now()->format('Y-m-d');
        $this->data['hours'] = [
            '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24'
        ];
        $this->data['days'] = [
            '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'
        ];
        $this->data['days'] = [
            "Sat" => "السبت",
            "Sun" => "الأحد",
            "Mon" => "الأثنين",
            "Tue" => "الثلاثاء",
            "Wed" => "الأربعاء",
            "Thu" => "الخميس",
            "Fri" => "الجمعة",
        ];
        $this->usersChartsChart();
        $this->ordersByTypesChart();
        $this->ordersByStatusChart();
        $this->balanceChart();
        $this->ordersGrowthDailyChart();
        $this->ordersGrowthHourlyChart();
        $this->popularUsers();
        $this->numbers();
        $this->newOrders();
        $this->usersBalance();
        return view('admin.home.index', $this->data);
    }
    // الاحصائيات الخاصة بالمستخدمين اصحاب الارصدة الخاطئة
    public function usersBalance(){
        $this->data['users_balance'] = User::
            whereRaw('available_balance + pinding_balance != total_balance')
            ->orWhere('total_balance','<',0)->orWhere('available_balance','<',0)->orWhere('pinding_balance','<',0)->where('level', 'user')
            ->count();
    }

    // الإحصائيات الخاصة بأنوع المستخدمين
    public function usersChartsChart(){
        $users_by_types = [];
        $providers_count = User::where('status', 'active')->where('level', 'provider')->count();
        $users_count = User::where('status', 'active')->where('level', 'user')->count();
        $users_by_types[] = [
            'title' => __('dashboard.providers'),
            'value' => $providers_count
        ];
        $users_by_types[] = [
            'title' => __('dashboard.users'),
            'value' => $users_count
        ];
        $this->data['users_by_types'] = $users_by_types;
    }

    // الإحصائيات الخاصة بالطلبات
    public function ordersByTypesChart(){
        $orders_by_types = [];
//        $eservices_orders = eservices_orders::count();
        $public_order = PublicOrder::count();
        $private_order = PrivateOrder::count();
//        $orders_by_types[] = [
//            'title' => __('dashboard.eservices_orders'),
//            'value' => $eservices_orders
//        ];
        $orders_by_types[] = [
            'title' => __('dashboard.public_order'),
            'value' => $public_order
        ];
        $orders_by_types[] = [
            'title' => __('dashboard.private_order'),
            'value' => $private_order
        ];
        $this->data['orders_by_types'] = $orders_by_types;
    }

    // الإحصائيات الخاصة بالطلبات حسب الحالات
    public function ordersByStatusChart(){
//        $eservices_orders_by_status = eservices_orders::selectRaw("
//        SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) AS pending,
//        SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) AS waiting,
//        SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) AS processing,
//        SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) AS canceled,
//        SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) AS confirm_canceled,
//        SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) AS completed,
//        SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) AS confirm_completed
//        ", [
//            '1',
//            '2',
//            '3',
//            '6',
//            '7',
//            '4',
//            '5'
//        ])->first();
//        $this->data['eservices_orders_by_status'] = [];
//        foreach($eservices_orders_by_status->getAttributes() as $key => $count){
//            $this->data['eservices_orders_by_status'][] = [
//                'title' => __('dashboard.order_status.'.$key),
//                'value' => $count
//            ];
//        }

        $public_orders_by_status = PublicOrder::selectRaw("
        SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) AS pending,
        SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) AS waiting,
        SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) AS processing,
        SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) AS canceled,
        SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) AS confirm_canceled,
        SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) AS completed,
        SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) AS confirm_completed
        ", [
            '1',
            '2',
            '3',
            '6',
            '7',
            '4',
            '5'
        ])->first();
        $this->data['public_orders_by_status'] = [];
        foreach($public_orders_by_status->getAttributes() as $key => $count){
            $this->data['public_orders_by_status'][] = [
                'title' => __('dashboard.order_status.'.$key),
                'value' => $count
            ];
        }

        $private_orders_by_status = PrivateOrder::selectRaw("
        SUM(CASE WHEN status_id = ? THEN 1 ELSE 0 END) AS pending,
        SUM(CASE WHEN status_id = ? THEN 1 ELSE 0 END) AS waiting,
        SUM(CASE WHEN status_id = ? THEN 1 ELSE 0 END) AS processing,
        SUM(CASE WHEN status_id = ? THEN 1 ELSE 0 END) AS canceled,
        SUM(CASE WHEN status_id = ? THEN 1 ELSE 0 END) AS confirm_canceled,
        SUM(CASE WHEN status_id = ? THEN 1 ELSE 0 END) AS completed,
        SUM(CASE WHEN status_id = ? THEN 1 ELSE 0 END) AS confirm_completed
        ", [
            '1',
            '2',
            '3',
            '6',
            '7',
            '4',
            '5'
        ])->first();
        $this->data['private_orders_by_status'] = [];
        foreach($private_orders_by_status->getAttributes() as $key => $count){
            $this->data['private_orders_by_status'][] = [
                'title' => __('dashboard.order_status.'.$key),
                'value' => $count
            ];
        }
    }

    // مخطط جركة الرصيد أخر شهر
    public function balanceChart(){
        $from_date = Carbon::now()->subMonths(3)->format('Y-m-d');
        $to_date = Carbon::now()->format('Y-m-d');
        $total = WalletMuamlah::where('type', 'deposit')->sum('balance') - WalletMuamlah::where('type', 'withdrawal')->sum('balance');
        $balances = WalletMuamlah::whereBetween('created_at', [$from_date, $to_date])->get();
        $periods = CarbonPeriod::create($from_date, $to_date);
        $balances_last_3months = [];
        foreach($periods as $period){
            $balance = 0;
            $date_str =  (string) $period->format('Y-m-d');
            $deposit = $balances->where('type', 'deposit')->filter(function ($item) use ($date_str) {
                return (data_get($item, 'created_at')->format('Y-m-d') == $date_str);
            })->sum('balance');
            $withdrawal = $balances->where('type', 'withdrawal')->filter(function ($item) use ($date_str) {
                return (data_get($item, 'created_at')->format('Y-m-d') == $date_str);
            })->sum('balance');
            $balance = $deposit - $withdrawal;
            $balances_last_3months[] = [
                'date' => $date_str,
                'value' => $balance
            ];
        }
        $this->data['balances_last_3months'] = $balances_last_3months;
        $this->data['total'] = $total;
    }

    // الخدمات الأكثر طلباً
    public function mostRequestedServices(){
//        $this->data['eservices'] = eservices::get();
//        $sql_array = [];
//        foreach($this->data['eservices'] as $service){
//            $sql_array[] = "SUM(CASE WHEN eservice_id = ".$service->id." THEN 1 ELSE 0 END) AS '".$service->id."'";
//        }
//        $most_requested_services = eservices_orders::selectRaw(implode(',',  $sql_array))->first();
//        $this->data['most_requested_services'] = collect([]);
//        foreach($most_requested_services->getAttributes() as $key => $count){
//            if($count > 0){
//                $this->data['most_requested_services']->push([
//                    'title' => $this->data['eservices']->where('id', $key)->first()->service_name,
//                    'value' => $count
//                ]);
//            }
//            $this->data['most_requested_services'];
//        }
    }

    // المستخدم الأكثر نشاطاً
    public function popularUsers(){
        $public_users = User::where('level', 'user')->where('active', 1)->whereHas('publicOrders')->withCount('publicOrders')->orderBy('public_orders_count', 'DESC')->limit(10)->get();
        $private_users = User::where('level', 'user')->where('active', 1)->whereHas('privateOrders')->withCount('privateOrders')->orderBy('private_orders_count', 'DESC')->limit(10)->get();
//        $eservices_users = User::where('level', 'user')->where('active', 1)->whereHas('eservicesOrders')->withCount('eservicesOrders')->orderBy('eservices_orders_count', 'DESC')->limit(10)->get();
//        $this->data['eservices_users'] = [];
//        foreach($eservices_users as $user){
//            $this->data['eservices_users'][] = [
//                'title' => (string) !is_null($user->name) ? $user->name : $user->phone,
//                'value' => $user->eservices_orders_count
//            ];
//        }
        $this->data['public_users'] = [];
        foreach($public_users as $user){
            $this->data['public_users'][] = [
                'title' => (string) !is_null($user->name) ? $user->name : $user->phone,
                'value' => $user->public_orders_count
            ];
        }
        $this->data['private_users'] = [];
        foreach($private_users as $user){
            $this->data['private_users'][] = [
                'title' => (string) !is_null($user->name) ? $user->name : $user->phone,
                'value' => $user->private_orders_count
            ];
        }
    }

    // إحصائيات الأرقام
    public function numbers(){
        $this->data['number_of_users'] = User::where('active', 1)->count();
//        $this->data['number_of_services'] = eservices::count();
        $this->data['number_of_orders'] =  PublicOrder::count() + PrivateOrder::count();
//        $this->data['number_of_eservices_orders'] = eservices_orders::with(['users', 'providers'])->whereIn('status',  ['1','2'])->count();
        $this->data['number_of_public_orders'] = PublicOrder::with(['user', 'provider'])->whereIn('status',  ['1','2'])->count();
        $this->data['number_of_private_orders'] = PrivateOrder::with(['user', 'provider'])->whereIn('status_id', ['1','2'])->count();
        $this->data['number_of_balance_orders'] = BalanceRequest::with(['user'])->where('status', '2')->count();

//        $this->data['number_of_report_eservices_orders'] = eservices_orders::with(['users', 'providers'])->where('status', 8)->count();
        $this->data['number_of_report_public_orders'] = PublicOrder::with(['user', 'provider'])->where('status', 8)->count();
        $this->data['number_of_report_private_orders'] = PrivateOrder::with(['user', 'provider'])->where('status_id', 8)->count();
    }

    // طلبات جديدة
    public function newOrders(){
//        $this->data['eservices_orders_count'] = eservices_orders::with(['users', 'providers'])->whereIn('status',  ['1','2'])->count();
        $this->data['public_orders_count'] = PublicOrder::with(['user', 'provider'])->whereIn('status', ['1','2'])->count();
        $this->data['private_orders_count'] = PrivateOrder::with(['user', 'provider'])->whereIn('status_id', ['1','2'])->count();
        $this->data['balance_orders_count'] = BalanceRequest::with(['user'])->where('status', '2')->count();
    }
    public function current_orders($type){
        switch($type){
            case 'eservices':
//                $this->data['eservices_orders'] = eservices_orders::with(['users', 'providers'])->where('pay_status','complete_convert')->where('status', '2')->orderBy('created_at', 'DESC')->paginate(10);
//                return view('admin.include.table-rows.eservices', $this->data);
//                break;
            case 'public':
                $this->data['public_orders'] = PublicOrder::with(['user', 'provider'])->whereIn('status', ['2'])->orderBy('created_at', 'DESC')->paginate(10);
                return view('admin.include.table-rows.public', $this->data);
                break;
            case 'private':
                // $this->data['private_orders'] = PrivateOrder::with(['user', 'provider'])->whereIn('status_id', ['1','2'])->orderBy('created_at', 'DESC')->paginate(10);
                // return view('admin.include.table-rows.private', $this->data);
                // break;
            case 'balance':
                // $this->data['balance_orders'] = BalanceRequest::with(['user'])->where('status', '2')->orderBy('created_at', 'DESC')->paginate(10);
                // return view('admin.include.table-rows.balance', $this->data);
                // break;
        }
    }

     // نمو الطلبات الساعي
     public function  ordersGrowthHourlyChart(){
//        $eservices_growth_hourly        = [];
        $public_orders_growth_hourly    = [];
        $private_orders_growth_hourly   = [];
//        $eservices_orders = eservices_orders::select('id', 'created_at')
//        ->whereDate('created_at','>=',$this->data['since'])
//        ->whereDate('created_at','<=',$this->data['until'])
//        ->get()
//        ->groupBy(function($date) {
//            return Carbon::parse($date->created_at)->format('H');
//        });
        $private_orders = PrivateOrder::select('id', 'created_at')
        ->whereDate('created_at','>=',$this->data['since'])
        ->whereDate('created_at','<=',$this->data['until'])
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('H');
        });
        $public_orders = PublicOrder::select('id', 'created_at')
        ->whereDate('created_at','>=',$this->data['since'])
        ->whereDate('created_at','<=',$this->data['until'])
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('H');
        });

//        foreach($eservices_orders as $key => $value){
//            $eservices_growth_hourly[$key] = [
//                'date'      => $key,
//                'value'     => count($value)
//            ];
//        }
        foreach($private_orders as $key => $value){
            $private_orders_growth_hourly[$key] = [
                'date'      => $key,
                'value'     => count($value)
            ];
        }
        foreach($public_orders as $key => $value){
            $public_orders_growth_hourly[$key] = [
                'date'      => $key,
                'value'     => count($value)
            ];
        }
        foreach($this->data['hours'] as $key => $day){
            $value = 0;
//            $value += isset($eservices_orders_growth_hourly[$key]) ? $eservices_orders_growth_hourly[$key]['value'] : 0;
            $value += isset($private_orders_growth_hourly[$key]) ? $private_orders_growth_hourly[$key]['value'] : 0;
            $value += isset($public_orders_growth_hourly[$key]) ? $public_orders_growth_hourly[$key]['value'] : 0;
            $all_orders_growth_hourly[] = [
                'date'      => $day,
                'value'     => $value
            ];
       }
//        $this->data['eservices_growth_hourly']          = $eservices_growth_hourly;
        $this->data['public_orders_growth_hourly']      = $public_orders_growth_hourly;
        $this->data['private_orders_growth_hourly']     = $private_orders_growth_hourly;
        $this->data['all_orders_growth_hourly']         = $all_orders_growth_hourly;
    }
    // نمو الطلبات اليومي
    public function  ordersGrowthDailyChart(){
       $all_orders_growth_daily        = [];
//       $eservices_orders_growth_daily        = [];
       $private_orders_growth_daily        = [];
       $public_orders_growth_daily        = [];
//       $eservices_orders = eservices_orders::select('id', 'created_at')
//       ->whereDate('created_at','>=',$this->data['since'])
//       ->whereDate('created_at','<=',$this->data['until'])
//       ->get()
//       ->groupBy(function($date) {
//           return Carbon::parse($date->created_at)->format('D');
//       });
//       foreach($eservices_orders as $key => $value){
//           $eservices_orders_growth_daily[$key] = [
//               'title'      => $key,
//               'value'     => count($value)
//           ];
//       }
       $private_orders = PrivateOrder::select('id', 'created_at')
       ->whereDate('created_at','>=',$this->data['since'])
       ->whereDate('created_at','<=',$this->data['until'])
       ->get()
       ->groupBy(function($date) {
           return Carbon::parse($date->created_at)->format('D');
       });
       foreach($private_orders as $key => $value){
           $private_orders_growth_daily[$key] = [
               'title'      => $key,
               'value'     => count($value)
           ];
       }
       $public_orders = PublicOrder::select('id', 'created_at')
       ->whereDate('created_at','>=',$this->data['since'])
       ->whereDate('created_at','<=',$this->data['until'])
       ->get()
       ->groupBy(function($date) {
           return Carbon::parse($date->created_at)->format('D');
       });
       foreach($public_orders as $key => $value){
           $public_orders_growth_daily[$key] = [
               'title'      => $key,
               'value'     => count($value)
           ];
       }
       foreach($this->data['days'] as $key => $day){
            $value = 0;
//            $value += isset($eservices_orders_growth_daily[$key]) ? $eservices_orders_growth_daily[$key]['value'] : 0;
            $value += isset($private_orders_growth_daily[$key]) ? $private_orders_growth_daily[$key]['value'] : 0;
            $value += isset($public_orders_growth_daily[$key]) ? $public_orders_growth_daily[$key]['value'] : 0;
            $all_orders_growth_daily[] = [
                'title'      => $day,
                'value'     => $value
            ];
       }
       $this->data['all_orders_growth_daily']          = $all_orders_growth_daily;
    }
}
