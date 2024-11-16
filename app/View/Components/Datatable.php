<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Datatable extends Component
{
    public array|Collection $data;
    public string $datatableId;
    public string $routeCreate;
    public string $routeEdit;
    public string $routeDelete;
    public function __construct(Collection $data, string $datatableId, string $routeDelete, string $routeEdit, string $routeCreate)
    {
        $this->data = $data->toArray();
        $this->datatableId = $datatableId;
        $this->routeCreate = $routeCreate;
        $this->routeEdit = $routeEdit;
        $this->routeDelete = $routeDelete;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $data = $this->data;
        // return dd($data);
        return view('components.datatable', compact('data'));
    }
}
