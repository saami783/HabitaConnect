<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Announce;
use App\Policies\AnnouncePolicy;
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
        Announce::class => AnnouncePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::policy(Announce::class, AnnouncePolicy::class);
    }
}
