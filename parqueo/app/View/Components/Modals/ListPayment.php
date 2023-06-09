<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

class ListPayment extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $name;
    public $title;
    public function __construct($name,$title)
    {
        $this->name = $name;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modals.list-payment');
    }
}
