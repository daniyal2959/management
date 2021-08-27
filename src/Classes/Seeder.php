<?php


namespace IAMdaniyal\Management\Classes;


use IAMdaniyal\Management\Contracts\IClass;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Seeder implements IClass
{
    public $seedCount = 10;
    public function generate($name, $data = null)
    {
        $seederStub = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '..\\Stubs\\seeder.stub');
        $seederStub = Str::replace('{{class}}', Str::ucfirst($name), $seederStub);
        $seederStub = Str::replace('{{model_name}}', Str::ucfirst($name), $seederStub);
        $seederStub = Str::replace('{{seed_count}}', $this->seedCount, $seederStub);
        File::put(database_path('seeders/' . Str::ucfirst($name) . 'Seeder.php'), $seederStub);
    }
}
