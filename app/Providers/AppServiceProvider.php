<?php

namespace CodeProject\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades;
use CodeProject\Entities\ProjectTask;
use Illuminate\Support\Facades\Event;
use CodeProject\Events\TaskWasIncluded;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(){
        ProjectTask::created(function($task){
            Event::fire(new TaskWasIncluded($task));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
