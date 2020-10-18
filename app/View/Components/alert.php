<?php

namespace App\View\Components;

use Illuminate\View\Component;

class alert extends Component
{
    /**
     * The input name.
     *
     * @var string
     */
    public $name;

    /**
     * The input title.
     *
     * @var string
     */
    public $title;

    /**
     * The input body.
     *
     * @var string
     */
    public $body;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $title, $body)
    {
        //
        $this->name = $name;
        $this->title = $title;
        $this->body = $body;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
