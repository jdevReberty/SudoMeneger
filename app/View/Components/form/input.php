<?php

namespace App\View\Components\form;

use Illuminate\View\Component;

class input extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $name,
        public string $label,
        public string $type,
        public string $required,
        public string $contentClass,
        public string $placeholder,
        public string $readonly,
        public string $value
    ){}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.input');
    }
}
