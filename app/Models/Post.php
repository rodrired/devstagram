<?php

namespace App\Models;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];
    

     /**
         * Get the user that owns the PostController
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
    public function user()
    {
        //UN POST TIENE UN USUARIO
        return $this->belongsTo(User::class)->select(['name', 'username']); //TRAE SOLO LOS ELEMENTOS QUE QUEREMOS, SI NO SE PONE NADA TRAERA TODOS LOS ELEMENTOS DEL REGISTRO
    }

    public function comentarios(){
        //UN POST TIENE MUCHOS COMENTARIOS
        return $this->hasMany(Comentario::class); //->select(['comentario']); SI SE QUIERE SOLO EL COMENTARIO
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user){
        //return $this->belongsTo(User::class);
        return $this->likes->contains('user_id', $user->id); //CONSULTA EN LA BD SI EL USUARIO ID EXISTE PARA EL POST QUE SE VE (EL POST ID)
    }
}
