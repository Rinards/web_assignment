<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Paginator extends Component
{
    public $page;
    public $type;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $page)
    {
        $this->type = $type;
        $this->page = $page;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.paginator');
    }
}
