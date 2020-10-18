<?php

namespace App\View\Components;

use Route;
use Illuminate\View\Component;

class select2 extends Component
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
    public $class;

    /**
     * The input name.
     *
     * @var string
     */
    public $viewmode;

    /**
     * The input name.
     *
     * @var string
     */
    public $dbmodel;

    /**
     * The input name.
     *
     * @var string
     */
    public $visible;

    public $multiple;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $dbmodel = '', $visible = '', $class = '', $multiple = null)
    {
        //
        $this->name = $name;
        $this->label = $label;
        $this->class = $class;
        $this->multiple = $multiple;
        if($dbmodel!=''){
            $this->dbmodel = $dbmodel;
        }
        $this->visible = $visible;

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
        return view('components.select2');
    }
}
