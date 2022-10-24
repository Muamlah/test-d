<?php

namespace App\Http\Controllers\API\Helpers;

trait ReturnApi
{


    //*START* Return Api result 'json' with messages  >>>>>>>>>>>>>>>

    public function Error($code, $msg)
    {
        return response()->json([
            'success' => "false",
            'code'   => $code,
            "message"=> $msg
        ]);
    }


    public function Success($msg = "success", $code = "S000")
    {
        return [
            'success' => "true",
            'code'   => $code,
            "message"=> $msg
        ];
    }

    public function Data($key, $value,$code, $msg = "" ,$page=0 ,$count=0 ,$lastPage=0)
    {
        if($page)
        {
            return response()->json([
                'success' => "true",
                "status"  =>200,
                'code      :'  => $code,
                'Total     : ' => $count,
                'Page      : ' => $page,
                'Last page : ' => $lastPage,
                "message"      => $msg,
                 $key          => $value
            ]);
        }

        return response()->json([
            'success' => "true",
            "status"      =>200,
            'code   : '   => $code,
            "message"     => $msg,
             $key         => $value
        ]);
    }

    //*END*   >>>>>>>>>>>>>>>



    //*START* Input Errors  >>>>>>>>>>>>>>>
    
    public function returnValidationError($code = "E001", $validator)
    {
        return $this->Error($code, $validator->errors()->first());
    }


    public function returnCodeAccordingToInput($validator)
    {
        $inputs  =  array_keys($validator->errors()->toArray());
        $code    =  $this->getErrorCode($inputs[0]);
        return $code;
    }

    public function getErrorCode($input)
    {
        if ($input == "email")
            return 'E001';

        else if ($input == "password")
            return 'E002';

        else if ($input == "phone")
            return 'E003';

        else if ($input == "requestCode")
            return 'E004';
            
        else if ($input == "typeUser")
        return 'E004';
        
        else
            return "";
    }
    //*END* Input Errors  >>>>>>>>>>>>>>>

