<?php

namespace App\Providers;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductItemOption;
use App\Models\User;
use App\Observers\ImageObserver;
use App\Observers\ProductObserver;
use App\Observers\ProductItemOptionObserver;
use App\Observers\UserObserver;
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
        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\UserEventSubscriber',
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

        $this->registerObservers();
    }

    private function registerObservers()
    {
        Product::observe(ProductObserver::class);
        ProductItemOption::observe(ProductItemOptionObserver::class);
        Image::observe(ImageObserver::class);
        User::observe(UserObserver::class);
    }
}
