<?php

namespace App\Repositories;

use App\Models\Slider;

class SliderRepository
{
    /**
    * @var Slider
    */

    protected $model;

    public function __construct(Slider $model)
    {
        $this->model = $model;   
    }
    
    public function getsliderTop()
    {
        return $this->model->first();
    }
}