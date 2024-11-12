<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Datatable extends Component
{
    public Collection|array $data;
    public array $columns;
    public string $routeDelete;
    public string $targetModalCreate;

    /**
     * Buat konstruktor untuk menerima parameter kolom dan data.
     */
    public function __construct(Collection|array $data, string $routeDelete = '', string $targetModalCreate = '')
    {
        $this->data = $data;
        $this->routeDelete = $routeDelete;
        $this->targetModalCreate = $targetModalCreate;
        // Ambil nama kolom dari elemen pertama di data
        $this->columns = !empty($data) ? array_keys($data->first()->getAttributes()) : [];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // return dd($this->data);
        return view('components.datatable', ['data' => $this->data]);
    }
}
