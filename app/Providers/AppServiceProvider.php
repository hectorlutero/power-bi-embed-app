<?php

namespace App\Providers;

use App\Models\Contract;
use App\Models\Expense;
use App\Models\Partner;
use App\Models\User;
use App\Policies\ContractPolicy;
use App\Policies\ExpensePolicy;
use App\Policies\PartnerPolicy;
use App\Policies\UserPolicy;
use App\Repositories\ContractEloquentORM;
use App\Repositories\Contracts\ContractRepositoryInterface;
use App\Repositories\Contracts\ExpenseRepositoryInterface;
use App\Repositories\Contracts\PartnerRepositoryInterface;
use App\Repositories\ExpenseEloquentORM;
use App\Repositories\PartnerEloquentORM;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    protected $policies = [
        Expense::class => ExpensePolicy::class,
        Partner::class => PartnerPolicy::class,
        User::class => UserPolicy::class,
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            ExpenseRepositoryInterface::class,
            ExpenseEloquentORM::class
        );

        $this->app->bind(
            PartnerRepositoryInterface::class,
            PartnerEloquentORM::class,
        );

        $this->app->bind(
            ContractRepositoryInterface::class,
            ContractEloquentORM::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url') . "/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Expense::class, ExpensePolicy::class);
        Gate::policy(Partner::class, PartnerPolicy::class);
        Gate::policy(Contract::class, ContractPolicy::class);
    }
}
