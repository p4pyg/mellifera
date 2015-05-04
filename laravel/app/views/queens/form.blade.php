@extends('template')
@section('content')
<?php
if ( is_null( $queen ) ) {
	$title 			= trans( 'queens.create_new_queen' );
	$route 			= 'queen/create';
}else{
	$title 			= trans( 'queens.edit_queen' );
	$route 			= 'queen/update';
}
?>
		<div class="row valign-wrapper">
			<div class="col l10 m10 s10">
				<h2>{{ $title }}&nbsp;</h2>
			</div>
			<div class="col l2 m2 s2 valign">
			@if( ! is_null( $queen ) )
				@include( 'components.button_delete', [ 'item' => $queen ] )
			@endif
			</div>
		</div>
{{	Form::open( [ 'url' => 'queen/edit/' . ( is_null( $queen ) ? '' :  $queen->id ) , 'method' => 'POST', 'class' => 'col s12', 'id' => 'queen_form' ] )	}}
		<div class="row">
			<div class="input-field col l6 m6 s12">
				<input type="text" name="race" id="race" class="validate" value="{{ is_null( $queen ) ? '' : $queen->race }}">
				<label for="race">@lang( 'queens.race' )</label>
			</div>
			<div class="input-field col l6 m6 s12">
				<input type="text" name="origin" id="origin" class="validate" value="{{ is_null( $queen ) ? '' :  $queen->origin  }}">
				<label for="origin">@lang( 'queens.origin' )</label>
			</div>
			<div class="input-field col l6 m6 s12">
				<input type="text" name="birth_date" id="birth_date" class="validate" value="{{ is_null( $queen ) ? '' : $queen->birth_date }}">
				<label for="birth_date">@lang( 'queens.birth_date' )</label>
			</div>
			<div class="input-field col l6 m6 s12">
				<input type="text" name="death_date" id="death_date" class="validate" value="{{ is_null( $queen ) ? '' : $queen->death_date }}">
				<label for="death_date">@lang( 'queens.death_date' )</label>
			</div>
			<div class="input-field col l6 m6 s12">
				<label for="clipping">@lang( 'queens.clipping' )</label>
				<ul class="control unstyled">
					<li><input type="radio" id="clipping_1" name="clipping" value="false" {{ is_null( $queen ) ? '' : $queen->clipping == false ? 'checked' : '' }}><label for="clipping_1">@lang( 'queens.false' )</label></li>
					<li><input type="radio" id="clipping_2" name="clipping" value="true" {{ is_null( $queen ) ? '' : $queen->clipping == true ? 'checked' : '' }}><label for="clipping_2">@lang( 'queens.true' )</label></li>
				</ul>
				<p class="tip">Clippage</p>
			</div>
		@include( 'components.button_submit' )
		</div>

{{ Form::close() }}
@stop