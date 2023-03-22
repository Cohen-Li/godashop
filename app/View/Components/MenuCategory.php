<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Repositories\CategoryRepository;

class MenuCategory extends Component
{
    public $menuType = 'top';
    public $categoryId = null;

    /**
     * @var ProductRepository
     */
    protected $categoryRepository;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        CategoryRepository $categoryRepository, 
        $menuType = 'top',
        $categoryId = null,
    )

    {
        $this->categoryRepository = $categoryRepository;
        $this->menuType = $menuType;
        $this->categoryId = $categoryId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.menu-category', [
            'categories' => $this->categoryRepository->getCategoryByMenu(),
            'menuType' => $this->menuType,
            //'categoryId' =>$this->categoryId,
        ]);
    }
}
