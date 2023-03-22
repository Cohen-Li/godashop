<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Repositories\ProductRepository;

class NewestProduct extends Component
{
    
    /**
     * @var ProductRepository
     */
    protected $productRepository;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.newest-product', [
            'products' => $this->productRepository->getNewest(),
        ]);
    }
}
