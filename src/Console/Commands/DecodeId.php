<?php

namespace Lingxi\Hashids\Console\Commands;

use Lingxi\Hashids\Hashids;
use Illuminate\Console\Command;

class DecodeId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'id:de {publicId : The public id you want decode}
                            {--connection= : hashid connection}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Decode a true id';

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
     * @return mixed
     */
    public function handle()
    {
        $this->line('Give you a true id.');

        $connection = $this->option('connection');

        $this->info(Hashids::trueId($this->argument('publicId'), $connection));
    }
}
