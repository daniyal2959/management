<?php

use IAMdaniyal\Management\Facades\Alert\Alert;
use Illuminate\Support\Facades\Session;

if(!function_exists('getMigrationTime')){
    function getMigrationTime(){
        $now = now();
        $month = $now->month < 10 ? '0'.$now->month : $now->month;
        $day = $now->day < 10 ? '0'.$now->day : $now->day;
        $hour = $now->hour < 10 ? '0'.$now->hour : $now->hour;
        $minute = $now->minute < 10 ? '0'.$now->minute : $now->minute;
        $second = $now->second < 10 ? '0'.$now->second : $now->second;
        return $now->year . '_' . $month . '_' . $day . '_' . $hour . $minute . $second . '_';
    }
}

if(!function_exists('setAlert')){
    function setAlert($title, $content, $bootstrapColor)
    {
        Alert::set($title, $content, $bootstrapColor);
    }
}

if(!function_exists('getAlert')){
    function getAlert()
    {
        return Alert::get();
    }
}


if(!function_exists('showAlert')){
    function showAlert()
    {
        return Alert::show();
    }
}
