<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Repositories\SliderRepository;

class SliderComponent extends Component
{
    protected $sliderRepository;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(SliderRepository $sliderRepository)
    {
        $this->sliderRepository = $sliderRepository;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.slider-component', [
            'slider' => $this->sliderRepository->getsliderTop()
        ]);
    }
}
