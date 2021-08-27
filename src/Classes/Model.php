<?php


namespace IAMdaniyal\Management\Classes;


use IAMdaniyal\Management\Contracts\IClass;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Model implements IClass
{

    public function generate($name, $data = null)
    {
        $modelStub = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '..\\Stubs\\model.stub');
        $modelStub = Str::replace('{{class}}', Str::ucfirst($name), $modelStub);
        $modelStub = Str::replace('{{table}}', Str::lower(Str::plural($name)), $modelStub);
        File::put(app_path('Models/' . Str::ucfirst($name) . '.php'), $modelStub);
    }
}
