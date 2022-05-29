<?php

namespace Novaday\Debugher\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Novaday\Debugher\Events\LogPushed;
use Novaday\Debugher\Listeners\SendToRocketChat;

class EventServiceProvider extends ServiceProvider{

    protected $listen = [
        LogPushed::class => [
            SendToRocketChat::class,
        ]
    ];

    public function boot()
    {
        parent::boot();
    }
}
