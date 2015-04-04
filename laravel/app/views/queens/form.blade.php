@extends('template')
@section('content')
<?php
if ( is_null( $queen ) ) {
	$title 			= trans( 'queens.create_new_queen' );
	$route 			= 'queen/create';
	$markup_delete 	= '';
}else{
	$title 			= trans( 'queens.edit_queen' );
	$route 			= 'queen/edit';
	$markup_delete 	= '<button><span class="fa fa-trash fa-lg"></span></button>';
}
?>
<div class="all-100">
	<h1>{{ $title }}</h1>
	<button class="ink-button" id="delete">Delete</button>
{{	Form::open( [ 'url' => 'queen/edit/' . $queen->id, 'method' => 'POST', 'class' => 'ink-form', 'id' => 'queen_form' ] )	}}

		<div class="column-group gutters">
			<div class="control-group all-33">
				<label for="race">@lang( 'queens.race' )</label>
				<div class="control">
					<input type="text" name="race" id="race" placeholder="@lang( 'queens.race' )" value="{{ is_null( $queen ) ? '' : $queen->race->race_name }}">
				</div>
				<p class="tip">Indiquez ici le nom de la race</p>
			</div>
			<div class="control-group all-33">
				<label for="birth_date">@lang( 'queens.birth_date' )</label>
				<div class="control">
					<input type="text" name="birth_date" id="birth_date" value="{{ is_null( $queen ) ? '' : date( 'd/m/Y', strtotime( $queen->birth_date ) ) }}">
				</div>
				<p class="tip">Indiquez ici la date de naissance</p>
			</div>
			<div class="control-group all-33">
				<label for="geographical_origin">@lang( 'queens.geographical_origin' )</label>
				<div class="control">
					<input type="text" name="geographical_origin" id="geographical_origin" value="{{ is_null( $queen ) ? '' : $queen->race->geographical_origin }}">
				</div>
				<p class="tip">Indiquez ici l'origine géographique</p>
			</div>
			<div class="control-group all-33">
				<label for="clipping">@lang( 'queens.clipping' )</label>
				<ul class="control unstyled">
					<li><input type="radio" id="clipping_1" name="clipping" value="0" {{ $queen->clipping == 0 ? 'checked' : '' }}><label for="clipping_1">@lang( 'queens.clip.0' )</label></li>
					<li><input type="radio" id="clipping_2" name="clipping" value="1" {{ $queen->clipping == 1 ? 'checked' : '' }}><label for="clipping_2">@lang( 'queens.clip.1' )</label></li>
					<li><input type="radio" id="clipping_3" name="clipping" value="2" {{ $queen->clipping == 2 ? 'checked' : '' }}><label for="clipping_3">@lang( 'queens.clip.2' )</label></li>
				</ul>
				<p class="tip">Indiquez ici la méthode de clippage</p>
			</div>
{{-- 		<div class="control-group all-33">
				<label for="current_swarm">@lang( 'queens.current_swarm' )</label>
				<div class="control">
					<input type="text" name="current_swarm" id="current_swarm" value="{{ is_null( $queen ) ? '' : $queen->current_swarm }}">
				</div>
				<p class="tip">You can add tips to fields</p>
			</div> --}}
			<div class="control-group all-33">
				<label for="death_date">@lang( 'queens.die_date' )</label>
				<div class="control">
					<input type="text" name="death_date" id="death_date" value="{{ is_null( $queen ) ? '' : $queen->death_date }}">
				</div>
				<p class="tip">Indiquez ici la date de décés</p>
			</div>
{{-- 			<div class="control-group all-33">
				<label for="thumbnail">@lang( 'queens.thumbnail' )</label>
				<div class="control">
					<input type="text" name="thumbnail" id="thumbnail" value="{{ is_null( $queen ) ? '' : $queen->thumbnail }}">
				</div>
				<p class="tip">You can add tips to fields</p>
			</div>
			<div class="control-group all-33">
				<label for="thumbname">@lang( 'queens.thumbname' )</label>
				<div class="control">
					<input type="text" name="thumbname" id="thumbname" value="{{ is_null( $queen ) ? '' : $queen->thumbname }}">
				</div>
				<p class="tip">You can add tips to fields</p>
			</div> --}}
		</div>
		<button class="ink-button" id="valid">Valider</button>
{{ Form::close() }}
</div>
<script>
// $( '#valid' ).on( 'click', function(){
// 	var race = $( '#race' ).val();
// 	var birth_date = $( '#birth_date' ).val();
// 	var geographical_origin = $( '#geographical_origin' ).val();
// 	var clipping = $( '#clipping' ).val();
// 	var death_date = $( '#death_date' ).val();
// 	$.post( 'https://bee-mellifera.herokuapp.com/Queen',
// 		{
// 			"id": {{ $queen->id }},
// 			"transaction":null,
// 			"unit":null,
// 			"race": { "id": {{ $queen->race->id }},"characteristics":null,"geographical_origin": geographical_origin,"life_span":4,"race_name": race },
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
</script>
@stop