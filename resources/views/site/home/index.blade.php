@extends('site.templates.template1')

@section('content')

<h1>Home page do site!</h1>
<br><br>

{{$xss}}
<br><br>

@if($var1 == '1234')
    <p>É igual</p>
@else
    <p>É diferente</p>
@endif

@unless ($var1 == '1234')
    <p>Não é igual... unless</p>
@endunless

@for ($i = 0; $i < 10; $i++)
    <p>For: {{$i}}</p>
@endfor

{{--
@if ( count($arrayData) > 0)
    @foreach ($arrayData as $array)
        <p>If com Foreach: {{$array}}</p>
    @endforeach    
@else
    <p>If com Foreach: Não existem itens para serem impressos.</p>
@endif --}}

@forelse ($arrayData as $array)
    <p>Forelse: {{$array}}</p>
@empty
    <p>Forelse: Não existe itens para serem exibidos.</p>
@endforelse

@include('site.includes.sidebar', compact('var1'))

@endsection

@push('scripts')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
@endpush