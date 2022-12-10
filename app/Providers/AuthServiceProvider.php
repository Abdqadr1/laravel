<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Employee;
use App\Models\User;
use App\Policies\EmployeePolicy;
use Illuminate\Auth\Access\Response;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Employee::class => EmployeePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('add-employee', function (User $user) {
            return $user->hasRole('admin')
                ? Response::allow()
                : Response::denyWithStatus(403, "You're not allowed to perform this action");
        });

        //
    }
}
