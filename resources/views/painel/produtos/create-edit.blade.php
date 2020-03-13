@extends('painel.templates.template')

@section('content')
<h1 class="title-pg">
    Gestão de Produto: <b>{{$produto->name or 'Novo'}}</b>
</h1>

<?php
    /*Apresentando os erros, se existir algum erro, será aplicado na variável ERRORS e contato
    quantos erros existem. Inserindo um loop em FOREACH para selecionar os erros e imprimir
    o erro na tela */
?>
@if (isset($errors) && count($errors) > 0)
     <div class="alert alert-danger">
         @foreach ($errors->all(); as $error)
            <p>{{$error}}</p>
         @endforeach
     </div>    
@endif

@if (isset($produto))
     <!-- Abrindo o form Editar em formato HTML, incluíndo o method_field('PUT')
    <form class="form" action="{//{ route('produtos.update', $produto->id)}}" method="post">
        {//!! method_field('PUT')!!} -->

    <!-- Abrindo o form Editar em formato Laravel, criando o method como PUT automaticamente -->
    {!! Form::model($produto, ['route'=>['produtos.update', $produto->id], 'class'=>'form', 'method'=>'put']) !!}
@else
<!-- Ao criar o formulário em formato Laravel, não há a necessidade de ricar o csrf_field() -->
        {!! Form::open(['route'=>'produtos.store', 'class'=>'form']) !!}
<!-- Ao criar o formulário no formato html padrão, é necessário criar o csrf_field() em laravel
        <form class="form" action="{/*{ route('produtos.store')}*/}" method="post" -->
@endif    
       <?php
            /* Forma de esconder o token do formulário
            formato HTML:   <input type="hidden" name="_token" value="{{csrf_token()}}">          
            formato LARAVEL:  {!!csrf_field()!!}
            */
                /*Métodos para enviar o POST no Action
                
                usar o endereço comum 
                action="/painel/produtos"
                
                usar o endereço através do laravel
                action="{{url('/painel/produtos')}}"

                usar o endereço de rotas apontando para o método store
                action="{{ route('produtos.store')}}"                        
                */
            ?>

        <div class="form-group">
            <!-- Input html em formato do laravel -->
        {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Nome:']) !!}
        
        <!-- Input html em formato do HTML 
            <input type="text" name="name" placeholder="Nome:" class="form-control" value="{/*{$produto->name or old('name')}*/}" -->
        </div>

        <div class="form-group">
            <label>

            {!! Form::checkbox('ativo') !!}

           <!-- <input type="checkbox" name="ativo" value="1" @//if (isset($produto) && $produto->ativo == '1') checked @//endif -->
                Ativo?
            </label>
        </div>
        
        <div class="form-group">

            {!! Form::text('numero', null, ['class'=>'form-control', 'placeholder'=>'Número:']) !!}

        <!--  <input type="text" name="numero" placeholder="Número:" class="form-control" value="{/*{$produto->numero or old('numero')}*/}" -->
        </div>
        
        <div class="form-group">
            <!-- Em algum momento do mundo, tentar corrigir esta parte aqui que não está funcionando. -->
            
            <!-- Select em formato Laravel -->
            {!! Form::select('categoria', $categorias, null, ['class'=>'form-control']) !!}
            
            <!-- Select em formato HTML
            <select name="categoria" class="form-control">
                <option value="">Escolha a categoria</option>
                @//foreach ($categorias as $categoria)
                <option value="{//{$categoria}}"
                    @//if (isset($produto) && $produto->categoria == $categoria)
                        selected
                    @//endif
                    >{//{$categoria}}</option>
                @//endforeach
            </select> -->
        </div>
  
        <div class="form-group">

            {!! Form::textarea('descricao', null, ['class'=>'form-control', 'placeholder'=>'Descrição:']) !!}

        <!-- <textarea name="descricao" cols="30" rows="10" placeholder="Descrição:" class="form-control">{/*{$produto->descricao or old('descricao')}*/}</textarea> -->
        </div>
        
        <!-- Primeira forma de inserir botão, em html e com imagem-->
        <button type="submit" class="btn btn-outline-primary">
        <img src="{{url("/assets/painel/imgs/salvar-icon.png")}}" width="25px"> SALVAR</button>

        
        <!-- Segunda forma de inserir botão, em laravel
        {!! Form::submit('SALVAR', ['class'=>'btn btn-outline-primary']) !!}
        -->

        <a href="{{route('produtos.index')}}" class="btn btn-outline-danger">
        <img src="{{url("/assets/painel/imgs/voltar-icon.png")}}" width="25px"> VOLTAR</a>

        <!-- Fechando o formulário em Laravel -->
        {!! Form::close() !!}

        <!-- fechando formulário em html
    </form -->

@endsection