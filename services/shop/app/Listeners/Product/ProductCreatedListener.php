<?php

namespace App\Listeners\Product;

use App\Events\Product\ProductCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Http\Controllers\Product\PriceController;

class ProductCreatedListener 
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductCreated $event): void
    {
        $controller = new PriceController();
        $controller->newinit($event->product);
    }
}
