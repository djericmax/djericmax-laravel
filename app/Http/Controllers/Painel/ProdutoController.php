<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Produto;
use App\Http\Requests\Painel\ProdutoFormRequest;

class ProdutoController extends Controller
{
    //-------------------------------------- CONSTRUTOR DA CLASSE -------------------------
    private $produto;
    private $totalPage = 3; //variável para contar a quantidade de páginas exibir

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }

    //-------------------------------------- CONSTRUTOR DA CLASSE -------------------------

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem de produtos | DJERICMAX';

        //Primeira forma de exibir todos os produtos na tela
        //$produtos = $this->produto->all();

        //Segunda forma de exibir os produtos na tela, paginados.
        $produtos = $this->produto->paginate($this->totalPage);

        return view('painel.produtos.index', compact('produtos', 'title'));
    }

    /** ------------------------------------------ MÉTODO CREATE -----------------------
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar novo Produto | DJERICMAX';

        $categorias = ['Eletrônicos', 'Móveis', 'Limpeza', 'Banho'];

        return view('painel.produtos.create-edit', compact('title', 'categorias'));
    }
    /** ------------------------------------------ MÉTODO CREATE ----------------------- **/

    /** ------------------------------------------ MÉTODO STORE -----------------------
     * Método para recuperar os dados, validar os campos de acordo com regras de validação
     *definidas na model em APP/MODELS/PAINEL/PRODUTOS.PHP, e inserir no banco de dados.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoFormRequest $request)
    {
        //--------------------------------------------------------------------------
        // RECUPERANDO DADOS DO FORMULÁRIO ---------
        //para recuperar todos os campos do formulário e
        //exibir em formato debug no navegador.
        //dd($request->all());

        //para recuperar apenas alguns campos do formulário e
        //exibir em formato debug no navegador.
        //dd($request->only(['name', 'numero']));

        //para recuperar todos os campos do formulário exceto os determinados e
        //exibir em formato debug no navegador.
        //dd($request->except(['_token']));

        //para recuperar todos os campos do formulário exceto os determinados e
        //exibir em formato debug no navegador.
        //dd($request->input('name')); 

        //Utilizar o ALL(), para recuperar todos os dados que vem do formulário
        $dataForm = $request->all();

        //--------------------------------------------------------------------------
        // VALIDAÇÃO DO CAMPO 'ATIVO' ----------
        //Resolvendo a validação do campo ATIVO, caso não seja selecionada
        //Utilizando o !ISSET para verificar se a opção ATIVO não existe,
        //Se não existir, preenche com 0 (zero), se existir, preenche com 1. 
        //utilizando IF literal
        $dataForm['ativo'] = (!isset($dataForm['ativo'])) ? 0 : 1;
        //--------------------------------------------------------------------------
        
        //--------------------------------------------------------------------------
        //MENSAGENS DAS REGRAS DE VALIDAÇÃO NO CORPO DO CONTROLE. O original está em:
        // APP/HTTP/REQUESTS/PAINEL/ProdutoFormRequest.php
        //
        //variável de mensagens de validação do formulário, inseridas aqui no controller
        /* $mensagens = [
            'name.required' => 'O campo nome é de preenchimento obrigatório!',
            'name.min' => 'O campo nome deve ter pelo menos 3 caracteres!',
            'name.max' => 'O campo nome deve ter no máximo 100 caracteres!',
            'numero.required' => 'O campo número é de preenchimento obrigatório!',
            'numero.numeric' => 'O campo número deve conter apenas números!',
            'categoria.required' => 'Selecione um item na lista de categorias!',
            'descricao.min' => 'O campo descrição deve conter pelo menos 3 caracteres!',
            'descricao.max' => 'O campo descrição deve conter no máximo 1000 caracteres!',
        ]; */
        //--------------------------------------------------------------------------

        //--------------------------------------------------------------------------
        //VALIDANDO DEMAIS CAMPOS E VINCULANDO AS REGRAS ----------
        //As regras de validação foram criadas na MODEL: APP/MODELS/PAINEL/PRODUTOS.PHP
        //Validar, de forma simples, os dados para cadastrar no banco.
        //$this->validate($request, $this->produto->rules);
        //--------------------------------------------------------------------------

        //--------------------------------------------------------------------------
        //validando as regras e mensagens de output
        /* $validade = validator($dataForm, $this->produto->rules, $mensagens);

        //Validar de forma mais livre, os dados para cadastrar no banco.
        if ($validade->fails()) {
            return redirect()->route('produtos.create')
                        ->withErrors($validade)
                        ->withInput();
        } */
        //--------------------------------------------------------------------------
        
        //--------------------------------------------------------------------------
        //PROCESSO PARA INSERIR OS DADOS DO FORMULÁRIO NO BANCO ----------
        //Utlizar CREATE para efetuar o cadastro no banco de dados, aceitando apenas os campos
        // que estão definidos no fillable, na model APP/MODELS/PAINEL/PRODUTOS.PHP.
        $insert = $this->produto->create($dataForm);

        if ($insert) {
            //Se cadastrado, redireciona para o index de produtos.
            return redirect()->route('produtos.index');
        } else {
            //Se não cadastrou, pode:
            //Retornar ao caminho anterior ou
            //return redirect().back();

            //Retornar ao caminho específico
            return redirect()->route('produtos.create');
        }
        //--------------------------------------------------------------------------
    }
    /** ------------------------------------------ MÉTODO STORE ----------------------- **/

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = $this->produto->find($id);

        $title = "Produto: {$produto->name}";

        return view('painel.produtos.show', compact('produto', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Primeiro passo de tudo é recuperar o produto pelo id
        $produto = $this->produto->find($id);

        //Título da view (página) atual com o nome do produto para edição
        $title = "Editar Produto: {$produto->name} | DJERICMAX";

        //Categorias utilizadas no drop down
        $categorias = ['Eletronicos', 'Moveis', 'Limpeza', 'Banho'];

        return view('painel.produtos.create-edit', compact('title', 'categorias', 'produto'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoFormRequest $request, $id)
    {
        //Recupera todos os dados do formulário
        $dataForm = $request->all();

        //recupera o item para editar os dados
        $produto = $this->produto->find($id);

        //verifica se o produto está ativado ou não
        $dataForm['ativo'] = (!isset($dataForm['ativo'])) ? 0 : 1;

        //Realiza a alteração dos itens no banco de dados
        $update = $produto->update($dataForm);

        //Verifica se realmente editou algum dado e se estiver correto volta para a listagem,
        //caso contrário, mantem no formulário em tempo de edição e com mensagens de erro
        if($update)
        {
            return redirect()->route('produtos.index');
        }
        else{
            return redirect()
                        ->route('produtos.edit', $id)
                        ->with(['errors' => 'Não foi possível salvar alterações']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Primeira forma de deletar um produto
        //$produto = $this->produto->find($id)->delete();

        //Segunda forma de deletar o produto
        $produto = $this->produto->find($id);

        $delete = $produto->delete();

        if ($delete) {
            return redirect()->route('produtos.index')->with(['errors'=>'Produto excluído com sucesso']);
        } else {
            return redirect()->route('produtos.show', $id)->with(['errors'=>'Falha ao deletar o produto']);
        }
        
    }

    public function testes()
    {

    /* *********************** MÉTODOS DE DELETE *********************** */ 
    
    //Método para DELETAR dados através de um ou mais campos.
        $delete = $this->produto
                        ->where('numero', 1312)
                        ->where('name', 'Shampoo')
                        ->delete();
        if ($delete) {
            return 'Seus dados deletados com sucesso!';
        } else {
            return 'Falha ao apagar este registro.';
        }

    //Método comum para DELETAR dados de um registro
        /*$prod = $this->produto->find(3)->delete(); */

    //Método DESTROY para DELETAR dados de um registro
        /*$prod = $this->produto->destroy([4,5,6]); */
    
    //Método FIND para DELETAR dados de um registro
    /*  $prod = $this->produto->find(7);
        $delete = $prod->delete();
        if ($delete) {
            return 'Dados apagados com sucesso!';
        } else {
            return 'Não foi possível apagar este registro.';
        } */


    /* *********************** MÉTODOS DE DELETE *********************** */ 




    /* *********************** MÉTODOS DE UPDATE *********************** */ 
            
    //Primeira forma de ALTERAR dados no banco.
    /*  $prod = $this->produto->find(5);
        $prod->name = 'Shampoo Seda';
        $prod->numero = 1312;
        $prod->ativo = true;
        $prod->categoria = 'Limpeza';
        $prod->descricao = 'Shampoo para cabelos crespos que usam seda.';
        $update = $prod->save();

        if ($update) {
            return 'Alterações realizadas com sucesso!';
        } else {
            return 'Não foi possível realizar as alterações.';
        } */


    //Método mais coerente para ALTERAR dados no banco.
    /*  $prod = $this->produto->find(3);
        $update = $prod->update([
                    'name'      => 'Creme para pele',
                    'numero'    => '1311',
                    'ativo'     => true,
                    'categoria' => 'Limpeza',
                    'descricao' => 'Creme para rugas e olheiras.'
        ]);

        if ($update) {
            return 'Suas alterações foram realizadas!';
        } else {
            return 'Não foi possível realizar suas alterações.';
        } */


    //Método para ALTERAR dados com v1 ou mais WHERE, no banco.
    /*  $update = $this->produto
                        ->where('name','Condicionador')
                        ->where('numero',1313)
                        ->update([
                                    'name'      => 'Cond. Monange',
                                    'numero'    => '1313',
                                    'ativo'     => false,
                                    'categoria' => 'Limpeza',
                                    'descricao' => 'Creme para Cabelos preto.'
                                ]);

        if ($update) {
            return 'Vossas alterações fueram realizadas!';
        } else {
            return 'Não foi possível realizar suas alterações.';
        } */

        
    /* *********************** MÉTODOS DE UPDATE *********************** */ 




    /* *********************** MÉTODOS DE INSERT *********************** */ 

    //Primeira forma de INSERIR dados no banco.
    /*  $prod = $this->produto;
        $prod->name = 'Shampoo';
        $prod->numero = 1312;
        $prod->ativo = true;
        $prod->categoria = 'Limpeza';
        $prod->descricao = 'Shampoo para cabelos crespos.';
        $insert = $prod->save();

        if ($insert) {
            return 'Dados inseridos no banco.';
        } else {
            return 'Falha ao inserir os dados.';
        }*/

    //método mais coerente para INSERIR dados no banco.
    /*  $insert = $this->produto->create([
                    'name'      => 'Creme dental Idosos',
                    'numero'    => '1317',
                    'ativo'     => true,
                    'categoria' => 'Limpeza',
                    'descricao' => 'Creme para as dentadura.'
                    ]);

        if ($insert) {
            return "Dados inseridos no banco. ID: {$insert->id}";
        } else {
            return 'Falha ao inserir os dados.';
        } */
        
    /* *********************** MÉTODOS DE INSERT *********************** */ 
    }
}
