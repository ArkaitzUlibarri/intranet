<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Contract;
use App\Models\ContractType;
use App\Models\Project;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Policies\ContractPolicy;
use App\Policies\ContractTypePolicy;
use App\Policies\ProjectPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        ContractType::class => ContractTypePolicy::class,
        Contract::class => ContractPolicy::class,
        Category::class => CategoryPolicy::class,
        Project::class => ProjectPolicy::class,
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
