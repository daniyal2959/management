<?php


namespace IAMdaniyal\Management\Classes;


use IAMdaniyal\Management\Contracts\IClass;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Controller implements IClass
{

    public function generate($name, $data = null)
    {
        $validation = $data['validation'];
        $fields = $data['fields'];

        $controllerStub = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '..\\Stubs\\controller.stub');
        $controllerStub = Str::replace('{{class}}', Str::ucfirst($name), $controllerStub);
        $controllerStub = Str::replace('{{model_name}}', Str::ucfirst($name), $controllerStub);
        $controllerStub = Str::replace('{{plural_name}}', Str::lower(Str::plural($name)), $controllerStub);
        $controllerStub = Str::replace('{{name}}', Str::lower($name), $controllerStub);
        $controllerStub = Str::replace('{{validation_data}}', $validation, $controllerStub);
        $controllerStub = Str::replace('{{fields_data}}', $fields, $controllerStub);
        File::put(app_path('Http/Controllers/' . Str::ucfirst($name) . 'Controller.php'), $controllerStub);
    }
}
