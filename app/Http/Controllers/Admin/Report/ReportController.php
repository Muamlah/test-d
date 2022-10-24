<?php

namespace App\Http\Controllers\Admin\Report;

use App\Exports\AccountsReportExport;
use Excel;
use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


/**
 *
 */
class ReportController extends Controller
{

    public function __construct()
    {

    }


    /**
     * @return View
     */
    public function create(): View
    {
        $this->data['status']=Status::get();
        return view('admin.report.create',$this->data);
    }

    public function export(Request $request)
    {
        return Excel::download(new AccountsReportExport($request->type, $request->start, $request->to, $request->status), 'muamlah-accounts-'.$request->start.'_'.$request->to.'.xlsx');



    }


}
