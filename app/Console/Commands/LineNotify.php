<?php

namespace App\Console\Commands;

use App\Conversion;
use App\Notifications\ConfirmOrder;
use Illuminate\Console\Command;
use NotificationChannels\LineNotify\LineNotifyMessage;

class LineNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'line:notify';

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
        $conversion = new Conversion();

        $conversion->notify(new ConfirmOrder());
    }
}
