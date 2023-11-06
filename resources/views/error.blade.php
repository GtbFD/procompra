@extends('template.app')

@section('title', 'Oops!')

@section('conteudo')
    <div class="container mt-5">
        <h1>Aconteceu algo inesperado!</h1><br>
        <h6>A página que você tentou acessar ou o registro que você tentou manipular não
            foi computado pelo nosso sistema, tente novamente!</h6>

        <a class="btn btn-primary" href="{{route('authorization')}}">Voltar</a>
    </div>
@endsection

