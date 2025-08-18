<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListarPost extends Component
{
    /**
     * Create a new component instance.
     */
    public $posts; //CREAR LA VARIABLE QUE SE VA A UTILIZAR EN LA VISTA DEL COMPONENTE

    public function __construct($posts) //SE RECIBE LA VARIABLE DESDE LA VISTA DONDE SE USA EL COMPONENTE
    {
        $this->posts = $posts; //SE ASIGNA EL VALOR A LA VARIABLE PUBLICA CREADA, Y SE ENVIA AUTOMATICAMENTE A LA VISTA DEL COMPONENTE
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.listar-post');
    }
}
