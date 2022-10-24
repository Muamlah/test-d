<?php

namespace App\Http\Controllers\Zoho;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ZohoHelper;
use App\Models\User;
class MainController extends Controller
{

    public function __construct()
    {

    }

    public function createContacts(){
        $zoho = new ZohoHelper;
        $refreshToken = $zoho->refreshToken();
        $users = User::where('added_to_zoho', '0')->limit('500')->get();
        foreach($users as $user){
            $data = [];

            $item = [
                'Last_Name' => $user->getName(),
                'Vendor_Name' => $user->getName(),
                'Email' => empty($user->email) ? '' : $user->email,
                'Phone' => $user->phone,
                'Is_Agent' => (bool) $user->is_agent,
                'In_Review' => (bool) $user->in_review,
                'Nationality' => empty($user->nationality) ? '' : $user->nationality,
                'Status' => $user->status,
                'Total_Balance' => $user->total_balance,
                'Pinding_Balance' => $user->pinding_balance,
                'Available_Balance' => $user->available_balance,
                'Instagram' => $user->instagram,
                'Facebook' => $user->facebook,
                'Twitter' => $user->twitter,
                'WhatsApp' => $user->whatsapp,
                'Description' => $user->bio,
            ];
            $data[] = $item;
            $response = $zoho->createModel('Vendors', $data);
            unset($data[0]['Vendor_Name']);
            $response2 = $zoho->createModel('Contacts', $data);
            if($response['success'] && $response2['success']){
                $user->added_to_zoho = "1";
            }
            $user->zoho_response = $response['data'];
            $user->zoho_response_code = $response['status_code'];
            echo $response['status_code'];
            $user->save();
        }

    }


}
