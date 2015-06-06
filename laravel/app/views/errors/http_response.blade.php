@extends('template')
@section('content')
	<h2>Backoffice <small>&#8284;</small> Error <small>{{ $response['code'] }}</small></h2>
	<h3 class="red-text text-darken-1">Webservice issue</h3>

		{{ $response['message'] }}

@stop
