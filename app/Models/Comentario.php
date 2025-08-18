<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comentario extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
        'comentario',
    ];


    public function user(){
        //UN COMENTARIO ES DE UN USUARIO
        return $this->belongsTo(User::class);//->select(['username']);
    }
}
