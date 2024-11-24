<?php
namespace App\View\Components;

use Illuminate\View\Component;

class Chart extends Component
{
    public $chartId;
    public $fetchUrl;
    public $title;
    public $totalData;
    public $seriesName;
    public $color;
    public $chartType;

    public function __construct($chartId, $fetchUrl, $seriesName = 'Series', $color = '#1A56DB', $chartType = 'area', $title = '', $totalData = '')
    {
        $this->chartId = $chartId;
        $this->fetchUrl = $fetchUrl;
        $this->seriesName = $seriesName;
        $this->color = $color;
        $this->chartType = $chartType;
        $this->title = $title;
        $this->totalData = $totalData;
    }

    public function render()
    {
        return view('components.chart');
    }
}