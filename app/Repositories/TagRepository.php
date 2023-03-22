<?php

namespace App\Repositories;

use App\Models\Tag;

class TagRepository
{
    /**
     * @var Tag
     */

    protected $model;

    public function __construct(Tag $model)
    {
        $this->model = $model;   
    }

    public function all()
    {
        return $this->model->all();
    }
}