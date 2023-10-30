@extends('template.app')

@section('title', 'Registro')

@section('conteudo')
    <div class="container mt-5">
        <form action="{{ @route('user-registrate')  }}" method="post">
            @csrf
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" placeholder="Digite um nome" id="nome" class="form-control"><br>

            <label for="sobrenome" class="form-label">Sobrenome</label>
            <input type="text" name="sobrenome" placeholder="Digite um sobrenome" id="sobrenome"
                   class="form-control"><br>

            <label for="cpf" class="form-label">CPF</label>
            <input type="text" name="cpf" placeholder="000.000.000-00" id="cpf" class="form-control"><br>

            <label for="senha" class="form-label">Senha</label>
            <input type="password" name="senha" placeholder="Senha" id="senha" class="form-control"><br>

            <label for="token_autorizacao" class="form-label">Token (Autorização)</label>
            <input type="password" name="token_autorizacao" placeholder="Token de autorização" id="token_autorizacao"
                   class="form-control"><br>

            <button type="submit" class="btn btn-success ">Registrar</button>
        </form>
    </div>
@endsection

