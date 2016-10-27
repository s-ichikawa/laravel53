<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Mail\Message;

class MailSample extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendgrid:sample';

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
        $send_date = Carbon::today()->format('Y-m-d');
        $user = (object)['id' => 123];
        $res = \Mail::send('emails.sendgrid_sample', [], function (Message $message) use ($user, $send_date) {
            $message
                ->subject('This is a test.')
                ->from('ichikawa.shingo.0829@gmail.com')
                ->to([
                    'ichikawa.shingo.0829@gmail.com',
                ])
                ->replyTo('ichikawa.shingo.0829+replyto@gmail.com', 'おれだ！')
                ->embedData([
                    'categories'       => ['newsletter_1'],
                    'custom_args'      => [
                        'send_date' => $send_date,
                        'user_id'   => (string)$user->id,
                    ],
                    'sandbox' => 1,
                    'personalizations' => [
                        [
                            'to'            => [
                                'email' => 'ichikawa.shingo.0829+test1@gmail.com',
                                'name'  => 'ichikawa1',
                            ],
                            'from' => [
                                'email' => 'ichikawa.shingo.0829@gmail.com'
                            ],
                            'subject' => 'subject1',
                            'substitutions' => [
                                '%fname%' => 'recipient1',
                            ],
                            'custom_args'   => [
                                'custom_args_1' => 'it is 1',
                            ],
                        ],
                    ],
                ], 'sendgrid/x-smtpapi');
        });
    }
}
