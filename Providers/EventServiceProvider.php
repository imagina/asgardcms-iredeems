<?php

namespace Modules\Iredeems\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Iredeems\Events\OrderWasCreated;
use Modules\Iredeems\Events\Handlers\StorePoints;
use Modules\Iredeems\Events\RedeemWasCreated;
use Modules\Iredeems\Events\Handlers\SendRedeem;


class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        OrderWasCreated::class => [
          StorePoints::class
        ],
        RedeemWasCreated::class => [
          SendRedeem::class,
        ],
    ];
}
