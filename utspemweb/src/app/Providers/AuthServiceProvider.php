<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Guru;
use App\Policies\GuruPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Models\Guru::class => \App\Policies\GuruPolicy::class,
    ];    

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
