<?php

namespace App\Providers;

use App\Models\Image;
use App\Models\Product;
use App\Observers\ImageObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\UserIsLogged' => [
            'App\Listeners\SetCartToUser',
        ],
        'App\Events\UserIsLogout' => [
            'App\Listeners\SetUserCartToDatabase',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Product::observe(ProductObserver::class);
        Image::observe(ImageObserver::class);
    }
}
