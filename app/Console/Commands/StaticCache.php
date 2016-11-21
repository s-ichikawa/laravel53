<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StaticCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'static_cache:sample';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $result = $this->getValue(function () {
            var_dump('test');
            return 'abc';
        });

        var_dump($result());
        var_dump($result());
    }

    private function getValue(callable $func)
    {
        return static function () use ($func) {
            return $func();
        };
    }
}
