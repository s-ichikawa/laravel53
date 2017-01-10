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
        $filename = resource_path('docs/license.txt');

        \Mail::send('emails.embed_body_variable', [
            'img_src' => resource_path('docs/sendgrid.png')
        ], function (Message $message) use ($filename) {
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
                    'template_id'      => config('sendgrid.templates.sample'),
                    'asm'              => [
                        'group_id'          => 5221,
                        'groups_to_display' => [
                            5221,
                        ],
                    ],
                    'attachments'      => [
                        [
                            'content'  => base64_encode(file_get_contents($filename)),
                            'filename' => basename($filename),
                        ],
                    ],
                ], 'sendgrid/x-smtpapi')
            ;
        });


    }
}
