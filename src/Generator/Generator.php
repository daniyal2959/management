<?php


namespace IAMdaniyal\Management\Generator;


use IAMdaniyal\Management\Classes\Controller;
use IAMdaniyal\Management\Classes\Factory;
use IAMdaniyal\Management\Classes\Migration;
use IAMdaniyal\Management\Classes\Model;
use IAMdaniyal\Management\Classes\Route;
use IAMdaniyal\Management\Classes\Seeder;
use Symfony\Component\Console\Output\ConsoleOutput;


class Generator
{
    private $name;
    private $parsed;
    private $seedCount;

    public function __construct($name, $parsed, $seedCount)
    {
        $this->name = $name;
        $this->parsed = $parsed;
        $this->seedCount = $seedCount;
    }

    public function generate()
    {
        $this->generateModel();
        $this->generateMigration();
        $this->generateController();
        $this->generateRoute();
        $this->generateFactory();
        $this->generateSeeder();
    }

    public function generateModel()
    {
        $model = new Model();
        $model->generate($this->name);

        $out = new ConsoleOutput();
        $out->writeln("Model Created Successfully");
    }

    public function generateMigration()
    {
        $data = implode("\n", $this->parsed['migration']);
        $migration = new Migration();
        $migration->generate($this->name, $data);

        $out = new ConsoleOutput();
        $out->writeln("Migration Created Successfully");
    }

    public function generateController()
    {
        $data = [
            'validation' => implode("\n", $this->parsed['validation']) ,
            'fields' => implode("\n", $this->parsed['fields'])
        ];

        $controller = new Controller();
        $controller->generate($this->name, $data);

        $out = new ConsoleOutput();
        $out->writeln("Controller Created Successfully");
    }

    public function generateRoute()
    {
        $route = new Route();
        $route->generate($this->name);

        $out = new ConsoleOutput();
        $out->writeln("Route Append Successfully");
    }

    public function generateFactory()
    {
        $data = implode("\n", $this->parsed['factory']);
        $factory = new Factory();
        $factory->generate($this->name, $data);

        $out = new ConsoleOutput();
        $out->writeln("Factory Created Successfully");
    }

    public function generateSeeder()
    {
        $seeder = new Seeder();
        $seeder->seedCount = $this->seedCount;
        $seeder->generate($this->name);

        $out = new ConsoleOutput();
        $out->writeln("Seeder Created Successfully");
    }
}
