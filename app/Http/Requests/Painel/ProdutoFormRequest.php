<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * REGRAS DE VALIDAÇÃO DOS DADOS DO FORMULÁRIO
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'required|min:3|max:100',
            'numero'    => 'required|numeric',
            'categoria' => 'required',
            'descricao' => 'min:3|max:1000'
        ];
    }

    /**
     * MENSAGENS PARA AS REGRAS DE VALIDAÇÃO
     * Método opcional para apresentar as mensagens de validação do formulário.
     *
     * @return void
     */
    public function messages()
    {
        return [
            'name.required' => 'O campo nome é de preenchimento obrigatório!',
            'name.min' => 'O campo nome deve ter pelo menos 3 caracteres!',
            'name.max' => 'O campo nome deve ter no máximo 100 caracteres!',
            'numero.required' => 'O campo número é de preenchimento obrigatório!',
            'numero.numeric' => 'O campo número deve conter apenas números!',
            'categoria.required' => 'Selecione um item na lista de categorias!',
            'descricao.min' => 'O campo descrição deve conter pelo menos 3 caracteres!',
            'descricao.max' => 'O campo descrição deve conter no máximo 1000 caracteres!',
        ];
    }
}
