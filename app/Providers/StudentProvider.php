<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//use App\Interfaces\StudentRepositoryInterface;
//use App\Repositories\StudentRepository;

use App\Interfaces\StudentRepositoryInterface;
use App\Repositories\StudentRepository;


class StudentProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
