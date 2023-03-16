<?php

namespace Ikechukwukalu\Dynamicmailconfig;

use Config;
use Ikechukwukalu\Dynamicmailconfig\Models\UserEmailConfiguration;
use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    public function register()
    {
        $mailConfig = UserEmailConfiguration::configuredEmail()->first();

        if (isset($mailConfig->id)) {
            Config::set('mail', $mailConfig->getEmailConfig());
        }
    }

    public function boot()
    {

    }

}
