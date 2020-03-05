<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Faculty\FacultyRepositoryInterface;
use App\Repositories\Faculty\FacultyRepository;
use App\Repositories\Person\PersonRepositoryInterface;
use App\Repositories\Person\PersonRepository;
use App\Repositories\Point\PointRepositoryInterface;
use App\Repositories\Point\PointRepository;
use App\Repositories\Subject\SubjectRepositoryInterface;
use App\Repositories\Subject\SubjectRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\Home\HomeRepository;
use App\Repositories\Home\HomeRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FacultyRepositoryInterface::class,FacultyRepository::class);
        $this->app->singleton(PersonRepositoryInterface::class,PersonRepository::class);
        $this->app->singleton(PointRepositoryInterface::class,PointRepository::class);
        $this->app->singleton(SubjectRepositoryInterface::class,SubjectRepository::class);
        $this->app->singleton(UserRepositoryInterface::class,UserRepository::class);
        $this->app->singleton(HomeRepositoryInterface::class,HomeRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
