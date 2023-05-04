<?php

namespace App\Providers;

use App\Models\PaymentOrder;
use App\Models\Receipt;
use App\Models\User;
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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit-receipt', function (User $user, Receipt $receipt) {
            return 
                today() <= $receipt->created_at
                && $receipt->created_by == $user->id
                ||
                $user->hasPermissionTo('receipt.edit');
        });

        Gate::define('edit-payment_order', function (User $user, PaymentOrder $payment_order) {
            return
                today() <= $payment_order->created_at
                && $payment_order->created_by == $user->id
                ||
                $user->hasPermissionTo('payment_order.edit');
        });
    }
}
