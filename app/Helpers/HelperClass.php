<?php
namespace App\Helpers;

class HelperClass
{
    static function strtoslug($string){
        return str_replace(['_',' ', '"', "'", "?" , "/", "#"], "-",$string);
    }
}