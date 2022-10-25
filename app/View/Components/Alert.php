<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{

    public string $type, $message;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $type = 'warning',
        string $message = ''
    )
    {
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return <<<'blade'
            <div class="alert alert-{{ $type }}">
                <p>{{ $message }}</p>
                {{ $slot }}
            </div>
        blade;
        /* return view('components.alert'); */
    }
}
