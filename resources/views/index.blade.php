<!DOCTYPE html>
<html>
    <head>
    	<title>Benvenuto</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
        <link rel="favicon" type="image/gif" href="{!! asset('image/logo_provincia.gif') !!}"/>
        <style type="text/css">
            #fade { 
                display: none;
                background: transparent;
                position: fixed;
                left: 0;
                top: 0;
                z-index: 10;
                z-index: 9999; 
            }
            .popup_block{ 
                display: none;
                background: white;
                padding: 20px;
                float: left;
                font-size: 1.2em;
                position: fixed;
                top: 80%;
                left: 50%;
                z-index: 99999;
                -webkit-box-shadow: 0px 0px 20px #000;
                -moz-box-shadow: 0px 0px 20px #000;
                box-shadow: 0px 0px 20px #000;
                -webkit-border-radius: 10px;
                -moz-border-radius: 10px;
                border-radius: 10px;
            } 
            img.btn_close { 
                float: right;
                margin: -55px -55px 0 0;
            } 
            .popup p {
                padding: 5px 10px;
                margin: 5px 0;
            }

            /*--Making IE6 Understand Fixed Positioning--*/
            *html #fade { position: absolute; }
            *html .popup_block { position: absolute; }
        </style>

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

        <div class="container" align="center">
            <br><br><br><br>
            <h1>Benvenuto, {{ Auth::user()->name }}</h1>
            <p align="center" style="font-size: 19px;">Seleziona l'ente di cui vuoi vedere i punti della circolare AgID. Ricorda che puoi modificare <b>SOLO</b> i punti dell'ente per il quale lavori</p>
            @if($count>0)
                <div id="popup" class="popup_block">
                    <p style="color: red; font-size: 14px; cursor: default; position: relative; top: 5px;">
                        Ci sono delle nuove notifiche nelle sezioni da te commentate.
                    </p>
                </div>
            @endif
            <br><br><br><br>
            <div style="max-width: 900px; padding-bottom: 20px;">
            @foreach($agencies as $workplace)
                <a href="{{ action('CrudsController@indexs',$workplace['id']) }}">Crud di {{ $workplace['name'] }}</a>&nbsp;&nbsp;&nbsp;
            @endforeach
            </div>
        </div>
        <footer id="footer">
            <p align="center">Software OpenSource, creato per conto di Provincia di Treviso <br> Sviluppato da Paolo Vedorin <br> Collaboratore: Antonio Cianfrone</p>
        </footer>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){ 
            var doIt = function() {
             $("#popup").fadeIn().css({ 'width': 420 }).prepend('');
             var popMargTop = ($("#popup").height() + 80) / 2; 
             var popMargLeft = ($("#popup").width() + 80) / 2;
             //Fade in Background 
             $('body').append('<div id="fade"></div>'); //Aggiunge il livello oscurato alla fine del tag Body 
             $('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); //Rende visibile il livello oscurato
             //Apply Margin to Popup 
             $('#popup').css({'margin-top' : -popMargTop,'margin-left' : -popMargLeft});
             $(".btn_close").click(function() {
             $("#popup").fadeOut(function() { 
             $('#fade, a.close').remove(); 
             }); //fade them both out
             });
            }
            var doOut = function() {
             $("#popup").fadeOut(function() { 
             $('#fade, a.close').remove(); 
             }); //fade them both out
            }
            setTimeout(doIt, 1000);
            setTimeout(doOut, 6000);
        }); 
    </script>

</html>