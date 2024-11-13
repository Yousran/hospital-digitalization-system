<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Datatable extends Component
{
    public string $routeDelete;
    public string $routeDatatable;
    public string $routeEdit;
    public string $targetModalCreate;
    public string $dataName;

    public function __construct(
        string $routeDelete = '', 
        string $targetModalCreate = '', 
        string $routeEdit = '', 
        string $routeDatatable = '',
        string $dataName = '')
    {
        $this->routeDatatable = $routeDatatable;
        $this->routeEdit = $routeEdit;
        $this->dataName = $dataName;
        $this->routeDelete = $routeDelete;
        $this->targetModalCreate = $targetModalCreate;
        // $this->columns = !empty($data) ? array_keys($data->first()->getAttributes()) : [];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // return dd($this->data);
        // return view('components.datatable', ['data' => $this->data]);
        return view('components.datatable');
    }
}
