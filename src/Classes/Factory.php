<?php


namespace IAMdaniyal\Management\Classes;


use IAMdaniyal\Management\Contracts\IClass;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Factory implements IClass
{
    public function generate($name, $data = null)
    {
        $factoryStub = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '..\\Stubs\\factory.stub');
        $factoryStub = Str::replace('{{class}}', Str::ucfirst($name), $factoryStub);
        $factoryStub = Str::replace('{{model_name}}', Str::ucfirst($name), $factoryStub);
        $factoryStub = Str::replace('{{factory_definition}}', $data, $factoryStub);
        File::put(database_path('factories/' . Str::ucfirst($name) . 'Factory.php'), $factoryStub);
    }
}
