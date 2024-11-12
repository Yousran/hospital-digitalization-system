<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardMenu extends Component
{
    public string $dropdownId;

    /**
     * Create a new component instance.
     */
    public function __construct(string $dropdownId = 'default-dropdown')
    {
        $this->dropdownId = $dropdownId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-menu');
    }
}
