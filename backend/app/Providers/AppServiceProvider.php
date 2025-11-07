<?php

namespace App\Providers;

use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Purchase\PurchaseRepository;
use App\Repositories\Purchase\PurchaseRepositoryInterface;
use App\Services\PaymentMethod\{
    CreditCardPaymentService,
    PaymentMethodServiceInterface,
    PixPaymentService,
};
use App\Services\Product\ProductService;
use App\Services\Product\ProductServiceInterface;
use App\Services\Purchase\PurchaseService;
use App\Services\Purchase\PurchaseServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);

        $this->app->bind(PaymentMethodServiceInterface::class, function ($app) {
            return collect([
                'pix' => $app->make(PixPaymentService::class),
                'credit_card' => $app->make(CreditCardPaymentService::class),
            ]);
        });
    }
}
