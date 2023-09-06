<?php

namespace App\Providers;

use App\Interfaces\Auth\AuthInterface;
use App\Interfaces\Brands\BrandsInterface;
use App\Interfaces\Categories\CategoriesInterface;
use App\Interfaces\Contacts\ContactsInterface;
use App\Interfaces\Faqs\FaqsInterface;
use App\Interfaces\Implements\ImplementInterface;
use App\Interfaces\News\NewsInterface;
use App\Interfaces\Plans\PlansInterface;
use App\Interfaces\Products\ProductsInterface;
use App\Interfaces\Profile\ProfileInterface;
use App\Interfaces\Search\SearchInterface;
use App\Interfaces\Slider\SliderInterface;
use App\Interfaces\Users\UsersInterface;
use App\Repository\Auth\AuthRepository;
use App\Repository\Brands\BrandsRepository;
use App\Repository\Categories\CategoriesRepository;
use App\Repository\Contacts\ContactsRepository;
use App\Repository\Faqs\FaqsRepository;
use App\Repository\Implements\ImplementRepository;
use App\Repository\News\NewsRepository;
use App\Repository\Plans\PlansRepository;
use App\Repository\Products\ProductsRepository;
use App\Repository\Profile\ProfileRepository;
use App\Repository\Search\SearchRepository;
use App\Repository\Slider\SliderRepository;
use App\Repository\Users\UsersRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryInterfaceServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthInterface::class,AuthRepository::class);
        $this->app->bind(ProfileInterface::class,ProfileRepository::class);
        $this->app->bind(UsersInterface::class,UsersRepository::class);
        $this->app->bind(FaqsInterface::class,FaqsRepository::class);
        $this->app->bind(BrandsInterface::class,BrandsRepository::class);
        $this->app->bind(CategoriesInterface::class,CategoriesRepository::class);
        $this->app->bind(ProductsInterface::class,ProductsRepository::class);
        $this->app->bind(NewsInterface::class,NewsRepository::class);
        $this->app->bind(ImplementInterface::class,ImplementRepository::class);
        $this->app->bind(PlansInterface::class,PlansRepository::class);
        $this->app->bind(SearchInterface::class,SearchRepository::class);
        $this->app->bind(SliderInterface::class,SliderRepository::class);
        $this->app->bind(ContactsInterface::class,ContactsRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
