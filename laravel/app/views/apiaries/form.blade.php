@extends('template')
@section('content')
<?php
if ( is_null( $apiary ) ) {
	$title 			= trans( 'apiary.create_new_apiary' );
	$route 			= 'apiary/create';
	$markup_delete 	= '';
}else{
	$title 			= trans( 'apiaries.edit_apiary' );
	$route 			= 'apiary/update';
	$markup_delete 	= '<button><span class="fa fa-trash fa-lg"></span></button>';
}
?>
<div class="all-100">
	<h1>{{ $title }}</h1>
	<button class="ink-button" id="delete">Delete</button>
{{	Form::open( [ 'url' => 'apiary/edit/' . $apiary->id, 'method' => 'POST', 'class' => 'ink-form', 'id' => 'apiary_form' ] )	}}

		<div class="column-group gutters">
			<div class="control-group all-33">
				<label for="name">@lang( 'apiaries.apiary_name' )</label>
				<div class="control">
					<input type="text" name="name" id="name" placeholder="@lang( 'apiaries.apiary_name' )" value="{{ is_null( $apiary ) ? '' : $apiary->apiary_name }}">
				</div>
				<p class="tip">Indiquez ici le nom du rucher</p>
			</div>
			<div class="control-group all-33">
				<label for="longitude">@lang( 'apiaries.longitude' )</label>
				<div class="control">
					<input type="text" name="longitude" id="longitude" value="{{ is_null( $apiary ) ? '' : $apiary->longitude }}">
				</div>
				<p class="tip">Indiquez ici la longitude du rucher</p>
			</div>
			<div class="control-group all-33">
				<label for="latitude">@lang( 'apiaries.latitude' )</label>
				<div class="control">
					<input type="text" name="latitude" id="latitude" value="{{ is_null( $apiary ) ? '' : $apiary->latitude }}">
				</div>
				<p class="tip">Indiquez ici la latitude du rucher</p>
			</div>
			<div class="control-group all-33">
				<label for="altitude">@lang( 'apiaries.altitude' )</label>
				<div class="control">
					<input type="text" name="altitude" id="altitude" value="{{ is_null( $apiary ) ? '' : $apiary->altitude }}">
				</div>
				<p class="tip">Indiquez ici l'altitude du rucher</p>
			</div>
			<div class="control-group all-33">
				<label for="vegetation_type">@lang( 'apiaries.vegetation_type' )</label>
				<div class="control">
					<input type="text" name="vegetation_type" id="vegetation_type" value="{{ is_null( $apiary ) ? '' : $apiary->vegetation_type }}">
				</div>
				<p class="tip">Indiquez ici le type de végétation</p>
			</div> 
			<div class="control-group all-33">
				<label for="hives_capacity">@lang( 'apiaries.hives_capacity' )</label>
				<div class="control">
					<input type="text" name="hives_capacity" id="hives_capacity" value="{{ is_null( $apiary ) ? '' : $apiary->hives_capacity }}">
				</div>
				<p class="tip">Indiquez ici la capacité de la ruche</p>
			</div>
			<div class="control-group all-33">
				<label for="apiary_notes">@lang( 'apiaries.apiary_notes' )</label>
				<div class="control">
					<input type="text" name="apiary_notes" id="apiary_notes" value="{{ is_null( $apiary ) ? '' : $apiary->apiary_notes }}">
				</div>
				<p class="tip">Indiquez ici la note du rucher</p>
			</div>
			<div class="control-group all-33">
				<label for="notes">@lang( 'apiaries.notes' )</label>
				<div class="control">
					<input type="text" name="notes" id="notes" value="{{ is_null( $apiary ) ? '' : $apiary->notes }}">
				</div>
				<p class="tip">Vous pouvez ajouter ici des notes</p>
			</div> 
		</div>
		<button class="ink-button" id="valid">Valider</button>
{{ Form::close() }}
</div>
<script>
// $( '#valid' ).on( 'click', function(){
// 	var name = $( '#name' ).val();
// 	var longitude = $( '#longitude' ).val();
//  var latitude = $( '#latitude' ).val();
// 	var altitude = $( '#altitude' ).val();
// 	var vegetation_type = $( '#vegetation_type' ).val();
//  var hives_capacity = $( '#hives_capacity' ).val();
//  var apiary_notes = $( '#apiary_notes' ).val();
//  var notes = $( '#notes' ).val();
// 	$.post( 'https://bee-mellifera.herokuapp.com/apiary',
// 		{
// 			"id": {{ $apiary->id }},
// 			"transaction":null,
// 			"unit":null,
//
// 			
// 		} )
// 	.done( function( response ){
// 		console.log( 'response', response );
// 	} )
// 	.fail( function( error ){
// 		console.log( 'error', error );
// 	} );
// } );
			// "longitude": longitude,
			// "latitude": latitude,
			// "altitude": altitude
</script>
@stop