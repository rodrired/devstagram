<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LikePost extends Component
{
    //ATRIBUTOS SE PASAN AUTOMATICAMENTE A LA VISTA NO HACE FALTA CONSTRUCTOR
    public $post;
    public $isLike;
    public $likes;

    //FUNCIÓN QUE SE INSTANCIA AUTOMATICAMENTE AL UTILIZAR EL LIVEWIRE, EQUIVALENTE AL CONSTRUCT DE PHP
    public function mount($post){ //VARIABLE QUE SE ENVIA DESDE LA VISTA
        $this->isLike = $post->checkLike(Auth::user());
        $this->likes =  $post->likes->count();
    }

    //FUNCION CREADA PARA EL EVENTO CLICK DE LA VISTA
    public function like(){
        //EL RETURN LO HACE AUTOMATICO VIA AXIOS
        //SE CHEQUEA SI YA DIO ME GUSTA
        if($this->post->checkLike(Auth::user())){
            $this->post->likes()->where('post_id', $this->post->id)->where('user_id', Auth::user()->id)->delete();
            $this->isLike = false;
            //$this->likes--;
        }else{
            $this->post->likes()->create([
                'user_id' => auth()->user()->id,
            ]);
            $this->isLike = true;
            //$this->likes++;
        }
        //PARA COMPROBAR LA CANTIDAD DE DEBE RECARGAR EL MODELO CON refresh, con esto no utilizamos el ++ ni --
        $this->post->refresh();
        $this->likes =  $this->post->likes->count();
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
