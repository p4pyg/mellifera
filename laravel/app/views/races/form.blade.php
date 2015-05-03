@extends('template')
@section('content')
<?php
if ( is_null( $race ) ) {
	$title 			= trans( 'races.create_new_race' );
	$route 			= 'race/create';
}else{
	$title 			= trans( 'races.edit_race' );
	$route 			= 'race/update';
}
?>
		<div class="row valign-wrapper">
			<div class="col l10 m10 s10">
				<h2>{{ $title }}&nbsp;</h2>
			</div>
			<div class="col l2 m2 s2 valign">
			@if( ! is_null( $race ) )
				@include( 'components.button_delete', [ 'item' => $race ] )
			@endif
			</div>
		</div>
	<div class="row">
{{	Form::open( [ 'url' => 'race/edit/' . ( is_null( $race ) ? '' :  $race->id ) , 'method' => 'POST', 'class' => 'col s12', 'id' => 'race_form' ] )	}}
		<div class="row">
			<div class="input-field col l6 m6 s12">
				<input type="text" name="race_name" id="race_name" class="validate" value="{{ is_null( $race ) ? '' : $race->race_name }}">
				<label for="race_name">@lang( 'races.race_name' )</label>
			</div>
			<div class="input-field col l6 m6 s12">
				<input type="text" name="characteristics" id="characteristics" class="validate" value="{{ is_null( $race ) ? '' :  $race->characteristics  }}">
				<label for="characteristics">@lang( 'races.characteristics' )</label>
			</div>
			<div class="input-field col l6 m6 s12">
				<input type="text" name="geographical_origin" id="geographical_origin" class="validate" value="{{ is_null( $race ) ? '' : $race->geographical_origin }}">
				<label for="geographical_origin">@lang( 'races.geographical_origin' )</label>
			</div>
			<div class="input-field col l6 m6 s12">
				<input type="text" name="life_span"  id="life_span" class="validate" value="{{ is_null( $race ) ? '' : $race->life_span }}" >
				<label for="life_span">@lang( 'races.life_span' )</label>
			</div>
		</div>
		@include( 'components.button_submit' )

{{ Form::close() }}
@stop