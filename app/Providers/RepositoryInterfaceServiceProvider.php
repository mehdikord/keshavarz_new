<?php

namespace App\Providers;

use App\Interfaces\Auth\AuthInterface;
use App\Interfaces\Brands\BrandsInterface;
use App\Interfaces\Categories\CategoriesInterface;
use App\Interfaces\Contacts\ContactsInterface;
use App\Interfaces\Dashboard\DashboardInterface;
use App\Interfaces\Faqs\FaqsInterface;
use App\Interfaces\Implements\ImplementInterface;
use App\Interfaces\Invoices\InvoiceInterface;
use App\Interfaces\Lands\LandsInterface;
use App\Interfaces\News\NewsInterface;
use App\Interfaces\Plans\PlansInterface;
use App\Interfaces\Products\ProductsInterface;
use App\Interfaces\Profile\ProfileInterface;
use App\Interfaces\Requests\RequestsInterface;
use App\Interfaces\Search\SearchInterface;
use App\Interfaces\Slider\SliderInterface;
use App\Interfaces\Users\UsersInterface;
use App\Interfaces\Weather\WeatherInterface;
use App\Repository\Auth\AuthRepository;
use App\Repository\Brands\BrandsRepository;
use App\Repository\Categories\CategoriesRepository;
use App\Repository\Contacts\ContactsRepository;
use App\Repository\Dashboard\DashboardRepository;
use App\Repository\Faqs\FaqsRepository;
use App\Repository\Implements\ImplementRepository;
use App\Repository\Invoices\InvoiceRepository;
use App\Repository\Lands\LandsRepository;
use App\Repository\News\NewsRepository;
use App\Repository\Plans\PlansRepository;
use App\Repository\Products\ProductsRepository;
use App\Repository\Profile\ProfileRepository;
use App\Repository\Requests\RequestsRepository;
use App\Repository\Search\SearchRepository;
use App\Repository\Slider\SliderRepository;
use App\Repository\Users\UsersRepository;
use App\Repository\Weather\WeatherRepository;
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
        $this->app->bind(InvoiceInterface::class,InvoiceRepository::class);
        $this->app->bind(DashboardInterface::class,DashboardRepository::class);
        $this->app->bind(LandsInterface::class,LandsRepository::class);
        $this->app->bind(RequestsInterface::class,RequestsRepository::class);
        $this->app->bind(WeatherInterface::class,WeatherRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
