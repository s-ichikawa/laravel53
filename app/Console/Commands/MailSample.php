<?php

namespace App\Console\Commands;

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
        \Mail::send('emails.embed_body_variable', [], function (Message $message) {
            $message
                ->subject('embed subject variable')
                ->from('ichikawa.shingo.0829@gmail.com', 's-ichikawa')
                ->to([
                    'ichikawa.shingo.0829@gmail.com',
                ])
                ->replyTo('ichikawa.shingo.0829+replyto@gmail.com', 'おれだ！')
                ->embedData([
                    'personalizations' => [
                        [
                            'substitutions' => [
                                ':myname' => 's-ichikawa',
                            ],
                        ],
                    ],
                    'template_id'      => '0f35ca1c-db1f-4953-98ab-7aeeb73d1818',
                ], 'sendgrid/x-smtpapi');
        });
    }
}
