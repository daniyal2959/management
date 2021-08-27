<?php


namespace IAMdaniyal\Management\Classes;


use IAMdaniyal\Management\Contracts\IClass;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Route implements IClass
{

    public function generate($name, $data = null)
    {
        $routeStub = file_get_contents(__DIR__ . '/../Stubs/route.stub');
        $routeStub = Str::replace('{{plural_name}}', Str::lower(Str::plural($name)), $routeStub);
        $routeStub = Str::replace('{{model_name}}', Str::ucfirst($name), $routeStub);
        File::append(base_path('routes/web.php'), $routeStub);
    }
}
