<!DOCTYPE html>
<html>
    <head>
    	<title>Enti Registrati</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
        <link href="{{ asset('css/agency.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
        <link rel="favicon" href="{{ asset('image/logo_provincia.ico') }}">
    </head>
    <body>
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

        <div class="container">
            <br><br><br>
            <div class="container" align="center">
                <br><br>
                <a href="{{ action('CrudsController@createUtility') }}" style="padding: 0px; padding-left: 20px;">
                    <button id="modifica" class="btn btn-danger" type="submit"><i class="fa fa-plus fa-lg">&nbsp;&nbsp;&nbsp;</i>Aggiungi</button>
                </a>
                <p style="font-size: 17px;">Qui puoi aggiungere nuovi link che ritieni opportuni</p>
            </div>
            <br><br><br>
    		<table class="table table-striped">
    			<thead>
    				<tr>
    					<th>Nome</th>
    					<th>Indirizzo</th>
    					<th id="head">Azioni</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($utilities as $utility)
    				<tr>
    					<td>{{ $utility['name'] }}</td>
    					<td>{{ $utility['address'] }}</td>
    					<td id="action">
    						<br>
                            @if($utility['nickname']==Auth::user()->nick)
    						<a href="{{ action('CrudsController@changeUtility',$utility['id']) }}">
    							<button id="modifica" class="btn btn-danger" type="submit"><i class="fa fa-pencil fa-lg">&nbsp;&nbsp;</i>Modifica</button>
    						</a>
    						<br><br>
    						<a href="{{ action('CrudsController@deleteUtility',$utility['id']) }}">
    							<button id="elimina" class="btn btn-danger" type="submit" style="width: 90px;"><i class="fa fa-trash fa-lg" style="position: relative; right: 2px;">&nbsp;&nbsp;</i>Elimina</button>
    						</a>
                            @endif
    						<br><br>
    					</td>
    				</tr>
    				@endforeach
    			</tbody>
    		</table>
            <br><br><br><br>
            <a href="{{ URL('general') }}" >
                <button id="indietro" type="submit"><i class="fa fa-undo fa-lg">&nbsp;&nbsp;&nbsp; </i>Indietro</button>
            </a>
            <br><br><br>
            <footer style="background-color: transparent; height: 80px;">
                <p align="center" style="position: relative; top: 15px;">Software OpenSource, creato per conto di Provincia di Treviso <br> Sviluppato da Paolo Vedorin <br> Collaboratore: Antonio Cianfrone</p>
            </footer>
    	</div>
        @endif
        @if(Auth::guest())
            <br><br><br><br>
            <div align="center">
                <a href="{{ URL('') }}">
                    <button id="btn_expire" ></button>
                </a>
            </div>
            <p align="center" style="font-size: 25px; font-family: sans-serif;">La sessione è scaduta</p>
        @endif
    </body>

    <script src="{{ asset('js/app.js') }}"></script>

</html>