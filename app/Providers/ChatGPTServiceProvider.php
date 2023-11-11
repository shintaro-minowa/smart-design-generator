<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ChatGPTService;

class ChatGPTServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ChatGPTService::class, function ($app) {
            return new ChatGPTService();
        });
    }

    public function boot()
    {
        //
    }
}
