@extends('painel.templates.template')

@section('content')
<h1 class="title-pg">Produto: <b>{{$produto->name}}</b></h1>
<p><b>Ativo: </b>{{$produto->ativo}}</p>
<p><b>Número: </b>{{$produto->numero}}</p>
<p><b>Categoria: </b>{{$produto->categoria}}</p>
<p><b>Descrição: </b>{{$produto->descricao}}</p>

@if (isset($errors) && count($errors) > 0)
     <div class="alert alert-danger">
         @foreach ($errors->all(); as $error)
            <p>{{$error}}</p>
         @endforeach
     </div>    
@endif

{!! Form::open(['route'=>['produtos.destroy', $produto->id], 'method'=>'DELETE']) !!}
    {!! Form::submit("Deletar $produto->name", ['class'=>'btn btn-outline-secondary']) !!}

<!-- Primeira forma de inserir botão, em html e com imagem -->
<button type="submit" class="btn btn-outline-info">
<img src="{{url("/assets/painel/imgs/delete-icon.png")}}" width="25px"> EXCLUIR {{$produto->name}}</button>

<a href="{{route('produtos.index')}}" class="btn btn-outline-danger">
<img src="{{url("/assets/painel/imgs/voltar-icon.png")}}" width="25px"> VOLTAR</a>

{!! Form::close() !!}

@endsection