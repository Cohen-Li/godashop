<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class CartService
{
    const CART_KEY = 'cart';

    protected $carts;

    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
        $this->carts = session(static::CART_KEY) ?? collect(); 
    }

    public function all()
    {
        return $this->carts;
    }

    public function exists($id)
    {
        $this->carts->where('id', $id)->count() > 0;
    }

    // tính tổng giá tiền
    public function totalPrice()
    {
        $total = 0;

        $this->carts->each(function($item) use ($total) {
            $total += $item->price * $item->qty;
        });

    }

    public function updateOrInsert($id)
    {
        if ($this->exists($id)) {           // update số lượng sản phẩm vào giỏ hàng
            $this->carts->each(function($item) use ($id) {
                if ($item->id == $id) {
                    $item->qty += 1;                       
                }
            }
        );
        } else {
            // insert thông tin sản phẩm vào giỏ hàng
            $product = $this->productRepository->findById($id);
            $product->qty = 1;
            $this->carts->push($product);
        }

        $this->saveCart();
    }

    // get total in cart
    public function total()
    {
        return $this->carts->sum('qty');
    }

    protected function saveCart()
    {
        session()->put(static::CART_KEY, $this->carts);
    }
}