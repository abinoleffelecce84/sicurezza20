<!DOCTYPE html>
<html>
	<head>
		<title>Elimina</title>
		
		<link rel="stylesheet" type="text/css" href="{{ asset('css/edit.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
		<link rel="favicon" href="{{ asset('image/logo_provincia.ico') }}">
	</head>

	<body style="font-family: 'Raleway', sans-serif;">
		<br><br><br><br><br>
		@if(Auth::user())
		@if(Auth::user()->role == 'SA')
		<div>
			<div id="foot" role="navigation">
				<div data-jibp="h" data-jiis="uc" id="cljs"></div>
				<span data-jibp="h" data-jiis="ic" id="xjs">
					<div id="navcnt">
						<p align="center">Sicuro di voler procedere all'<b>eliminazione</b> dell'ente <b>{{ $agency->name }}</b> ? Premi "Elimina" per procedere, "Indietro" per annullare</p>
						<br><br><br><br><br><br>
					</div>
				</span>
			</div>
		</div>

		<div class="container">
			<table class="table table-striped" align="center" style="width: 76%;">
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
						<td id="id">{{ $agency['name'] }}</td>
						<td id="id">{{ $agency['phone'] }}</td>
						<td id="id">{{ $agency['address'] }}</td>
						<td id="action" align="center">
							<a href="{{ action('AgencyController@delete',$agency['id']) }}" class="btn btn-warning">
								<button id="elimina" class="btn btn-danger" type="submit" style="position: relative; left: 1px;"><i class="fa fa-trash fa-lg">&nbsp;&nbsp;&nbsp;</i>Elimina</button>
							</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<br><br><br><br>
		<a href="{{ url('/gestionente') }}" class="btn btn-warning" >
			<button id="indietro" class="btn btn-danger" type="submit"><i class="fa fa-undo fa-lg">&nbsp;&nbsp;&nbsp;</i> Indietro</button>
		</a>
		@endif
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
		@if(Auth::user()->role != 'SA')
            <div align="center">
                <a href="{{ URL('general') }}">
                    <button id="btn_stop" ></button>
                </a>
            </div>
            <p align="center" style="font-size: 25px; font-family: sans-serif;">Accesso Negato</p>
        @endif
	</body>
</html>