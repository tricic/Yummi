<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Alerts extends Component
{
    public $class;

    public $success;
    public $warning;
    public $danger;
    public $info;

    public function __construct(string $class = '')
    {
        $this->class = $class;

        $this->success  = (array) session('success');
        $this->warning  = (array) session('warning');
        $this->danger   = (array) session('danger');
        $this->info     = (array) session('info');
    }

    public function isEmpty(): bool
    {
        return
            empty($this->success) &&
            empty($this->warning) &&
            empty($this->danger) &&
            empty($this->info);
    }

    public function render(): View
    {
        return view('components.alerts');
    }
}
