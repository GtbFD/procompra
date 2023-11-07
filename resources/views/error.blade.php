@extends('template.app')

@section('title', 'Oops!')

@if(!empty($redirectRoute))
    @section('conteudo')
        <div class="container mt-5">
            <h1>Aconteceu algo inesperado!</h1><br>
            <h6 class="warning">A página que você tentou acessar ou o registro que você tentou manipular não
                foi computado pelo nosso sistema, tente novamente!</h6><br>

            <a class="btn btn-success" href="{{route($redirectRoute)}}">Voltar</a>
        </div>
    @endsection
@endif
