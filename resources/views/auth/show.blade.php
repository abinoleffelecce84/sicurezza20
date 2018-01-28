<!DOCTYPE html>
<html>
    <head>
        <title>Password Dimenticata</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/register.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
        <link rel="favicon" type="image/gif" href="{!! asset('image/logo_provincia.gif') !!}"/>
    </head>
    <body>
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
                    <a class="navbar-brand" href="{{ url('/') }}">
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
                        <!-- Authentication Links -->
                        <li><a href="{{ route('login') }}">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Cambia Password</div>
                        <div class="panel-body">
                            @if($count<=0)
                        	<form class="form-horizontal" method="POST" action="{{ action('Register2Controller@checkNick') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="text" class="col-md-4 control-label">Nickname</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="nick" required autofocus>
                                    </div>
                                    @if($count==0)
                                    <div class="col-md-8 col-md-offset-4">
                                        <span>Nickname non trovato</span>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-check fa-lg"></i>&nbsp;&nbsp;&nbsp;Controlla Nickname
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @endif
                            @if($count>0 && $countEmail<=0)
                            <form class="form-horizontal" method="POST" action="{{ action('Register2Controller@checkEmail',$id) }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="text" class="col-md-4 control-label">Nickname</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="nick" value="{{ $user }}" readonly autofocus>
                                </div>
                                <div class="col-md-8 col-md-offset-4">
                                    <span>Nickname trovato</span>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="text" class="col-md-4 control-label">E-Mail</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="email" required autofocus>
                                </div>
                                @if($countEmail==0)
                                <div class="col-md-8 col-md-offset-4">
                                    <span>Email non corrisponde all'user</span>
                                </div>
                                @endif
                                <br><br><br>
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-check fa-lg"></i>&nbsp;&nbsp;&nbsp;Controlla Email
                                    </button>
                                </div>
                            </div>
                            @endif
                            </form>
                            @if($count>0 && $countEmail>0)
                            <form class="form-horizontal" method="POST" action="{{ action('Register2Controller@changePassword',$id) }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="text" class="col-md-4 control-label">Nickname</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="nick" value="{{ $user->nick }}" readonly autofocus>
                                </div>
                                <div class="col-md-8 col-md-offset-4">
                                    <span>Nickname trovato</span>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="text" class="col-md-4 control-label">E-Mail</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="email" value="{{ $user->email }}" readonly autofocus>
                                </div>
                                <div class="col-md-8 col-md-offset-4">
                                    <span>Email corrisponde all'user</span>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="text" class="col-md-4 control-label">Inserire Nuova Password</label>

                                <div class="col-md-6">
                                    <input id="name" type="password" class="form-control" name="password" required autofocus>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="text" class="col-md-4 control-label">Conferma Password</label>

                                <div class="col-md-6">
                                    <input id="name" type="password" class="form-control" name="password2" required autofocus>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-sign-in fa-lg"></i>&nbsp;&nbsp;&nbsp;Cambia Password
                                    </button>
                                </div>
                            </div>
                            </form>
                            @endif
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
    <script type="text/javascript">
		function check(modulo)
		{
			if(modulo.password.value != modulo.password2.value)
			{
				alert("Le password sono diverse.");
				modulo.password.focus()
				modulo.password.select()
				return false
			}
			return true
		}
	</script>
</html>