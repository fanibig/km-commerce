<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Charts extends Component
{
    public $id;
    public $type;
    public $data;
    public $options;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $type = 'bar', $data = [], $options = [])
    {
        $this->id = $id;
        $this->type = $type;
        $this->data = $data;
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.charts');
    }
}
