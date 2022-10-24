<?php

namespace App\Providers;

use App\Models\PrivateOrder;
use App\Models\PublicOrder;
use App\Policies\Website\PrivateOrderPolicy;
use App\Policies\Website\PublicOrderPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        PrivateOrder::Class=>PrivateOrderPolicy::Class,
        PublicOrder::Class=>PublicOrderPolicy::Class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
