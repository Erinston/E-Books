<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;
    /*nome da tabela*/
    protected $table    =   "livros";

    protected $fillable = [
        'nome',
        'autor',
        'paginas',
        'genero',
        'data',
        'idioma',
        'editora',
    ];

    /*Função que representa o relacionamento de um para muitos*/
    public function livros(){
        return $this->BelongsTo(User::class);
    }
}
