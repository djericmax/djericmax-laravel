<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'name', 'numero', 'ativo', 'categoria', 'descricao'
    ];
    //protected $guarded = ['admin'];



    //Váriável array para regras de validação diretamente na Model Produto.
    /*  public $rules = [
        'name'      => 'required|min:3|max:100', // separar as regras com o sinal 'pipe - |'
        'numero'    => 'required|numeric',
        'categoria' => 'required',
        'descricao' => 'min:3|max:1000'
    ]; */

}
