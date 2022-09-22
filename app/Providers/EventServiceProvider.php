<?php

namespace App\Providers;

use App\Events\PriceHistoryCreated;
use App\Events\ProductHistoryCreated;
use App\Events\QuantityHistoryCreated;
use App\Listeners\AddPriceToPriceHistoryTable;
use App\Listeners\AddQuantityToQuantityHistoryTable;
use App\Listeners\SendProductDataToDatabaseHistory;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        PriceHistoryCreated::class => [
            AddPriceToPriceHistoryTable::class,
        ],

        QuantityHistoryCreated::class => [
            AddQuantityToQuantityHistoryTable::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
