@extends('template.app')

@section('title', 'Cadastrar - Empresa')

@section('navbar')
    @extends('template.navbar')
@endsection

@section('conteudo')

    <div class="container mt-5">
        <h1>Cadastrar empresa</h1><br>
        <form action="{{route('registrate-company')}}" method="post">
            @csrf
            <label for="cnpj" class="form-label">CNPJ</label>
            <input type="text" name="cnpj" required placeholder="Digite um CNPJ" id="cnpj" class="form-control"><br>


            <button type="submit" class="btn btn-success ">Cadastrar</button>
        </form>
    </div>
@endsection

