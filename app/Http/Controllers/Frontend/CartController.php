<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use App\Services\CartService;

class CartController extends Controller
{
    /**
    * @var ProductRepository.
    */
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function add($productId) 
    {
        $cartService = app(CartService::class);
        $cartService->updateOrInsert($productId);
        return redirect()->back();
    }
}
