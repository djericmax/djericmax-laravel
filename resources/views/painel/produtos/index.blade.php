@extends('painel.templates.template')

@section('content')
<h1 class="title-pg">Listagem de produtos</h1>

<?php
    // Primeira forma de passar url de botão
    //href="{{ url('/painel/produtos/create', []) }}"
?>

<!-- Segunda forma de passar url de botão -->
<p><a href="{{route('produtos.create')}}" class="btn btn-outline-success">
    <img src="{{url("/assets/painel/imgs/produto-icon.png")}}" width="25px" title="Clique para editar">
     Cadastrar Novo</a></p>
    
    
<table class="table table-outline-dark">
    <tr>
        <th>Nome</th>        
        <th>Descrição</th>
        <th width="150px">Ações</th>
    </tr>
    @foreach ($produtos as $produto)
        <tr>
        <td>{{$produto->name}}</td>
        <td>{{$produto->descricao}}</td>
        <td>
            <!-- Primeiro modo de passar o href de editar
                href="{//{url("/painel/produtos/{$produto->id}/edit")}}" -->
            <!-- Segunda e melhor forma de passar o href -->
            <a href="{{route('produtos.edit', $produto->id)}}" class="btn btn-outline-info">
                <img src="{{url("/assets/painel/imgs/edit-icon.png")}}" width="25px" title="Clique para editar"></a>
            <a href="{{route('produtos.show', $produto->id)}}" class="btn btn-outline-warning">
                <img src="{{url("/assets/painel/imgs/visualiza-icon.png")}}" width="25px" title="Clique para visualizar">
            </a>            
        </td>
        </tr>        
    @endforeach
</table>

{!! $produtos->links(['class'=>]) !!}


@endsection