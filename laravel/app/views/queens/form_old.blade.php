@extends('template')
@section('content')
<?php
if ( is_null( $queen ) ) {
	$title 			= trans( 'queens.create_new_queen' );
	$route 			= 'queen/create';
	$markup_delete 	= '';
}else{
	$title 			= trans( 'queens.edit_queen' );
	$route 			= 'queen/update';
	$markup_delete 	= '<button><span class="fa fa-trash fa-lg"></span></button>';
}
?>
<div class="all-100">
	<h1>{{ $title }}</h1>
	<button class="ink-button" id="delete">Delete</button>
{{	Form::open( [ 'url' => 'queen/edit/' . ( is_null( $queen ) ? '' : $queen->id ), 'method' => 'POST', 'class' => 'ink-form', 'id' => 'queen_form' ] )	}}

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
					<li><input type="radio" id="clipping_1" name="clipping" value="false" {{ is_null( $queen ) ? '' : $queen->clipping == false ? 'checked' : '' }}><label for="clipping_1">@lang( 'queens.clip.false' )</label></li>
					<li><input type="radio" id="clipping_2" name="clipping" value="true" {{ is_null( $queen ) ? '' : $queen->clipping == true ? 'checked' : '' }}><label for="clipping_2">@lang( 'queens.clip.true' )</label></li>
				</ul>
				<p class="tip">Indiquez ici la méthode de clippage</p>
			</div>

			<div class="control-group all-33">
				<label for="death_date">@lang( 'queens.die_date' )</label>
				<div class="control">
					<input type="text" name="death_date" id="death_date" value="{{ is_null( $queen ) ? '' : $queen->death_date }}">
				</div>
				<p class="tip">Indiquez ici la date de décés</p>
			</div>
		</div>
		<button class="ink-button" id="valid">Valider</button>
{{ Form::close() }}
</div>
@stop