    public function validationInputs($inputs = []){
        $rules      = [];
        $messages   = [];
        
        foreach($inputs as $key => $input){
            switch ($input) {

                case "order_id":
                    $rules['order_id']                  = 'required|integer|min:1|max:9999999999';
                    $messages['order_id.required']      = 'order_id_is_required';
                    $messages['order_id.max']           = 'order_id_may_not_be_greater_than_9999999999';
                    $messages['order_id.min']           = 'order_id_must_be_at_least_1';
                    $messages['order_id.integer']       = 'order_id_must_be_a_integer';
                break;
                
                case "public_offer_id":
                    $rules['public_offer_id']                  = 'required|integer|min:1|max:9999999999';
                    $messages['public_offer_id.required']      = 'public_offer_id_is_required';
                    $messages['public_offer_id.max']           = 'public_offer_id_may_not_be_greater_than_9999999999';
                    $messages['public_offer_id.min']           = 'public_offer_id_must_be_at_least_1';
                    $messages['public_offer_id.integer']       = 'public_offer_id_must_be_a_integer';
                break;

                case "section_id":
                    $rules['section_id']                        = 'required|integer|min:1|max:9999999999';
                    $messages['section_id.required']            = 'section_id_is_required';
                    $messages['section_id.max']                 = 'section_id_may_not_be_greater_than_9999999999';
                    $messages['section_id.min']                 = 'section_id_must_be_at_least_1';
                    $messages['section_id.integer']             = 'section_id_must_be_a_integer';
                break;

                case "email":
                    
                    if($key === 'unique'){
                        $rules['email']                 = 'required|email|max:191|min:8|unique:users,email';
                        $messages['email.unique']       = 'email_has_already_been_taken';
                    }elseif($key === 'not_unique'){
                        $rules['email']                 = 'required|email|max:191|min:8';
                    }elseif($key === 'unique2'){
                        $rules['email']                 = 'required|email|max:191|min:8|unique:users,email';
                        $messages['email.unique']       = 'email_has_already_been_taken';
                    }else{
                        $rules['email']                 = 'required|email|max:191|min:8|unique:users,email,'.$key;
                        $messages['email.unique']       = 'email_has_already_been_taken';
                    }
                    $messages['email.required']         = 'email_is_required';
                    $messages['email.email']            = 'email_must_be_valid_email_address';
                    $messages['email.max']              = 'email_may_not_be_greater_than_191_characters';
                    $messages['email.min']              = 'email_must_be_at_least_8_characters';
                    break;

                case "password":
                    $rules['password']                  = 'required|string|max:20|min:4';
                    $messages['password.required']      = 'password_is_required';
                    $messages['password.string']        = 'password_must_be_a_string';
                    $messages['password.max']           = 'password_may_not_be_greater_than_191_characters';
                    $messages['password.min']           = 'password_must_be_at_least_8_characters';
                    break;

                case "user_password":
                    $rules['user_password']             = 'nullable|string|max:20|min:4';
                    $messages['user_password.max']      = 'user_password_may_not_be_greater_than_191_characters';
                    $messages['user_password.min']      = 'user_password_must_be_at_least_8_characters';
                    $messages['user_password.string']   = 'user_password_must_be_a_string';

                    break;

                case "phone":
                    if($key === 'unique'){
                        $rules['phone']                 = 'required|numeric|max:999999999999999999|min:999|unique:users,phone';
                        $messages['phone.unique']       = 'phone_has_already_been_taken';
                    }elseif($key === 'not_unique'){
                        $rules['phone']                 = 'required|numeric|max:999999999999999999|min:999';
                    }else{
                        
                        $rules['phone']                 = 'required|numeric|max:999999999999999999|min:999|unique:users,phone,'.$key;
                        $messages['phone.unique']       = 'phone_has_already_been_taken';
                    }
                    // $rules['phone']                 = 'required|numeric|max:999999999999999999|min:999';
                    $messages['phone.required']     = 'phone_is_required';
                    $messages['phone.max']          = 'phone_may_not_be_greater_than_999999999999999999';
                    $messages['phone.min']          = 'phone_must_be_at_least_999_characters';
                    $messages['phone.numeric']      = 'phone_must_be_a_number';
                    break;

                case "level":
                    $rules['level']                 = 'required|in:user,provider|string|max:20|min:4';
                    $messages['level.required']     = 'level_is_required';
                    $messages['level.max']          = 'level_may_not_be_greater_than_191_characters';
                    $messages['level.min']          = 'level_must_be_at_least_8_characters';
                    $messages['level.in']           = 'level_must_be_user_or_provider';
                    break;

                case "title":
                    $rules['title']                 = 'required|string|max:255|min:3';
                    $messages['title.required']     = 'title_is_required';
                    $messages['title.max']          = 'title_may_not_be_greater_than_255_characters';
                    $messages['title.min']          = 'title_must_be_at_least_3_characters';
                    $messages['title.string']       = 'title_must_be_a_string';
                    break;

                case "details":
                    $rules['details']               = 'required|string|max:10000|min:3';
                    $messages['details.required']   = 'details_is_required';
                    $messages['details.max']        = 'details_may_not_be_greater_than_10000_characters';
                    $messages['details.min']        = 'details_must_be_at_least_3_characters';
                    $messages['details.string']     = 'details_must_be_a_string';
                    break;

                case "date":
                    $rules['date']                  = 'required|string|max:45|min:1';
                    $messages['date.required']      = 'date_is_required';
                    $messages['date.max']           = 'date_may_not_be_greater_than_45_characters';
                    $messages['date.min']           = 'date_must_be_at_least_1_characters';
                    $messages['date.string']        = 'date_must_be_a_string';
                    break;

                case "time":
                    $rules['time']                  = 'required|string|max:45|min:1';
                    $messages['time.required']      = 'time_is_required';
                    $messages['time.max']           = 'time_may_not_be_greater_than_45_characters';
                    $messages['time.min']           = 'time_must_be_at_least_1_characters';
                    $messages['time.string']        = 'time_must_be_a_string';
                    break;
                    
                case "price":
                    $rules['price']                 = 'required|numeric|max:9999999|min:0';
                    $messages['price.required']     = 'price_is_required';
                    $messages['price.max']          = 'price_may_not_be_greater_than_9999999';
                    $messages['price.min']          = 'price_must_be_at_least_0_characters';
                    $messages['price.numeric']      = 'price_must_be_a_number';
                    break;

                case "name":
                    $rules['name']                 = 'required|string|max:255|min:3';
                    $messages['name.required']     = 'name_is_required';
                    $messages['name.max']          = 'name_may_not_be_greater_than_255_characters';
                    $messages['name.min']          = 'name_must_be_at_least_3_characters';
                    $messages['name.string']       = 'name_must_be_a_string';
                    break;

                case "bank_name":
                    $rules['bank_name']                     = 'required|string|max:255|min:3';
                    $messages['bank_name.required']         = 'bank_name_is_required';
                    $messages['bank_name.max']              = 'bank_name_may_not_be_greater_than_255_characters';
                    $messages['bank_name.min']              = 'bank_name_must_be_at_least_3_characters';
                    $messages['bank_name.string']           = 'bank_name_must_be_a_string';
                    break;

                case "account_number":
                    $rules['account_number']                = 'required|string|max:255|min:3';
                    $messages['account_number.required']    = 'account_number_is_required';
                    $messages['account_number.max']         = 'account_number_may_not_be_greater_than_255_characters';
                    $messages['account_number.min']         = 'account_number_must_be_at_least_3_characters';
                    $messages['account_number.string']      = 'account_number_must_be_a_string';
                    break;

                case "image":
                    $rules['image']                     = 'required|image|mimes:jpeg,png,jpg|max:1024';
                    $messages['image.required']         = 'image_is_required';
                    $messages['image.image']            = 'image_must_be_a_image';
                    $messages['image.max']              = 'image_may_not_be_greater_than_1024_kb';
                    $messages['image.mimes']            = 'image_must_be_png_or_jpg_ir_jpeg';
                    break;
                default:
                
            }
        }
        return ['rules' => $rules , 'messages' => $messages];
    }

