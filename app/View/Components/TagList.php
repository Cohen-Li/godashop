<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Repositories\TagRepository;

class TagList extends Component
{
    /**
     * @var TagRepository
     */
    protected $tagRepository;
    public $categorySlug;
    public $categoryId;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        TagRepository $tagRepository,
        $categorySlug = null,
        $categoryId = null,
    )

    {
        $this->tagRepository = $tagRepository;
        $this->categorySlug = $categorySlug;
        $this->categoryId = $categoryId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $params = array_merge(request()->all(), [
            'slug' => $this->categorySlug,
            'categoryId' => $this->categoryId
        ]);


        return view('components.frontend.tag-list', [
            'tags' => $this->tagRepository->all(),              // get all data for tag
            'routeName' => request()->route()->getName(),       // get current url
            'params' => $params,
        ]);
    }
}
