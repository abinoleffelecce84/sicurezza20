<!DOCTYPE html>
<html>

    <head>
        <title>Forum</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/welcome.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/delete.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
        <link rel="favicon" href="{{ asset('image/logo_provincia.ico') }}">
    </head>

    <body style="overflow-x: hidden;">
    
        @if(Auth::user())
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/general') }}">
                        <i class="fa fa-home fa-lg"></i>
                    </a>
                </div>
                
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        @if($count>0)
                        <li style="background-color: rgba(253,100,100,0.4); border-radius: 5px;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color: black;"> Centro Notifiche <span style="background-color: rgba(253,100,100,0.4); color: black; border: 1px solid red; padding: 5px; border-radius: 7px;">{{ $count }}</span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <div id="dropdown-menu" style="position: relative; left: 5px; width: 300px;">
                                        <p>I nuovi interventi</p>
                                        @foreach($notifications as $notification)
                                        @if($notification['nickname']==Auth::user()->nick)
                                        <a href="{{ url('cruds/'.$notification['work_at'].'/forum/'.$notification['id_ref']) }}">
                                            @foreach($agencies as $agency)
                                                @if($agency['id'] == $notification['work_at'])
                                                    <strong>Ente</strong>: {{ $agency['name'] }}
                                                    @foreach($descriptions as $description)
                                                    @if($notification['id_ref'] == $description['id'])
                                                        <strong>Punto</strong>: {{ $description['id_1'] }}.{{ $description['id_2'] }}.{{ $description['id_3'] }}
                                                    @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </a>
                                        @endif
                                        @endforeach
                                    </div>
                                    <div id="dropdown-menu" style="position: relative; left: 5px;">
                                    </div>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @if($count==0)
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Centro Notifiche
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <div id="dropdown-menu" style="position: relative; left: 5px; width: 300px;">
                                        <p style="pointer-events: none;">I nuovi interventi</p>
                                        <p align="center" style="color: #EFEFEF; pointer-events: none;">Non ci sono nuovi interventi</p>
                                    </div>
                                    <div id="dropdown-menu" style="position: relative; left: 5px;">
                                    </div>
                                </li>
                            </ul>
                        </li>
                        @endif
                        <!-- Authentication Links -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    @if(Auth::user()->role=='SA')
                                    <div id="dropdown-menu" style="position: relative; left: 5px;">
                                        <a href="{{ action('AgencyController@index') }}"> Gestione Ente </a>
                                    </div>
                                    @endif
                                    <div>
                                        <a href="{{ action('CrudsController@utilities') }}" style="position: relative; left: 5px;">Link Utili</a>
                                    </div>
                                    <div>
                                        <a href="{{ url('/') }}" style="position: relative; left: 5px;"><i class="fa fa-question fa-lg"></i></a>
                                    </div>
                                    <div id="dropdown-menu" style="position: relative; left: 5px;">
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br><br><br>
        <div id="cavoloamaro">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>ABSC_ID</th>
                        <th></th>
                        <th>Descrizione</th>
                        <th>Implementazione</th>
                        <th>Livello</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($descs as $desc)
                    <tr>
                        <td id="id">{{ $desc['id_1'] }}</td>
                        <td id="id">{{ $desc['id_2'] }}</td>
                        <td id="id">{{ $desc['id_3'] }}</td>
                        <td id="desc">{{ $desc['description'] }}</td>
                        @foreach($impls as $imple)
                        @if($imple['work_at']==$agency['id'])
                        @if($imple['id_ref']==$desc['id'])
                        <td id="impl" align="justify" style="width: 900px;">{{ $imple['implementation'] }}</td>
                        @endif
                        @endif
                        @endforeach
                        <td id="lev">{{ $desc['level'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br><br><br><br><br>
        <div id="cavoloamaro">
            <table class="table table-striped" style="width: 100%;" align="center">
                <thead>
                    <tr>
                        <th>Utente</th>
                        <th>Commento</th>
                        <th style="position: relative; left: 5px;">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comms as $com)
                    <tr>
                        <td id="id" style="width: 30%; text-align: left;"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nickname</strong>: {{ $com['user'] }}<br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ente</strong>: {{ $com['agency'] }}<br><strong>Pubblicato il</strong>: {{$com['created_at']}}</td>
                        <td id="id" style="text-align: justify;">
                            {{ $com['comment'] }}
                        </td>
                        <td style="width: 20px; padding-left: 30px; position: relative; top: 15px;">
                            @if($com['user']==Auth::user()->nick)
                            <a href="{{ action('CrudsController@delete',$com['id']) }}">
                                <button id="elimina" class="btn btn-danger" type="submit" style="padding: 10px 14px;"><i class="fa fa-trash fa-lg">&nbsp;&nbsp;</i>Elimina</button>
                            </a>
                            <br>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br><br><br>
        <form method="POST" action="{{ action('CrudsController@addComment',[$agency['id'],$desc['id'],Auth::user()->id]) }}">
        {{ csrf_field() }}
            <div class="form-group row">
                <div class="col-sm-10" align="center" style="position: relative; left: 120px;">
                    <textarea name="comment" rows="8" cols="70" placeholder=" Utilizza questo spazio per commentare" style="border-radius: 10px; border-bottom-right-radius: 28px; border-bottom-left-radius: 0px; outline: none; padding-left: 10px;"></textarea>
                    &nbsp;&nbsp;&nbsp;<button id="elimina" type="submit" class="btn btn-primary" style="position: relative; bottom: 13px; left: 10px;"><i class="fa fa-pencil fa-lg">&nbsp;&nbsp;&nbsp;</i>Commenta</button>
                </div>
            </div>
        </form>
        <br><br>
        <a href="{{ URL('cruds/'.$agency['id'].'/index') }}" >
            <button id="indietro" type="submit"><i class="fa fa-undo fa-lg">&nbsp;&nbsp;&nbsp;</i>Indietro</button>
        </a>
        <br><br>
        <footer id="footer">
            <p align="center">Software OpenSource, creato per conto di Provincia di Treviso <br> Sviluppato da Paolo Vedorin <br> Collaboratore: Antonio Cianfrone</p>
        </footer>
        @endif
        @if(Auth::guest())
        <br><br><br><br>
        <div align="center">
        <a href="{{ URL('/') }}" class="btn btn-danger">
                <button id="btn_expire"></button>
            </a>
        </div>
        <p align="center" style="font-size: 25px; font-family: sans-serif;">La sessione è scaduta</p>
        @endif
    </body>

    <script src="{{ asset('js/app.js') }}"></script>

</html>