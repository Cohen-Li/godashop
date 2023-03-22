<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Repositories\CategoryRepository;

class CategoryProduct extends Component
{
    /**
     * @var ProductRepository
     */
    protected $categoryRepository;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.category-product', [
            'categories' => $this->categoryRepository->getFeatureCategories()
        ]);
    }
}
