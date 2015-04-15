@extends('template')
@section('content')
<?php
if ( is_null( $race ) ) {
	$title 			= trans( 'races.create_new_race' );
	$route 			= 'race/create';
	$markup_delete 	= '';
}else{
	$title 			= trans( 'races.edit_race' );
	$route 			= 'race/update';
	$markup_delete 	= '<button class="ink-button" id="delete" data-item-index="' . $race->id . '"><span class="fa fa-trash fa-lg"></span></button>';
}
?>
<div class="all-100">
	<h1>{{ $title }}</h1>
	{{ $markup_delete }}
{{	Form::open( [ 'url' => 'race/edit/' . ( is_null( $race ) ? '' :  $race->id ) , 'method' => 'POST', 'class' => 'ink-form', 'id' => 'race_form' ] )	}}

		<div class="column-group gutters">
			<div class="control-group all-33">
				<label for="race_name">@lang( 'races.race_name' )</label>
				<div class="control">
					<input type="text" name="race_name" id="race_name" placeholder="@lang( 'races.race_name' )" value="{{ is_null( $race ) ? '' : $race->race_name }}">
				</div>
				<p class="tip">Indiquez ici le nom de la race</p>
			</div>
			<div class="control-group all-33">
				<label for="characteristics">@lang( 'races.characteristics' )</label>
				<div class="control">
					<input type="text" name="characteristics" id="characteristics" value="{{ is_null( $race ) ? '' :  $race->characteristics  }}">
				</div>
				<p class="tip">Indiquez ici les caractéristiques de la race</p>
			</div>
			<div class="control-group all-33">
				<label for="geographical_origin">@lang( 'races.geographical_origin' )</label>
				<div class="control">
					<input type="text" name="geographical_origin" id="geographical_origin" value="{{ is_null( $race ) ? '' : $race->geographical_origin }}">
				</div>
				<p class="tip">Indiquez ici l'origine géographique</p>
			</div>
			<div class="control-group all-33">
				<label for="life_span">@lang( 'races.life_span' )</label>
				<div class="control">
					<input type="text" name="life_span"  id="life_span"  value="{{ is_null( $race ) ? '' : $race->life_span }}" >
				</div>
				<p class="tip">Indiquez ici la méthode de clippage</p>
			</div>

		</div>
		<button class="ink-button" id="valid">Valider</button>
{{ Form::close() }}
</div>
<script type="text/javascript">
	$( '#delete' ).on( 'click', function(){
		document.location.href="/race/delete/" + $( this ).attr( 'data-item-index' );
	} );

</script>
{{-- <script>
// $( '#valid' ).on( 'click', function(){
// 	var race = $( '#race' ).val();
// 	var birth_date = $( '#birth_date' ).val();
// 	var geographical_origin = $( '#geographical_origin' ).val();
// 	var clipping = $( '#clipping' ).val();
// 	var death_date = $( '#death_date' ).val();
// 	$.post( 'https://bee-mellifera.herokuapp.com/race',
// 		{
// 			"id": {{ $race->id }},
// 			"transaction":null,
// 			"unit":null,
// 			"race": { "id": {{ $race->race->id }},"characteristics":null,"geographical_origin": geographical_origin,"life_span":4,"race_name": race },
// 			"clipping": clipping
// 		} )
// 	.done( function( response ){
// 		console.log( 'response', response );
// 	} )
// 	.fail( function( error ){
// 		console.log( 'error', error );
// 	} );
// } );
			// "birth_date": birth_date,
			// "death_date": death_date,
</script> --}}
@stop