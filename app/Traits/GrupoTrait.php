<?php

namespace App\Traits;


/**
 * Trait GrupoTrait
 * @package App\Traits
 */
trait GrupoTrait
{
///انشاء مستخدم جديد في غروبو
    /**
     * @param $phone
     * @param $password
     * @return mixed
     */
    public function createUser($phone, $password){

    $ch = curl_init(config('grupo.url'));
    $data = [
        'key' => config('grupo.key'),//You will find this in Grupo Settings
        'do' => 'createuser',
        'name' => $phone,
        'user' => $phone,
        'email' => $phone.'@email.com',
        'pass' => $password,
        'avatar' => 'https://imageurlgoeshere',
        'role' => '3',
    ];
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    curl_close($ch);
    return json_decode($res);
}
///تعديل مستخدم  في غروبو
    /**
     * @param $phone
     * @param $password
     * @return mixed
     */
    public function editUser($phone, $password){

    $ch = curl_init(config('grupo.url'));
    $data = [
        'key' => config('grupo.key'),//You will find this in Grupo Settings
        'do' => 'edituser',
        'changename' => $phone,
        'changeusername' => $phone,
        'changeemail' => $phone.'@email.com',
        'changepass' => $password,
        'avatar' => 'https://imageurlgoeshere',
        'changerole' => '3',
    ];
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    curl_close($ch);
    return json_decode($res);
}


    /**
     * @param string $name
     * @param bool $visibility // مخفي او ظاهر
     * @return mixed
     */
    public function createGroup(string $name, bool $visibility){
        //'تعميد خاص رقم #' . $tameed->id
     $ch = curl_init(config('grupo.url'));
     $data = [
         'key' => config('grupo.key'),
         'do' => 'creategroup',
         'name' => $name ,
         'password' => 0, //Specify password for password protected group
         'visibility' => $visibility, //Specify false for Secret Group
         'sendpermission' => 0, // Specify adminonly for granting send messages permission only to Group Admins & Moderators
         'unleavable' => 0,// Specify unleavable for creating Group which once joined cannot be unjoined or left
     ];
     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     $res = curl_exec($ch);
     curl_close($ch);

     return json_decode($res);
 }


    /**
     * @param int $groupId
     * @param int $user
     * @return mixed
     */
    public function addUserToGroup(int $groupId, int $user){
        $ch = curl_init(config('grupo.url'));
        $data_add_user = [
            'key' => config('grupo.key'),
            'do' => 'joingroup',
            'groupid' => $groupId,//Specify the groupid (You will find group id in gr_options table id column)
            'userid' => $user . '@email.com',
            'role' => 0,
        ];
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_add_user);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);
        return json_decode($res);
    }

}
