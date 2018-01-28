<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Benvenuto</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
        <link rel="favicon" type="image/gif" href="{!! asset('image/logo_provincia.gif') !!}"/>
    </head>
    <body>
        @if(Auth::guest())
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div id="animated1">
                    <div class="title m-b-md">
                        Provincia di Treviso
                    </div>
                    <div class="title m-b-md">
                        AGenzia Italia Digitale
                    </div>
                </div>
            </div>
        </div>
        <div align="center" style="position: relative; bottom: 20%;">
        <div id="animated2">
            <div class="links">
                    <a id="login" href="{{ route('login') }}" style="border-style: solid; border-width: 0.5px; padding: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    <a id="register" href="{{ route('register') }}" style="border-style: solid; border-width: 0.5px; padding: 10px;">Registrati</a>
                </div>
            </div>
        </div>
        @endif
        @if(Auth::user())
        @if(Auth::user()->work_at == NULL)
        <br><br><br><br>
        <div align="center">
            <a href="{{ URL('home') }}">
                <button id="btn_w" ></button>
            </a>
        </div>
        <p align="center" style="font-size: 25px; font-family: sans-serif;">Completa la Registrazione per procedere</p>
        @endif
        @if(Auth::user()->work_at != NULL)
        <div class="content">
            <br><br><br>
            <p style="font-size: 20px;">Guida all'utilizzo</p>
            <div class="container" id="container" style="position: relative; top: 100px;">
                <ul align="left">
                    <li>
                        <p>L'utente può <strong>leggere e modificare</strong> l'implementazione del proprio ente per il quale si è loggato. Per modificare il punto sarà sufficiente premere il bottone &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="elimina" style="pointer-events: none;"><i class="fa fa-pencil fa-lg">&nbsp;&nbsp;</i>Modifica</button></p>
                    </li>
                    <li>
                        <p>L'utente può <strong>leggere</strong> l'implementazione degli altri enti</p>
                    </li>
                    <li class="dropdown">
                        <span>L'utente può inserire link alle risorse utili dentro a &nbsp;&nbsp;</span>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu" style="position: absolute; left: 300px;">
                            <li>
                                <div>
                                    <a href="{{ action('CrudsController@utilities') }}" style="position: relative; left: 5px; pointer-events: none;">Link Utili</a>
                                </div>
                            </li>
                        </ul>
                        <span>&nbsp;&nbsp;presente in alto a destra dalla prossima schermata</span>
                    </li>
                    <br>
                    <li>
                        <p>È presente un centro notifiche ove sarà possibile vedere i nuovi interventi</p>
                    </li>
                    <li>
                        <p>Ogni utente ha la possibilità di <strong>discutere</strong> la propria implementazione o quella di un altro ente nell'apposito forum. Per entrarvi premere il bottone &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="modifica" style="pointer-events: none; position: relative; left: -8px;"><i class="fa fa-comments-o fa-lg" style="position: relative; right: 2px;">&nbsp;&nbsp;</i>Discuti</button></p>
                        <ul>
                            <li>
                                <p>Gli utenti possono <strong>commentare</strong> ciascun punto di qualsiasi ente scrivendo il testo nell'apposita area posta in basso e premendo &nbsp;&nbsp;&nbsp;<button id="elimina" type="submit" class="btn btn-primary" style="position: relative; left: 12px; 
                                pointer-events: none;"><i class="fa fa-pencil fa-lg">&nbsp;&nbsp;&nbsp;</i>Commenta</button></p>
                            </li>  
                            <li>
                                <p>L'utente ha la possibilità di <strong>eliminare</strong> il commento postato premendo il bottone &nbsp;&nbsp;&nbsp;<button id="elimina" type="submit" class="btn btn-primary" style="position: relative; left: 12px; pointer-events: none;"><i class="fa fa-trash fa-lg">&nbsp;&nbsp;&nbsp;</i>Elimina</button></p>
                            </li>  
                        </ul>
                    </li>
                    <li class="dropdown">
                        <span>In caso di necessità, per tornare a questa schermata premere &nbsp;&nbsp;</span>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu" style="position: absolute; left: 370px;">
                            <li>
                                <div>
                                    <a href="{{ action('CrudsController@utilities') }}" style="position: relative; left: 5px; pointer-events: none;"><i class="fa fa-question fa-lg"></i></a>
                                </div>
                            </li>
                        </ul>
                        <span>&nbsp;&nbsp;presente in alto a destra dalla prossima schermata</span>
                    </li>
                    <br>
                    <li>
                        <p>In caso si riscontrino bug, si prega di contattare <u>vedorinpaolo@gmail.com</u></p>
                    </li>
                </ul>
                <br><br><br>
                <a href="{{ action('Register2Controller@index') }}">Procedi</a>
            </div>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br>
        <footer id="footer">
            <p align="center">Software OpenSource, creato per conto di Provincia di Treviso <br> Sviluppato da Paolo Vedorin <br> Collaboratore: Antonio Cianfrone</p>
        </footer>
        @endif
        @endif
    </body>

    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">$(document).ready(function() { $('#animated1').hide().delay(1000).fadeIn(500); } );</script>
    <script type="text/javascript">$(document).ready(function() { $('#animated2').hide().delay(1500).fadeIn(700); } );</script>

</html>
