@extends('template.app')

@section('title', 'Dashboard')

@section('conteudo')
    <div class="container mt-5">
        <h1>Seja bem-vindo(a)</h1>
        <h6>{{$user->nome}} {{$user->sobrenome}}</h6>
    </div>

    @extends('template.navbar')
@endsection
