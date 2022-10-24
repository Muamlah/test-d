<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\API\Helpers\ReturnApi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\eservices;
use App\Models\sections;
use App\Models\Settings;

class ServicesController extends Controller
{

    use ReturnApi;

    public function __construct()
    {
        $this->middleware(['jwt.auth'], ['except' => ['eservices','dataBySection']]);
    }

    public function eservices(Request $request){

        try{

            $status             = Settings::getSetting('eservices_orders_status');
            if($status != 'active'){
                $response       = $this->errorResponse('status_not_avtive');
                return response()->json($response, 200);
            }

            $sections           = sections::all();
            $eservices_count    = eservices::count();

            $response = $this->successResponse($sections,'sections');
            return response()->json($response, 200);

        }
    
        catch (\Exception $e) {
            $response       = $this->errorResponse($e->getMessage());
            return response()->json($response, 200);
        }
    }
   
   public function dataBySection(Request $request){

       try{

            $inputs         = ['section_id'];
            $validate       = $this->validationInputs($inputs);

            $validator      = Validator::make($request->all(), $validate['rules'] , $validate['messages']);
            if($validator->fails()){
                $response       = $this->validationResponse($validator);
                return response()->json($response, 200);
            }

            $section        = sections::find($request->section_id);
            $eservices      = eservices::where('section_id', $request->section_id)->orderBy('updated_at', 'DESC')->paginate(10);

            $response = $this->successResponse($eservices,'eservices',$section,'section');
            return response()->json($response, 200);

            // $service = eservices::findorfail($id);
            // return $this->Data('service',$service,'s011');
        }
        
        catch (\Exception $e) {
            $response       = $this->errorResponse($e->getMessage());
            return response()->json($response, 200);
        }
    }
   
}
