@extends('template.app')

@section('title', 'Autenticação')

@section('conteudo')
    <div class="container mt-5">
        <h1>Fazer login!</h1><br>
        <form action="{{ @route('user-autenticate')  }}" method="post">
            @csrf

            <label for="cpf" class="form-label">CPF</label>
            <input type="text" name="cpf" placeholder="000.000.000-00" id="cpf" class="form-control"><br>

            <label for="senha" class="form-label">Senha</label>
            <input type="password" name="senha" placeholder="Senha" id="senha" class="form-control"><br>

            <button type="submit" class="btn btn-primary ">Autenticar</button>
        </form>
    </div>
@endsection

