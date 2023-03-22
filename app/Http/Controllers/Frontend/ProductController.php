<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        // dd(request()->all());
        return view('frontend.products.index', [
            'productPaginate' => $this->productRepository->paginate(request()->all())
        ]);
    }

    public function show($slug)
    {
        return view('frontend.products.show');
    }
}
