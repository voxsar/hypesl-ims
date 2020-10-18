<?php

namespace App\View\Components;

use Route;
use Illuminate\View\Component;

class area extends Component
{
    /**
     * The input name.
     *
     * @var string
     */
    public $name;

    /**
     * The input name.
     *
     * @var string
     */
    public $label;

    /**
     * The input name.
     *
     * @var string
     */
    public $value;

    /**
     * The input name.
     *
     * @var string
     */
    public $class;

    /**
     * The input name.
     *
     * @var string
     */
    public $viewmode;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $value = '', $class = '')
    {
        //
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->class = $class;

        $rn = Route::currentRouteName();
        if($rn != null && str_contains($rn, 'show')){
            $this->viewmode = "disabled='disabled'";   
        }else{
            $this->viewmode = "no";
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.area');
    }
}
