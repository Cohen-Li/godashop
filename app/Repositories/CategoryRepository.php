<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    /**
     * @var Category
     */

    protected $model;

    public function __construct(Category $model)
    {
        $this->model = $model;   
    }

    // get menu Category
    public function getCategoryByMenu($limit=10)
    {
        return $this->model->with('sub')->limit($limit)->get();
    }

    // get Feature Category
    public function getFeatureCategories($limit=5)
    {
        return $this->model->with(['products' => function($query){
            $query->inRandomOrder()->limit(8);
        }])
        ->inRandomOrder()
        ->limit($limit)
        ->get();
    }

    // get id category

    public function findById($id)
    {
        return $this->model->find($id);
    }
}