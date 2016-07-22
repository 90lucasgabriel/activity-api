<?php

namespace CodeProject\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades;
use CodeProject\Entities\ProjectTask;
use Illuminate\Support\Facades\Event;
use CodeProject\Events\TaskWasIncluded;
use CodeProject\Events\TaskWasUpdated;

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
        ProjectTask::updated(function($task){
            Event::fire(new TaskWasUpdated($task));
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
