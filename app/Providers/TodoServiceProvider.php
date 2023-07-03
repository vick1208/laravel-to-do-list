<?php

namespace App\Providers;

use App\Services\Implement\TodolistServiceImp;
use App\Services\TodolistService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TodoServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        TodolistService::class => TodolistServiceImp::class
    ];
    public function provides():array
    {
        return [TodolistService::class];
    }
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
