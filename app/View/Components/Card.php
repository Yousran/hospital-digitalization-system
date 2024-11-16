<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    /**
     * Create a new component instance.
     */
    public string $mdColSpan;
    public string $xlColSpan;
    public function __construct(string $mdColSpan = '1',string $xlColSpan = '1')
    {
        $this->mdColSpan = $mdColSpan;
        $this->xlColSpan = $xlColSpan;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card');
    }
}
