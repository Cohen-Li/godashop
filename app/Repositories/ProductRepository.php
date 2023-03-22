<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    /**
     * @var Product
     */

    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;   
    }

    // get Id product
    public function findById($id) 
    {
        return $this->model->find($id);
    }

    // get Feature Product

    public function getByFeature($limit)
    {
        return $this->model->isFeature()->with('attachments')->limit($limit)->get();
    }

    // get New Product
    public function getNewest($limit=12)
    {
        return $this->model->with('attachments')->inRandomOrder()->limit($limit)->get();
    }

    // phân trang

    public function paginate(array $inputs, $limit=15)
    {
        $query = $this->model->query();

        // call function sortByRangePrice
        $query = $this->sortByRangePrice($query);
        
        // call function filterByTag
        $query = $this->filterByTag($query);
        
        // call function sortProduct
        $query = $this->orderByProduct($query);

        return $query->paginate($limit);
    }

    // Phần Category

    public function getByCategoryId($categoryId, $limit=15)
    {
        $query = $this->model->where('category_id', $categoryId);

        // call function filterByTag
        $query = $this->filterByTag($query);

        // call function sortByRangePrice
        $query = $this->sortByRangePrice($query);

        // call function orderByProduct
        $query = $this->orderByProduct($query);
        
        return $query->paginate($limit);
    }

    // function xử lý tag
    protected function filterByTag($query) {

        $inputs = request()->all();
        if (!empty($inputs['tag_id'])) {
            $query->whereHas('tags', function($query) use ($inputs) {
                $query->where('tags.id', $inputs['tag_id']);
            });
        }
        return $query;
    }

    // function sortByRangePrice
    protected function sortByRangePrice($query){
        
        $inputs = request()->all();

        if (isset($inputs['from_price']) && isset($inputs['to_price'])) {

            if ($inputs['to_price'] === 'greater') {
                $query->where('price', '>=', $inputs['from_price']);
            }

            if ($inputs['to_price'] != 'greater') {
                $query->where('price', '>=', $inputs['from_price'])
                      ->where('price', '<=', $inputs['to_price']);
            } 

        }
        return $query;
    }

    // function orderByProduct
    protected function orderByProduct($query) {
        switch (request()->get('sort_by')) {
            case 'price-asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price-desc':
                $query->orderBy('price', 'desc');
                break;
            case 'alpha-asc':
                $query->orderBy('name', 'asc');
                break;
            case 'alpha-desc':
                $query->orderBy('name', 'desc');
                break;
            case 'created-asc':
                $query->orderBy('id', 'asc');
                break;
            case 'created-desc':
                $query->orderBy('id', 'desc');
                break;
            default:
                $query->orderBy('id', 'DESC');
        }
        return $query;
    }
}