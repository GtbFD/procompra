@extends('template.app')

@section('title', 'Dashboard')

@section('conteudo')
    @extends('template.navbar')
    <div class="container mt-5">
        <h1>Editar empresa</h1>

        <form action="{{route('complete-edit-company', ['id' => $company->id])}}" method="post">
            @csrf
            @method('PUT')
            <br><label for="cnpj" class="form-label">CNPJ</label>
            <input type="text" name="cnpj" placeholder="CNPJ" id="cnpj"
                   class="form-control" value="{{$company->cnpj}}">

            <br><label for="email" class="form-label">Email</label>
            <input type="text" name="email" placeholder="Email" id="email"
                   class="form-control" value="{{$company->email}}">

            <br><label for="razao_social" class="form-label">Razão social</label>
            <input type="text" name="razao_social" placeholder="Razão social da empresa..." id="razao_social"
                   class="form-control" value="{{$company->razao_social}}">

            <br><label for="telefone" class="form-label">Telefone</label>
            <input type="text" name="telefone" placeholder="Telefone" id="telefone"
                   class="form-control" value="{{$company->telefone}}">

            <br><label for="rua" class="form-label">Rua</label>
            <input type="text" name="rua" placeholder="Rua" id="rua"
                   class="form-control" value="{{$company->rua}}">

            <br><label for="bairro" class="form-label">Bairro</label>
            <input type="text" name="bairro" placeholder="Bairro" id="bairro"
                   class="form-control" value="{{$company->bairro}}">

            <br><label for="cidade" class="form-label">Cidade</label>
            <input type="text" name="cidade" placeholder="Cidade" id="cidade"
                   class="form-control" value="{{$company->cidade}}">

            <br><label for="uf" class="form-label">UF</label>
            <input type="text" name="uf" placeholder="UF" id="uf"
                   class="form-control" value="{{$company->uf}}">

            <br><label for="cep" class="form-label">CEP</label>
            <input type="text" name="cep" placeholder="CEP" id="cep"
                   class="form-control" value="{{$company->cep}}">

            <br><button type="submit" class="btn btn-success ">Editar empresa</button>
        </form><br>
    </div>
@endsection
