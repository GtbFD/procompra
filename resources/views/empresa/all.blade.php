@extends('template.app')

@section('title', 'Dashboard')

@section('navbar')
    @extends('template.navbar')
@endsection

@section('conteudo')
    <div class="container mt-5">
        <h1>Empresas</h1>

        <form action="{{route('search-company')}}" method="post">
            @csrf
            <br><label for="razao_social" class="form-label">Pesquisar empresa (Razão social)</label>
            <input type="text" name="razao_social" placeholder="Razão social da empresa..." id="razao_social"
                   class="form-control"><br>

            <button type="submit" class="btn btn-primary ">Pesquisar</button>
        </form>
        <br>

        <div class="table-responsive-xxl">
            <table class="table table-light table-striped">
                <thead>
                <tr>
                    <th scope="col">CNPJ</th>
                    <th scope="col">Razão social</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Cep</th>
                    <th scope="col">...</th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                @foreach($companies as $company)
                    <tr>
                        <td>{{$company->cnpj}}</td>
                        <td>{{$company->razao_social}}</td>
                        <td>{{$company->telefone}}</td>
                        <td>{{$company->email}}</td>
                        <td>RUA, {{$company->rua}}, {{$company->bairro}},
                            {{$company->cidade}} - {{$company->uf}}</td>
                        <td>{{$company->cep}}</td>
                        <td style="width: 15%;">
                            <div class="row">
                                <div class="col">
                                    <a href="{{route('company-documents', ['id' => $company->id])}}" class="btn btn-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             class="bi bi-file-earmark-break" viewBox="0 0 16 16">
                                            <path
                                                d="M14 4.5V9h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v7H2V2a2 2 0 0 1 2-2h5.5L14 4.5zM13 12h1v2a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-2h1v2a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-2zM.5 10a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H.5z"/>
                                        </svg>
                                    </a>

                                    <a href="{{route('edit-company', ['id' => $company->id])}}" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd"
                                                  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </a>

                                    <a href="{{route('delete-company', ['id' => $company->id])}}"
                                       class="btn btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                        </svg>
                                    </a>

                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$companies->links()}}<br>
    </div>
@endsection
