<?php

namespace App\Exports;

use App\Http\Resources\Wallet\WalletResource;
use App\Models\WalletMuamlah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Carbon\Carbon;



class WalletsExport implements FromCollection
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $date_to = null;
    protected $search_period = null;
    protected $date_from = null;

    /**
     * @param null $token
     * @param null $api_url
     */
    public function __construct($search_period, $date_from, $date_to)
    {
        $this->search_period = $search_period;
        $this->date_from = $date_from;
        $this->date_to = $date_to;
    }

    public function collection()
    {

        $query = WalletMuamlah::whereNotNull('id');
        $period = $this->search_period;

        if ($period != null) {

            if ($period == 'tody')
                $query->whereDate('created_at', Carbon::today());
            if ($period == 'week')
                $query->where('created_at', '>=', Carbon::now()->subDays(7));
            if ($period == 'month')
                $query->where('created_at', '>=', Carbon::now()->subDays(30));
            if ($period == 'year')
                $query->where('created_at', '>=', Carbon::now()->subDays(365));
        }

        if ($this->date_from != null) {
            $query->where('created_at', '>=', $this->date_from);
        }

        if ($this->date_to != null) {
            $query->where('created_at', '<=', $this->date_to);
        }




        $data = $query->get();

        $data->map(function ($item) {
            $item->order_type = $item->order_type == 'public' ? 'تعميد عام' : ($item->order_type == 'private' ? 'تعميد خاص' : 'خدمة الكترونية');
            $item->type = $item->type == 'deposit' ? 'ايداع' : 'سحب';
            //            dd($item->updated_at->toDateString());

            $item->created_at = $item->created_at->toDateString();
            $item->updated_at =  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->updated_at)->format('d-m-Y');

            //dd($item->created_at);
        });



        return $data;
    }
}
