<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Employee;
use App\Models\Manager;
use App\Models\Task;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('edit-task', function (Manager $manager, $task) {
            return in_array($task, $manager->tasks()->pluck('id')->toArray());
        });

        Gate::define('show-task', function (Employee $employee, $task) {
            return in_array($task, $employee->tasks()->pluck('id')->toArray());
        });
    }
}
