<?php

namespace Lingxi\Hashids\Console\Commands;

use Lingxi\Hashids\Hashids;
use Illuminate\Console\Command;

class EncodeId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'id:en {trueId : The id you want encode}
                            {--uri= : Url you want go}
                            {--connection= : hashid connection}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Encode a true id or return a full url';

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
        $this->line('Give you a secret, go your browser.');

        $connection = $this->option('connection');

        if ($this->option('uri')) {
            $result = config('app.url') . '/' . $this->option('uri') . '/' . Hashids::publicId($this->argument('trueId'));
        } else {
            $result = Hashids::publicId($this->argument('trueId'));
        }

        $this->info($result);
    }
}
