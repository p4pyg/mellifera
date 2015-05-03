@extends('template')
@section('content')
<h2>Structures</h2>
<p>Outil de visualisation de la structure JSON mise en forme pour une entité donnée.</p>
<h3>Sélectionnez l'entité</h3>
<form method="post" action="/structures">
	<div  class="row">
		<div class="col l6 m6 s6">
		@foreach( $entities as $key => $entity )
			<p><input type="radio" id="entity{{ $key }}" name="entity" value="{{ $entity }}" {{ $key == 0 ? 'checked' : '' }}><label for="entity{{ $key }}">{{ ucfirst( str_singular( $entity ) )}}</label></p>
			@if( $key == ( round( count( $entities ) / 2 ) - 1 ) )
		</div>
		<div class="col l6 m6 s6">
			@endif
		@endforeach
		</div>
	</div>
	<div class="row">
		@include( 'components.button_submit' )
	</div>
</form>
@stop