<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Erivelton da Silva">
    <meta name="description" content="Sistema de Gestao de profissionais e Equipes de Saúde">
    <meta name="keywords" content="sistema, gestão, pública, municipal">
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('script-header')
    <title>{{ config('app.name', 'JULIANA') }}</title>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="navbar-brand" >
                        <img src="{{ asset('img/logo.png') }}" class="img-rounded" alt="Cinque Terre" height="60" style="position:relative;top:-10px">
                    </div>
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        {{ config('app.name', 'JULIANA') }}
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    @if (!Auth::guest())
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Configurações<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">Controle de Acesso</li>
                                <li><a href="{{route('users.index')}}"><span class="glyphicon glyphicon-user"></span>Usuários do Sistema</a></li>                                                         
                                <li role="separator" class="divider"></li>
                                <li class="dropdown-header">Configuração basicas</li>
                                <li><a href="{{route('cargo.index')}}"><span class="glyphicon glyphicon-list-alt"></span>Cargos</a></li>
                                <li><a href="{{route('setor.index')}}"><span class="glyphicon glyphicon-list-alt"></span>Setores</a></li>        
                            </ul>
                        </li>                       
                        <li><a href="{{route('servidor.index')}}">Servidores</a></li>
                        <li><a href="{{route('destino.index')}}">Solicitaçoes</a></li> 
                        <li><a href="{{route('guia')}}">Relatórios</a></li>                                              
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Ajuda<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><span class="glyphicon glyphicon-question-sign"></span>Manual</a></li>                            
                                <li><a href="{{ url('/sobre') }}"><span class="glyphicon glyphicon-exclamation-sign"></span>Sobre</a></li>
                            </ul>
                        </li>
                    </ul>
                    @endif
                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><span class="glyphicon glyphicon-log-out"></span>
                                            Sair do sistema
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    <li>
                                        <a href="{{ route('config.users.password') }}"><span class="glyphicon glyphicon-wrench"></span>
                                            Alterar Senha
                                        </a>
                                        <form id="trocarSenha-form" action="#" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        @yield('content')
    </div>
    @yield('script-footer')
</body>
</html>