    public function validationResponse($validator){

        // $data                       = [];
        // $data['message']            = 'fail';
        // $data['data']['result']     = '';
        // $data['errors']['global']   = 'validation_error';

        // $messages = $validator->messages()->toArray();

        // foreach($messages as $key => $value){
        //     $data['errors'][$key] = $value[0];
        // }

        // return $data;

        $data                       = [];
        $messages = $validator->messages()->toArray();

        $data['success']    = false;
        $data['data']       = null;
        $data['status']     = 401;
        foreach($messages as $key => $value){
            $data['message'] = $value[0];
        }

        return $data;
    }
    
    public function errorResponse($error = 'an_error_occurred'){

        $data                       = [];
        $data['message']            = 'fail';
        $data['data']['result']     = '';
        $data['errors']['global']   = $error;

        return $data;
    }

    public function successResponse($object = '' , $type = '' , $second_oject = '' , $second_type = '' , $third_oject = '' , $third_type = ''){

        $data                           = [];
        $data['success']                = true;
        if(empty($type)){
            $data['data']               = $object;
        }else{
            $data['data'][$type]            = $object;
        }
        if(!empty($second_type)){
            $data['data'][$second_type] = $second_oject;
        }
        if(!empty($third_type)){
            $data['data'][$third_type] = $third_oject;
        }
        $data['status']                 = 200;
        $data['message']                = 'success';
        // $data['errors']['global']       = '';

        return $data;

    }

}