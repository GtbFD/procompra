@extends('template.app')

@section('title', 'Dashboard')

@section('navbar')
    @extends('template.navbar')
@endsection

@section('conteudo')
    <div class="container mt-5">
        <h1>Documentos</h1>

        <!--<form action="" method="post">
            @csrf
            <br><label for="tipo_documento" class="form-label">Pesquisar documento (Tipo de documento)</label>
            <input type="text" name="tipo_documento" placeholder="Tipo de documento" id="tipo_documento"
                   class="form-control"><br>

            <button type="submit" class="btn btn-primary ">Pesquisar</button>
        </form>-->
        <br><a href="{{route('create-document')}}" class="btn btn-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                 fill="currentColor"
                 class="bi bi-file-earmark-break" viewBox="0 0 16 16">
                <path
                    d="M14 4.5V9h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v7H2V2a2 2 0 0 1 2-2h5.5L14 4.5zM13 12h1v2a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-2h1v2a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-2zM.5 10a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H.5z"/>
            </svg>
            Criar/atualizar documento
        </a><br>
        <br>

        <div class="table-responsive-xxl">
            <table class="table table-light table-striped">
                <thead>
                <tr>
                    <th scope="col">Tipo de documento</th>
                    <th scope="col">Última atualização</th>
                    <th scope="col">...</th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                @foreach($documents as $document)
                    <tr>
                        <td style="text-transform: uppercase">Certidão Negativa {{$document->tipo_documento}}</td>
                        <td>{{date('d/m/Y H:i:s', strtotime($document->ultima_atualizacao))}}</td>
                        <td style="width: 15%;">
                            <div class="row">
                                <div class="col">
                                    <a href="http://localhost/procompra/public/storage/{{$document->url_arquivo}}" target="_blank" class="btn btn-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
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
    </div>
@endsection
