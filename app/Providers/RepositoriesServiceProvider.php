<?php

namespace App\Providers;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\FileRepository;
use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\FileRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        EloquentRepositoryInterface::class => BaseRepository::class,
        FileRepositoryInterface::class => FileRepository::class
    ];

    /**
     * Register services.
     */
    public function register(): void
    {

    }

}
