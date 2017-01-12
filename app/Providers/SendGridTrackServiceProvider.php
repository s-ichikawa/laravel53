<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Swift_Events_SendEvent;

class SendGridTrackServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerSwiftPlugin();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Register the Swift plugin
     *
     * @return void
     */
    protected function registerSwiftPlugin()
    {
        $this->app['mailer']->getSwiftMailer()->registerPlugin(new MailTracker());
    }
}

class MailTracker implements \Swift_Events_SendListener
{

    /**
     * Invoked immediately before the Message is sent.
     *
     * @param Swift_Events_SendEvent $evt
     */
    public function beforeSendPerformed(Swift_Events_SendEvent $evt)
    {
    }

    /**
     * Invoked immediately after the Message is sent.
     *
     * @param Swift_Events_SendEvent $evt
     */
    public function sendPerformed(Swift_Events_SendEvent $evt)
    {
        \Log::info('X-Message-ID:' . $evt->getMessage()->getHeaders()->get('x-message-id')->getFieldBody());
    }
}