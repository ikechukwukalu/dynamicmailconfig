<?php

namespace Ikechukwukalu\Dynamicmailconfig\Middleware;

use Closure;
use Illuminate\Http\Request;

class DynamicMailConfig
{
    public function handle(Request $request, Closure $next)
    {
        $app = \App::getInstance();
        $app->register('Ikechukwukalu\Dynamicmailconfig\MailServiceProvider');

        return $next($request);
    }

}
