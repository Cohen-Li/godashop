<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;
    protected $productRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository
    )

    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function show($slug, $categoryId)
    {
        if(!$category = $this->categoryRepository->findById($categoryId)){
            abort(404);
        }
        
        return view('frontend.categories.show', [
            'category' => $category,
            'productPaginate' => $this->productRepository->getByCategoryId($categoryId)
        ]);
    }


}
