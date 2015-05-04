@extends('template')
@section('content')
<?php
if ( is_null( $apiary ) ) {
	$title 			= trans( 'apiaries.create_new_apiary' );
	$route 			= 'apiary/create';
}else{
	$title 			= trans( 'apiaries.edit_apiary' );
	$route 			= 'apiary/update';
}
?>
		<div class="row valign-wrapper">
			<div class="col l10 m10 s10">
				<h2>{{ $title }}&nbsp;</h2>
			</div>
			<div class="col l2 m2 s2 valign">
			@if( ! is_null( $apiary ) )
				@include( 'components.button_delete', [ 'item' => $apiary ] )
			@endif
			</div>
		</div>
{{	Form::open( [ 'url' => 'apiary/edit/' . ( is_null( $apiary ) ? '' :  $apiary->id ) , 'method' => 'POST', 'class' => 'col s12', 'id' => 'apiary_form' ] )	}}
		<div class="row">
			<div class="input-field col l6 m6 s12">
				<input type="text" name="apiary_name" id="apiary_name" class="validate" value="{{ is_null( $apiary ) ? '' : $apiary->apiary_name }}">
				<label for="apiary_name">@lang( 'apiaries.apiary_name' )</label>
			</div>
			<div class="input-field col l6 m6 s12">
				<input type="text" name="address1" id="address1" class="validate" value="{{ is_null( $apiary ) ? '' : $apiary->address1 }}">
				<label for="address1">@lang( 'apiaries.address1' )</label>
			</div>
			<div class="input-field col l6 m6 s12">
				<input type="text" name="address2" id="address2" class="validate" value="{{ is_null( $apiary ) ? '' : $apiary->address2 }}">
				<label for="address2">@lang( 'apiaries.address2' )</label>
			</div>
			<div class="input-field col l6 m6 s12">
				<input type="text" name="postcode" id="postcode" class="validate" value="{{ is_null( $apiary ) ? '' :  $apiary->postcode  }}">
				<label for="postcode">@lang( 'apiaries.postcode' )</label>
			</div>
				<div class="input-field col l6 m6 s12">
				<input type="text" name="city" id="city" class="validate" value="{{ is_null( $apiary ) ? '' :  $apiary->city  }}">
				<label for="city">@lang( 'apiaries.city' )</label>
			</div>
			<div class="input-field col l6 m6 s12">
				<input type="text" name="longitude" id="longitude" class="validate" value="{{ is_null( $apiary ) ? '' : $apiary->longitude }}">
				<label for="longitude">@lang( 'apiaries.longitude' )</label>
			</div>
				<div class="input-field col l6 m6 s12">
				<input type="text" name="latitude" id="latitude" class="validate" value="{{ is_null( $apiary ) ? '' : $apiary->latitude }}">
				<label for="latitude">@lang( 'apiaries.latitude' )</label>
			</div>
				<div class="input-field col l6 m6 s12">
				<input type="text" name="altitude" id="altitude" class="validate" value="{{ is_null( $apiary ) ? '' : $apiary->altitude }}">
				<label for="altitude">@lang( 'apiaries.altitude' )</label>
			</div>
			<div class="input-field col l6 m6 s12">
				<input type="text" name="vegetation_type"  id="vegetation_type" class="validate" value="{{ is_null( $apiary ) ? '' : $apiary->vegetation_type }}" >
				<label for="vegetation_type">@lang( 'apiaries.vegetation_type' )</label>
			</div>
				<div class="input-field col l6 m6 s12">
				<input type="text" name="hives_capacity" id="hives_capacity" class="validate" value="{{ is_null( $apiary ) ? '' : $apiary->hives_capacity }}">
				<label for="hives_capacity">@lang( 'apiaries.hives_capacity' )</label>
			</div>
				<div class="input-field col l6 m6 s12">
				<input type="text" name="rank" id="altitude" class="validate" value="{{ is_null( $apiary ) ? '' : $apiary->rank }}">
				<label for="rank">@lang( 'apiaries.rank' )</label>
			</div>
		@include( 'components.button_submit' )
		</div>

{{ Form::close() }}
@stop