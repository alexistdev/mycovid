<?php

namespace App\View\Components\backend;

use Illuminate\View\Component;

class NavbarLayout extends Component
{
    public $totalNotif;

    public function __construct($totalNotif=null)
    {
        $this->totalNotif = $totalNotif;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.backend.navbar-layout');
    }
}
