<?php

namespace Modules\Iredeems\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Iredeems\Events\Handlers\RegisterIredeemsSidebar;

class IredeemsServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterIredeemsSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('items', array_dot(trans('iredeems::items')));
            $event->load('redeems', array_dot(trans('iredeems::redeems')));
            $event->load('pointhistories', array_dot(trans('iredeems::pointhistories')));
            $event->load('points', array_dot(trans('iredeems::points')));
            // append translations





        });
    }

    public function boot()
    {
        $this->publishConfig('iredeems', 'permissions');
        $this->publishConfig('iredeems', 'settings');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Iredeems\Repositories\ItemRepository',
            function () {
                $repository = new \Modules\Iredeems\Repositories\Eloquent\EloquentItemRepository(new \Modules\Iredeems\Entities\Item());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iredeems\Repositories\Cache\CacheItemDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iredeems\Repositories\RedeemRepository',
            function () {
                $repository = new \Modules\Iredeems\Repositories\Eloquent\EloquentRedeemRepository(new \Modules\Iredeems\Entities\Redeem());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iredeems\Repositories\Cache\CacheRedeemDecorator($repository);
            }
        );

        $this->app->bind(
            'Modules\Iredeems\Repositories\PointHistoryRepository',
            function () {
                $repository = new \Modules\Iredeems\Repositories\Eloquent\EloquentPointHistoryRepository(new \Modules\Iredeems\Entities\PointHistory());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iredeems\Repositories\Cache\CachePointHistoryDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iredeems\Repositories\PointRepository',
            function () {
                $repository = new \Modules\Iredeems\Repositories\Eloquent\EloquentPointRepository(new \Modules\Iredeems\Entities\Point());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iredeems\Repositories\Cache\CachePointDecorator($repository);
            }
        );
// add bindings





    }
}
