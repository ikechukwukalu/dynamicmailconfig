<?php

namespace Ikechukwukalu\Dynamicmailconfig\Middleware;

use Closure;

class DynamicMailConfig
{
    public function handle(Request $request, Closure $next)
    {
        $app = \App::getInstance();
        $app->register('Ikechukwukalu\Dynamicmailconfig\MailServiceProvider');

        return $next($request);
    }

}
