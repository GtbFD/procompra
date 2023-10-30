<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Procompra</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{@route('authorization')}}">Início</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Empresa
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('company-registration')}}">Cadastrar</a></li>
                        <li><a class="dropdown-item" href="{{route('show-companies')}}">Ver empresas</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Documento
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('create-document')}}">Criar</a></li>
                        <li><a class="dropdown-item" href="{{route('show-companies')}}">Ver documentos</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{@route('logout')}}">Sair</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
