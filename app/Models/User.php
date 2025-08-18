<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'imagen',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts(){
        //UN USUARIO PUEDE TENER MULTIPLES POST
        return $this->hasMany(Post::class); //SI NO SE UTILIZA LAS CLAVES DE LARAVEL SE PUEDE PASAR , FORENIG KEY
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    //ALMACENAR LOS SEGUIDORES de un usuario
    public function followers(){
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id'); //RELACIONA A LA TABLA FOLLOWERS Y LAS CLAVES FORANEAS
    }

     public function followings(){
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id'); //RELACIONA A LA TABLA FOLLOWERS Y LAS CLAVES FORANEAS, busca la relacion a la inversa
    }

    //COMPROBAR SI UN USUARIO SIGUE A OTRO
    public function siguiendo(User $user){
        return $this->followers->contains($user->id);
    }
}
