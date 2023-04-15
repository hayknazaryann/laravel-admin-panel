<?php

namespace App\Providers;

use App\Repositories\Eloquent;
use App\Repositories\Eloquent\CompanyRepository;
use App\Repositories\Eloquent\EmployeeRepository;
use App\Repositories\Interfaces\CompanyInterface;
use App\Repositories\Interfaces\EmployeeInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    public $bindings = [
        // Eloquent
        CompanyInterface::class => CompanyRepository::class,
        EmployeeInterface::class => EmployeeRepository::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
