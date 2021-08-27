<?php

namespace IAMdaniyal\Management\Commands;

use IAMdaniyal\Management\Parser\Parser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ManagementCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:create {name}
                                        {--scheme=}
                                        {--seed=}
                                        ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create CRUD actions';

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
        // Assemble Migration Command
        $name = $this->argument('name');
        $scheme = $this->option('scheme');
        $seed = $this->option('seed');
        $parser = new Parser($name, $scheme, $seed);
        $parser->parse();
        return false;
    }
}
