<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

class GenericModal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $name;
    public $title;
    protected $slots = ['buttons', 'content'];
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
        return view('components.modals.generic-modal');
    }
}
