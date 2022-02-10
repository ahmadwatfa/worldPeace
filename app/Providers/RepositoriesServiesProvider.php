<?php

namespace App\Providers;

use App\Repository\CustomerRepository;
use App\Repository\CustomerRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
    }
}
