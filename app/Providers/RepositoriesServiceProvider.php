<?php

namespace App\Providers;

use App\Repositories\TagRepository;
use App\Repositories\UserRepository;
use App\Repositories\BrandRepository;
use App\Repositories\RobotsRepository;
use App\Repositories\SchemaRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Contracts\TagRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Contracts\BrandRepositoryInterface;
use App\Contracts\RobotsRepositoryInterface;
use App\Contracts\SchemaRepositoryInterface;
use App\Contracts\ProductRepositoryInterface;
use App\Contracts\CategoryRepositoryInterface;

class RepositoriesServiceProvider extends ServiceProvider
{
    protected array $repositories = [
        //Interface => Implementation
        SchemaRepositoryInterface::class => SchemaRepository::class,
        RobotsRepositoryInterface::class => RobotsRepository::class,
        CategoryRepositoryInterface::class => CategoryRepository::class,
        TagRepositoryInterface::class => TagRepository::class,
        UserRepositoryInterface::class => UserRepository::class,
        BrandRepositoryInterface::class => BrandRepository::class,
        ProductRepositoryInterface::class => ProductRepository::class
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}