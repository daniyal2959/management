<?php


namespace IAMdaniyal\Management\Facades\Alert;


use Illuminate\Support\Facades\Session;

class Alert
{
    public static function set($title, $content, $bootstrapColor)
    {
        Session::flash('alertAction', [
            'title' => ucwords($title),
            'content' => ucwords($content),
            'color' => $bootstrapColor,
        ]);
    }

    public static function get()
    {
        return Session::get('alertAction');
    }

    public static function show()
    {
        $information = self::get();
        return view('alert', compact('information'))->render();
    }
}
