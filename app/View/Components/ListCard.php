<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListCard extends Component
{
    public $title;
    public $listId;
    public $fetchUrl;

    public function __construct($title, $listId, $fetchUrl)
    {
        $this->title = $title;
        $this->listId = $listId;
        $this->fetchUrl = $fetchUrl;
    }

    public function render()
    {
        return view('components.list-card');
    }
}
