<?php

namespace IAMdaniyal\Management\Commands;

use IAMdaniyal\Management\Generator\Generator;
use IAMdaniyal\Management\Parser\Parser;
use Illuminate\Console\Command;
use Symfony\Component\Console\Output\ConsoleOutput;

class FactoryCrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:factory {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create CRUD Factory';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $parser = new Parser();
        $parser->parse();
        Generator::generateFactory($this->argument('name'), $this->option('scheme'));
        return 0;
    }
}
