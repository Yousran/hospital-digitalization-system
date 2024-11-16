<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public string $formHeading;
    public string $action;
    public string $formMethod;
    public ?string $csrfMethod;
    // public ?string $currentData;
    public int $mdColSpan;
    public int $xlColSpan;
    public string $routeBack;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $formHeading,
        string $action,
        string $formMethod = 'POST',
        ?string $csrfMethod = null,
        int $mdColSpan = 1,
        int $xlColSpan = 1,
        string $routeBack,
        // ?string $currentData = null,
    ) {
        $this->formHeading = $formHeading;
        $this->action = $action;
        $this->formMethod = strtoupper($formMethod);
        $this->csrfMethod = $csrfMethod;
        $this->mdColSpan = $mdColSpan;
        $this->xlColSpan = $xlColSpan;
        $this->routeBack = $routeBack;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form');
    }
}