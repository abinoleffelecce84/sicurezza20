<!DOCTYPE html>
<html>

	<head>
		<title>Modifica</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/edit.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/upload.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
        <link rel="favicon" href="{{ asset('image/logo_provincia.ico') }}">
	</head>

	<body>
		@if(Auth::user())
		@if(Auth::user()->work_at == $agency->id)
		<br><br><br><br>
		<p align="center">Sicuro di voler procedere alla<b> modifica</b> del punto <b>{{ $desc->id_1 }}.{{ $desc->id_2 }}.{{ $desc->id_3 }}</b>? Premi "Modifica" per procedere, "Indietro" per annullare.</p>
		<br><br><br><br>
		<div class="container" align="center">
			<form method="POST" action="{{ action('CrudsController@updates',[$agency['id'],$desc['id']]) }}">
			{{ csrf_field() }}
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Descrizione</th>
							<th>Implementazione</th>
							<th>Livello</th>
							<th colspan="3" align="center">Azioni</th>
						</tr>
					</thead>
					<tbody>
						<tr align="center">
							<td>
								<input name="_method" type="hidden" value="PATCH">
								<div class="col-sm-10">
									<textarea name="description" rows="8" cols="70">{{$desc->description}}</textarea>
								</div>
							</td>
							<td>
								<div class="form-group row">
									<div class="col-sm-10">
										<textarea name="implementation" rows="8" cols="70">{{$impl->implementation}}</textarea>
									</div>
								</div>
							</td>
							<td>
								<div class="form-group row">
									<div class="col-sm-10">
										<textarea name="level" rows="1" cols="10" readonly style="text-align: center; cursor: not-allowed;">{{$desc->level}}</textarea>
									</div>
								</div>
							</td>
							<td id="button">
								<div class="form-group row">
									&nbsp;&nbsp;&nbsp;<button id="elimina" type="submit" class="btn btn-primary"><i class="fa fa-pencil fa-lg">&nbsp;&nbsp;&nbsp;</i>Modifica</button>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
		<br><br><br><br><br>
		<a href="{{ URL('cruds/'.$agency['id'].'/index') }}" class="btn btn-warning" >
			<button id="indietro" class="btn btn-danger" type="submit"><i class="fa fa-undo fa-lg">&nbsp;&nbsp;&nbsp;</i> Indietro</button>
		</a>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<footer style="background-color: transparent; height: 80px;">
			<p align="center" style="position: relative; top: 15px;">Software OpenSource, creato per conto di Provincia di Treviso <br> Sviluppato da Paolo Vedorin <br> Collaboratore: Antonio Cianfrone</p>
		</footer>
		@endif
		@endif
		@if(Auth::user()->work_at != $agency->id)
			<br><br><br><br><br>
            <div align="center">
                <a href="{{ URL('/general') }}">
                    <button id="btn_stop" ></button>
                </a>
            </div>
            <p align="center" style="font-size: 25px; font-family: sans-serif;">Accesso Negato</p>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
</html>