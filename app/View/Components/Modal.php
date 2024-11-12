<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public string $target;
    public string $modalTitle;


    public function __construct(string $target, $modalTitle)
    {
        $this->target = $target;
        $this->modalTitle = $modalTitle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal');
    }
}
