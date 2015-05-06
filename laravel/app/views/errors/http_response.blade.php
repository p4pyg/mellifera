@extends('template')
@section('content')
	<h2>Whoops <small>{{ $response['code'] }}</small></h2>
	<h3 class="red-text text-darken-1">Webservice error</h3>
	<pre>
		{{ $response['message'] }}
	</pre>
@stop