<!DOCTYPE html>
<html>
    <head>
        <title>Benvenuto</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/index.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
        <link rel="favicon" type="image/gif" href="{!! asset('image/logo_provincia.gif') !!}"/>
    </head>
    <body id="body">
        <br><br><br>
        @if(Auth::user()->work_at == NULL)
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Dashboard</div>

                        <div class="panel-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            Benvenuto, {{ Auth::user()->name }}. Completa la tua registrazione per poter accedere al servizio.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php
            $id = Auth::user()->id;
        @endphp

        <div class="container" id="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Registra Nuova Utenza</div>

                        <div class="panel-body">

                            @if(Auth::user()->nick==NULL)
                            <form class="form-horizontal" method="POST" action="{{ action('Register2Controller@check',$id) }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name" class="col-md-4 control-label">Nickname</label>
                                    <div class="col-md-6">
                                        <input id="nick" type="text" class="form-control" name="nick" value="{{ Auth::user()->nick }}" required autofocus>
                                        @if($count==0)
                                        <p align="left" class="col-sm-12 offset" style="position: relative; top: 5px; right: 2px;">Non disponibile</p>
                                        @endif
                                        <br><br>
                                        <div class="col-md-1 form-group">
                                            <button type="submit" class="btn btn-primary">
                                                Controlla Disponibilità
                                            </button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                            @endif
                            @if(Auth::user()->nick!=NULL)
                            <form class="form-horizontal" method="POST" action="{{ action('Register2Controller@check',$id) }}" >
                                <div class="form-group">
                                    <label for="name" class="col-md-4 control-label">Nickname</label>
                                    <div class="col-md-6">
                                        <input id="nick" type="text" class="form-control" name="nick" value="{{ Auth::user()->nick }}" required autofocus readonly>
                                        <p align="left" class="col-sm-12 offset" style="position: relative; top: 5px; right: 2px;">Nickname Disponibile</p>
                                        <br><br>
                                    </div>
                                </div>
                            </form>
                            @endif

                            <form class="form-horizontal" method="POST" action="{{ action('Register2Controller@update',$id) }}">
                                {{ csrf_field() }}
                                    
                                <div class="form-group">
                                    <label for="email" class="col-md-4 control-label">Telefono</label>

                                    <div class="col-md-6">
                                        <input id="phone" type="text" class="form-control" name="phone">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-md-4 control-label">Ruolo*</label>

                                    <div class="col-md-6">
                                        <input id="role" type="text" class="form-control" name="role" readonly value="{{ Auth::user()->role }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm" class="col-md-4 control-label">Ente</label>

                                    <div class="col-md-6" style="position: relative; top: 6px;">
                                        <select name="work_at" required>
                                        <option value="">Selezionare...</option>
                                        @foreach($agencies as $workplace)
                                            <option value="{{ $workplace['id'] }}">{{ $workplace['name'] }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                                @if(Auth::user()->checked==1)
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Completato
                                        </button>
                                    </div>
                                </div>
                                @endif
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            <p align="center"><span style="font-size: 25px;">*</span> Per richiedere un cambio di ruolo per il proprio utente, scrivere a ced@provincia.treviso.it</p>
        </div>
        @endif
        @if(Auth::user()->work_at != NULL)
        <div align="center">
        <a href="{{ URL('/general') }}">
                <button id="btn_w" ></button>
            </a>
        </div>
        <p class="col-lg-5" align="center" style="position: relative; left: 30%; font-size: 25px; font-family: sans-serif;">Hai già completato questa sezione</p>
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
