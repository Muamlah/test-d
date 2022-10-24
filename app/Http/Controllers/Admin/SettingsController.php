<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fees;
use App\Models\OrderFees;
use App\Models\PublicOrder;
use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\WalletMuamlah;

use Validator;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // PREMISSIONS MIDDLEWARE
        $this->middleware('auth:admin');
        $this->middleware('canPermission:UPDATE_SETTINGS')->only('updateSettings');
        $this->middleware('canPermission:UPDATE_FEES')->only('updateFees');
    }

    public function index()
    {

        $data =Settings::first();
        return view('admin.settings.index',[
            'data'=> $data ,

        ]);
    }

    public function getFees()
    {
         $data =Fees::first();
         $data2 =Settings::first();
        return view('admin.settings.fees',[
            'data'=> $data ,
            'data2'=> $data2 ,
        ]);
    }

    public function updateFees(Request $request)
    {
        Fees::updateOrCreate( ['id' => 1], $request->all());
        Settings::updateOrCreate( ['id' => 1], ['affiliate'=>$request->affiliate]);
//        $data= Fees::first();
        \Cache::flush();
        return redirect(route('admin.fees'))->with(['success' => 'تم التعديل بنجاح']);
    }
    public function updateSettings(Request $request)
    {
        Settings::updateOrCreate( ['id' => 1], $request->all());
        $data= Settings::first();
        \Cache::flush();
        return redirect(route('admin.settings'))->with(['success' => 'تم التعديل بنجاح']);
    }





}
