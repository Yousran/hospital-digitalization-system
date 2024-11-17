<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Ramsey\Uuid\Type\Integer;

class NumberInput extends Component
{
    /**
     * Create a new component instance.
     */
    public string $inputId;
    public string $inputName;
    public int $value;
    public function __construct(string $inputId, int $value, string $inputName)
    {
        $this->inputId = $inputId;
        $this->value = $value;
        $this->inputName = $inputName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.number-input');
    }
}
