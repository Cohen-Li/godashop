<?php

namespace App\View\Components;

use App\Services\CartService;
use Illuminate\View\Component;

class ProductCart extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $cartService = app(CartService::class);

        return view('components.frontend.product-cart', [
            'products' => $cartService->all(),
            'totalPrice' => $cartService->totalPrice(),
        ]);
    }
}
