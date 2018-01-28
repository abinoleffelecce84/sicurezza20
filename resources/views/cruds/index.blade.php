<!DOCTYPE html>
<html>

    <head>
        <title>Benvenuto</title>
        
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/index.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/welcome.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
        <link rel="favicon" type="image/gif" href="{!! asset('image/logo_provincia.gif') !!}"/>
    </head>

    <body>
        @if(Auth::user())
        <nav id="page-top" class="navbar navbar-default navbar-static-top">
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

        <div id="center">
            <h1 align="center"><u>AG</u>enzia per l'<u>I</u>talia <u>D</u>igitale</h1>
        </div>
        <div id="dx" style="float: right;">
            <div id="fix-me">
                <a href="#page-top" title="Torna Su">
                    <i class="fa fa-arrow-circle-up fa-5x" style="color: #FF9000;"></i>
                </a>
            </div>
        </div>
        
        <br><br><br><br><br><br>

        <div class="container">
            <table class="table table-striped" style="width: 100%;" align="center">
                <thead>
                    <tr>
                        <th></th>
                        <th>ABSC_ID</th>
                        <th></th>
                        <th style="padding-left: 15px;">Descrizione</th>
                        <th>Implementazione</th>
                        <th>Livello</th>
                        <th colspan="3" align="center" id="action">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($descs as $descr)
                    <tr>
                        <td id="id">{{ $descr['id_1'] }}</td>
                        <td id="id">{{ $descr['id_2'] }}</td>
                        <td id="id">{{ $descr['id_3'] }}</td>
                        <td id="desc" align="justify" style="padding-left: 15px; padding-right: 15px; min-width: 400px;">{{ $descr['description'] }}</td>
                        @foreach($impls as $imple)
                        @if($imple['work_at']==$agency['id'])
                        @if($imple['id_ref']==$descr['id'])
                        <td id="impl" align="justify" style="width: 900px;">{{ $imple['implementation'] }}</td>
                        @endif
                        @endif
                        @endforeach
                        <td id="lev">{{ $descr['level'] }}</td>
                        <td id="action">
                            <br><br>
                            @if(Auth::user()->work_at == $agency['id'])
                            <a href="{{ action('CrudsController@change',[$agency['id'],$descr['id']]) }}">
                                <button id="elimina" class="btn btn-danger" type="submit"><i class="fa fa-pencil fa-lg">&nbsp;&nbsp;</i>Modifica</button>
                            </a>
                            <br><br>
                            @endif
                            <a href="{{ action('CrudsController@forum',[$agency['id'],$descr['id']]) }}">
                                <button id="modifica" class="btn btn-danger" type="submit" style="width: 90px;"><i class="fa fa-comments-o fa-lg" style="position: relative; right: 2px;">&nbsp;&nbsp;</i>Discuti</button>
                            </a>
                            <br><br><br>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br><br><br>

        <br><br><br><br><br>
        <footer style="background-color: transparent; height: 90px;">
            <p align="center" style="position: relative; top: 15px;">Software OpenSource, creato per conto di Provincia di Treviso <br> Sviluppato da Paolo Vedorin <br> Collaboratore: Antonio Cianfrone</p>
        </footer>
        @endif
        @if(Auth::guest())
            <br><br><br><br>
            <div align="center">
            <a href="{{ URL('/') }}" class="btn btn-danger">
                    <button id="btn_expire" ></button>
                </a>
            </div>
            <p align="center" style="font-size: 25px; font-family: sans-serif;">La sessione è scaduta</p>
        @endif
    </body>

    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
    var fixId, fixTop;
    window.onload = function() { 
      fixId = document.getElementById("fix-me");
      fixTop = fixId.offsetTop;
    }
    window.onscroll = function() { 
      with (fixId.style) {
        if (window.pageYOffset > fixTop) {
          position = "fixed";
          top = "500px";
        } else {
          position = "relative";
          top = "500px";
        }
      }
    }
    </script>
</html>