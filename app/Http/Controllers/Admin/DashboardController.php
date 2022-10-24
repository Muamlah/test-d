<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\eservices_orders;
use App\Models\PublicOrder;
use App\Models\PrivateOrder;
use App\Models\WalletMuamlah;
use App\Models\eservices;
use App\Models\BalanceRequest;
use \Carbon\Carbon;
use \Carbon\CarbonPeriod;
use App\Models\SearchedWord;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $data = [];
    public function __construct()
    {
        // PREMISSIONS MIDDLEWARE
        $this->middleware('canPermission:READ_STATISTICS');

    }
    public function index()
    {
        $this->data['today'] = Carbon::now()->format('Y-m-d');
        $this->data['sub_month'] = Carbon::now()->subMonth()->format('Y-m-d');
        $this->data['last_month_period'] = CarbonPeriod::create($this->data['sub_month'], $this->data['today']);
        $this->data['last_month_period2'] = CarbonPeriod::create($this->data['today'], $this->data['today']);
        $this->data['hours'] = [
            '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24'
        ];
        $this->usersTodayGrowth();
        $this->usersGrowthChart();
        $this->providersGrowthChart();
        $this->ordersGrowthChart();
        $this->ordersGrowthHourlyChart();

        // dd($this->data['orders_growth_hourly']);
        return view('admin.dashboard.index', $this->data);
    }

    // الإحصائيات الخاصة بعدد المستخدمين
    public function usersTodayGrowth(){
        $providers_count = User::whereDate('created_at', '=', $this->data['today'])->where('level', 'provider')->count();
        $users_count = User::whereDate('created_at', '=', $this->data['today'])->where('level', 'user')->count();
        $eservices_orders_count = eservices_orders::whereDate('created_at', '=', $this->data['today'])->count();
        $public_orders_count = PublicOrder::whereDate('created_at', '=', $this->data['today'])->count();
        $private_orders_count = PrivateOrder::whereDate('created_at', '=', $this->data['today'])->count();
        $this->data['users_today_count'] = $users_count;
        $this->data['providers_today_count'] = $providers_count;
        $this->data['orders_today_count'] = $eservices_orders_count + $public_orders_count + $private_orders_count;
    }

       // نمو العملاء اليومي لأخر شهر
       public function usersGrowthChart(){
        $users_growth_last_month = [];

        foreach($this->data['last_month_period'] as $period){
            $users_count = 0;
            $date_str =  (string) $period->format('Y-m-d');
            $users_count = User::whereDate('created_at', '=', $date_str)->where('level', 'user')->count();
            $users_growth_last_month[] = [
                'date' => $date_str,
                'value' => $users_count
            ];
        }
        $this->data['users_growth_day'] = "";
        $this->data['users_growth_last_month'] = $users_growth_last_month;
        if(count($users_growth_last_month)){
            $this->data['users_growth_day'] = collect($users_growth_last_month)->sortBy('value',0, true)->first();
        }
    }

    // نمو مقدمي الخدمة اليومي لأخر شهر
    public function providersGrowthChart(){
        $providers_growth_last_month = [];
        foreach($this->data['last_month_period'] as $period){
            $users_count = 0;
            $date_str =  (string) $period->format('Y-m-d');
            $users_count = User::whereDate('created_at', '=', $date_str)->where('level', 'provider')->count();
            $providers_growth_last_month[] = [
                'date' => $date_str,
                'value' => $users_count
            ];
        }
        $this->data['providers_growth_last_month'] = $providers_growth_last_month;
        $this->data['providers_growth_day'] = "";
        if(count($providers_growth_last_month)){
            $this->data['providers_growth_day'] = collect($providers_growth_last_month)->sortBy('value',0, true)->first();
        }
    }

    // نمو الطلبات اليومي لأخر شهر
    public function  ordersGrowthChart(){
        $orders_growth_last_month               = [];
        $eservices_growth_last_month            = [];
        $public_orders_growth_last_month        = [];
        $private_orders_growth_last_month       = [];
        foreach($this->data['last_month_period'] as $period){
            $users_count                = 0;
            $date_str                   =  (string) $period->format('Y-m-d');
            $eservices_orders_count     = eservices_orders::whereDate('created_at', '=', $date_str)->count();
            $public_orders_count        = PublicOrder::whereDate('created_at', '=', $date_str)->count();
            $private_orders_count       = PrivateOrder::whereDate('created_at', '=', $date_str)->count();
            $orders_growth_last_month[] = [
                'date' => $date_str,
                'value' => $eservices_orders_count + $public_orders_count + $private_orders_count
            ];
            $eservices_growth_last_month[] = [
                'date'      => $date_str,
                'value'     => $eservices_orders_count
            ];
            $public_orders_growth_last_month[] = [
                'date'      => $date_str,
                'value'     => $public_orders_count
            ];
            $private_orders_growth_last_month[] = [
                'date'      => $date_str,
                'value'     => $private_orders_count
            ];
        }
        $this->data['orders_growth_last_month']             = $orders_growth_last_month;
        $this->data['eservices_growth_last_month']          = $eservices_growth_last_month;
        $this->data['public_orders_growth_last_month']      = $public_orders_growth_last_month;
        $this->data['private_orders_growth_last_month']     = $private_orders_growth_last_month;
        $this->data['orders_growth_day'] = "";
        if(count($orders_growth_last_month)){
            $this->data['orders_growth_day'] = collect($orders_growth_last_month)->sortBy('value',0, true)->first();
        }
    }
    // نمو الطلبات الساعي لأخر شهر
    public function  ordersGrowthHourlyChart(){
        $eservices_growth_hourly        = [];
        $public_orders_growth_hourly    = [];
        $private_orders_growth_hourly   = [];
        $date_str               =  (string) $this->data['today'];
        foreach($this->data['hours'] as $hour){
            $now                        = Carbon::now();
            $date                       =  $now->setHour($hour);
            $from_date_str              =  $date->setMinute('0')->setSecond('0')->format('Y-m-d H:i:s');
            $to_date_str                =  $date->setMinute('59')->setSecond('59')->format('Y-m-d H:i:s');
            $eservices_orders_count     = eservices_orders::whereDate('created_at',$date_str)->whereTime('created_at', '>=', $from_date_str)->whereTime('created_at', '<=', $to_date_str)->count();
            $public_orders_count        = PublicOrder::whereDate('created_at',$date_str)->whereTime('created_at', '>=', $from_date_str)->whereTime('created_at', '<=', $to_date_str)->count();
            $private_orders_count       = PrivateOrder::whereDate('created_at',$date_str)->whereTime('created_at', '>=', $from_date_str)->whereTime('created_at', '<=', $to_date_str)->count();
            $eservices_growth_hourly[] = [
                'date'      => (string)$from_date_str,
                'value'     => $eservices_orders_count
            ];
            $public_orders_growth_hourly[] = [
                'date'      => (string)$from_date_str,
                'value'     => $public_orders_count
            ];
            $private_orders_growth_hourly[] = [
                'date'      => (string)$from_date_str,
                'value'     => $private_orders_count
            ];
        }
        $this->data['eservices_growth_hourly']          = $eservices_growth_hourly;
        $this->data['public_orders_growth_hourly']      = $public_orders_growth_hourly;
        $this->data['private_orders_growth_hourly']     = $private_orders_growth_hourly;
    }

    public function statistics(){
        $this->mostOrderedServices();
        $this->mostViewsServices();
        $this->mostSharesServices();
        $this->mostSearchedWords();
        $this->mostCanceledServices();
        $this->mostCompleteServices();
        $this->mostReportServices();

        return view('admin.dashboard.statistics', $this->data);
    }


    // الخدمات الأكثر طلباً
    public function mostOrderedServices(){

        $eservices_orders   = eservices_orders::select('*', \DB::raw('count(eservice_id) as total_count'))
            ->groupBy('eservice_id')->with('eservices')->orderBy('total_count','DESC');

        $eservices_orders   = $eservices_orders->limit(200)->get();


        $most_ordered_services = [];

        foreach($eservices_orders as $item){
            $most_ordered_services[] = [
                'title'     => !empty($item->eservices) ? $item->eservices->service_name : '',
                'value'     => $item->total_count,
            ];
        }
        $this->data['most_ordered_services'] = $most_ordered_services;

    }
    // الخدمات الأكثر زيارة
    public function mostViewsServices(){
        $eservices      = eservices::orderBy('views','DESC')->limit(15)->get();

        $this->data['most_views_services'] = [];
        foreach($eservices as $key => $item){
            $this->data['most_views_services'][] = [
                'title' => $item->service_name,
                'value' => $item->views === null ? 0 : $item->views,
            ];
        }
    }
    // الخدمات الأكثر مشاركة
    public function mostSharesServices(){
        $eservices      = eservices::orderBy('shares','DESC')->limit(15)->get();

        $this->data['most_shares_services'] = [];
        foreach($eservices as $key => $item){
            $this->data['most_shares_services'][] = [
                'title' => $item->service_name,
                'value' => $item->shares === null ? 0 : $item->shares,
            ];
        }
    }
     // الكلمات الأكثر بحثاً
     public function mostSearchedWords(){
        $searched_words      = SearchedWord::orderBy('count','DESC')->limit(15)->get();

        $this->data['most_searched_words'] = [];
        foreach($searched_words as $key => $item){
            $this->data['most_searched_words'][] = [
                'title' => $item->word,
                'value' => $item->count,
            ];
        }
    }
    // الخدمات الأكثر إلغاء
    public function mostCanceledServices(){

        $eservices_orders   = eservices_orders::select('*', \DB::raw('count(eservice_id) as total_count'))
            ->whereIn('status',[6,7])
            ->groupBy('eservice_id')->with('eservices')->orderBy('total_count','DESC');

        $eservices_orders   = $eservices_orders->limit(200)->get();


        $most_canceled_services = [];

        foreach($eservices_orders as $item){
            $most_canceled_services[] = [
                'title'     => !empty($item->eservices) ? $item->eservices->service_name : '',
                'value'     => $item->total_count,
            ];
        }
        $this->data['most_canceled_services'] = $most_canceled_services;

    }

    // الخدمات الأكثر تسليم
    public function mostCompleteServices(){

        $eservices_orders   = eservices_orders::select('*', \DB::raw('count(eservice_id) as total_count'))
            ->whereIn('status',[4,5])
            ->groupBy('eservice_id')->with('eservices')->orderBy('total_count','DESC');

        $eservices_orders   = $eservices_orders->limit(200)->get();


        $most_complete_services = [];

        foreach($eservices_orders as $item){
            $most_complete_services[] = [
                'title'     => !empty($item->eservices) ? $item->eservices->service_name : '',
                'value'     => $item->total_count,
            ];
        }
        $this->data['most_complete_services'] = $most_complete_services;

    }

    // الخدمات الأكثر بلاغ
    public function mostReportServices(){

        $eservices_orders   = eservices_orders::select('*', \DB::raw('count(eservice_id) as total_count'))
            ->whereIn('status',[8])
            ->groupBy('eservice_id')->with('eservices')->orderBy('total_count','DESC');

        $eservices_orders   = $eservices_orders->limit(200)->get();


        $most_report_services = [];

        foreach($eservices_orders as $item){
            $most_report_services[] = [
                'title'     => !empty($item->eservices) ? $item->eservices->service_name : '',
                'value'     => $item->total_count,
            ];
        }
        $this->data['most_report_services'] = $most_report_services;

    }

    public function order_statistics(Request $request)
    {
        $this->data['today'] = Carbon::now()->format('Y-m-d');
        $this->data['since'] = $request->since ? Carbon::parse($request->since) : Carbon::parse('2020/1/1');
        $this->data['until'] = $request->until ? Carbon::parse($request->until)    : Carbon::now();
        $this->successedOrdersChart();
        return view('admin.dashboard.order_statistics', $this->data);
    }

    // الإحصائيات الخاصة بالطلبات
    public function ordersByTypesChart(){
        $orders_by_types = [];
        $eservices_orders = eservices_orders::count();
        $public_order = PublicOrder::count();
        $private_order = PrivateOrder::count();
        $orders_by_types[] = [
            'title' => __('dashboard.eservices_orders'),
            'value' => $eservices_orders
        ];
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

    public function successedOrdersChart(){
        $successed_eservices_orders_count = eservices_orders::whereNotIn('status',[6,7])
        ->whereDate('created_at','>=',$this->data['since'])
        ->whereDate('created_at','<=',$this->data['until'])
        ->count();
        $successed_eservices_orders = [
            'title'      => "الطلبات المنجزة",
            'value'     => $successed_eservices_orders_count
        ];

        $faild_eservices_orders_count = eservices_orders::whereIn('status',[6,7])
        ->whereDate('created_at','>=',$this->data['since'])
        ->whereDate('created_at','<=',$this->data['until'])
        ->count();
        $faild_eservices_orders = [
            'title'      => "الطلبات الملغاة",
            'value'     => $faild_eservices_orders_count
        ];
        $_eservices_orders = [
            $successed_eservices_orders,
            $faild_eservices_orders
        ];
        //
        $successed_private_orders_count = PrivateOrder::whereNotIn('status_id',[6,7])
        ->whereDate('created_at','>=',$this->data['since'])
        ->whereDate('created_at','<=',$this->data['until'])
        ->count();
        $successed_private_orders = [
            'title'      => "الطلبات المنجزة",
            'value'     => $successed_private_orders_count
        ];

        $faild_private_orders_count = PrivateOrder::whereIn('status_id',[6,7])
        ->whereDate('created_at','>=',$this->data['since'])
        ->whereDate('created_at','<=',$this->data['until'])
        ->count();
        $faild_private_orders = [
            'title'      => "الطلبات الملغاة",
            'value'     => $faild_private_orders_count
        ];
        $_private_orders = [
            $successed_private_orders,
            $faild_private_orders
        ];
        //
        $successed_public_orders_count = PublicOrder::whereNotIn('status',[6,7])
        ->whereDate('created_at','>=',$this->data['since'])
        ->whereDate('created_at','<=',$this->data['until'])
        ->count();
        $successed_public_orders = [
            'title'      => "الطلبات المنجزة",
            'value'     => $successed_public_orders_count
        ];

        $faild_public_orders_count = PublicOrder::whereIn('status',[6,7])
        ->whereDate('created_at','>=',$this->data['since'])
        ->whereDate('created_at','<=',$this->data['until'])
        ->count();
        $faild_public_orders = [
            'title'      => "الطلبات الملغاة",
            'value'     => $faild_public_orders_count
        ];

        $_public_orders = [
            $successed_public_orders,
            $faild_public_orders
        ];
        //
        $successed_total_orders = [
            'title'      => "الطلبات المنجزة",
            'value'     => $successed_private_orders_count + $successed_public_orders_count + $successed_eservices_orders_count
        ];
        $faild_total_orders = [
            'title'      => "الطلبات الملغاة",
            'value'     => $faild_public_orders_count + $faild_private_orders_count + $faild_eservices_orders_count
        ];

        $_total_orders = [
            $successed_total_orders,
            $faild_total_orders
        ];
        $this->data['_total_orders'] = $_total_orders;
        $this->data['_public_orders'] = $_public_orders;
        $this->data['_private_orders'] = $_private_orders;
        $this->data['_eservices_orders'] = $_eservices_orders;

     }

     public function mostCommonWords(){
         $words = [];
         $not_in = ["طلب",'الغاء','عليكم','بلاغ','السلام','تجربة','الله','ريال','الاسم','وبركاته','سلام','ورحمة'];
         $eservices_words = \DB::select("
            select substring_index(substring_index(r.details, ' ', n.index), ' ', -1) as word,
            count(*) AS c
            from eservices_orders r join
                iterator n
                on n.index <= length(r.details) - length(replace(r.details, ' ', '')) + 1
                WHERE (substring_index(substring_index(r.details, ' ', n.index), ' ', -1)) NOT IN ('".implode("','",$not_in)."')
                AND CHAR_LENGTH(substring_index(substring_index(r.details, ' ', n.index), ' ', -1)) > 3
                group by word ORDER BY c DESC LIMIT 25;
         ");
         $private_words = \DB::select("
            select substring_index(substring_index(r.details, ' ', n.index), ' ', -1) as word,
            count(*) AS c
            from private_orders r join
                iterator n
                on n.index <= length(r.details) - length(replace(r.details, ' ', '')) + 1
                WHERE (substring_index(substring_index(r.details, ' ', n.index), ' ', -1)) NOT IN ('".implode("','",$not_in)."')
                AND CHAR_LENGTH(substring_index(substring_index(r.details, ' ', n.index), ' ', -1)) > 3
                group by word ORDER BY c DESC LIMIT 25;
        ");
        $public_words = \DB::select("
            select substring_index(substring_index(r.details, ' ', n.index), ' ', -1) as word,
            count(*) AS c
            from public_orders r join
                iterator n
                on n.index <= length(r.details) - length(replace(r.details, ' ', '')) + 1
                WHERE (substring_index(substring_index(r.details, ' ', n.index), ' ', -1)) NOT IN ('".implode("','",$not_in)."')
                AND CHAR_LENGTH(substring_index(substring_index(r.details, ' ', n.index), ' ', -1)) > 3
                group by word ORDER BY c DESC LIMIT 25;
        ");

         foreach($eservices_words as $word){
            if(isset($words[$word->word])){
                $count += $words[$word->word] + $word->c;
            }else{
                $count = $word->c;
            }
            $words[$word->word] = $count;
        }
        foreach($private_words as $word){
            if(isset($words[$word->word])){
                $count += $words[$word->word] + $word->c;
            }else{
                $count = $word->c;
            }
            $words[$word->word] = $count;
        }
        foreach($public_words as $word){
            if(isset($words[$word->word])){
                $count += $words[$word->word] + $word->c;
            }else{
                $count = $word->c;
            }
            $words[$word->word] = $count;
        }
        arsort($words);
        return view('admin.dashboard.most_common_words',compact('words'));
     }

}
