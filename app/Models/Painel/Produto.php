<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'name', 'numero', 'ativo', 'categoria', 'descricao'
    ];
    //protected $guarded = ['admin'];
}
