<!DOCTYPE html>
<html>
	<head>
		<title>Aggiungi Ente</title>
		
		<meta name="csrf-token" content="{{ csrf_token() }}">
        
        <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
        <link href="{{ asset('css/add.css') }}" rel="stylesheet">
        <link href="{{ asset('css/edit.css') }}" rel="stylesheet">
        <link rel="favicon" href="{{ asset('image/logo_provincia.ico') }}">
	</head>
	<body>
		@if(Auth::user())
		@if(Auth::user()->role == 'SA')
		<div class="container" align="center">
			<br><br><br><br>
		<p align="center">Puoi aggiungere una nuova risorsa compilando questo form e premendo <b><u>Aggiungi</u></b>.</p>
		<br><br><br><br>
			<form method="POST" action="{{ action('AgencyController@store') }}">
			{{ csrf_field() }}
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Telefono</th>
							<th>Indirizzo</th>
							<th>Azioni</th>
						</tr>
					</thead>
					<tbody>
						<tr align="center">
							<td>
								<div class="col-sm-10">
									<textarea name="name" rows="2" cols="40" required></textarea>
								</div>
							</td>
							<td>
								<div class="form-group row">
									<div class="col-sm-10">
										<textarea name="phone" rows="2" cols="40" required></textarea>
									</div>
								</div>
							</td>
							<td>
								<div class="form-group row">
									<div class="col-sm-10">
										<textarea name="address" rows="2" cols="60" required></textarea>
									</div>
								</div>
							</td>
							<td id="button">
								<div class="form-group row">
									<button id="elimina" type="submit" class="btn btn-primary"><i class="fa fa-plus fa-lg">&nbsp;&nbsp;&nbsp;</i>Aggiungi</button>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
		<br><br><br><br><br>
		<a href="{{ URL('/gestionente') }}" class="btn btn-warning" >
			<button id="indietro" class="btn btn-danger" type="submit"><i class="fa fa-undo fa-lg">&nbsp;&nbsp;&nbsp;</i> Indietro</button>
		</a>
		<br><br><br><br><br><br><br><br><br>
		@endif
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
		@if(Auth::user()->role != 'SA')
            <br><br><br><br><br><br><br>
            <div align="center">
                <a href="{{ URL('') }}">
                    <button id="btn_stop"></button>
                </a>
            </div>
            <p align="center" style="font-size: 25px; font-family: sans-serif;">Accesso Negato</p>
        @endif
	</body>
</html>