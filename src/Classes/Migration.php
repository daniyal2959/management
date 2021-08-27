<?php


namespace IAMdaniyal\Management\Classes;


use Carbon\Carbon;
use IAMdaniyal\Management\Contracts\IClass;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use function getMigrationTime;

class Migration implements IClass
{
    public function generate($name, $data = null)
    {
        $timeString = getMigrationTime();
        $fileName = $timeString . 'create_' . Str::lower(Str::plural($name)) . '_table';
        $className = 'Create' . Str::ucfirst(Str::plural($name)) . 'Table';

        $modelStub = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '..\\Stubs\\migration.stub');
        $modelStub = Str::replace('{{class}}', $className, $modelStub);
        $modelStub = Str::replace('{{table}}', Str::plural(Str::lower($name)), $modelStub);
        $modelStub = Str::replace('{{scheme_up}}', $data, $modelStub);
        File::put(database_path('migrations/' . $fileName . '.php'), $modelStub);
    }
}
