@extends('template')
@section('content')
<?php
if ( is_null( $hive ) ) {
	$title 			= trans( 'hives.create_new_hive' );
	$route 			= 'hive/create';
}else{
	$title 			= trans( 'hives.edit_hive' );
	$route 			= 'hive/update';
}
?>
		<div class="row valign-wrapper">
			<div class="col l10 m10 s10">
				<h2>{{ $title }}&nbsp;</h2>
			</div>
			<div class="col l2 m2 s2 valign">
			@if( ! is_null( $hive ) )
				@include( 'components.button_delete', [ 'item' => $hive ] )
			@endif
			</div>
		</div>
{{	Form::open( [ 'url' => 'hive/edit/' . ( is_null( $hive ) ? '' :  $hive->id ) , 'method' => 'POST', 'class' => 'col s12', 'id' => 'hive_form' ] )	}}
		<div class="row">
			<div class="input-field col l6 m6 s12">
				<input type="text" name="code_number" id="code_number" class="validate" value="{{ is_null( $hive ) ? '' :  $hive->code_number  }}">
				<label for="code_number">@lang( 'hives.code_number' )</label>
			</div>
			<div class="input-field col l6 m6 s12">
				<input type="text" name="id_lot" id="id_lot" class="validate" value="{{ is_null( $hive ) ? '' : $hive->id_lot }}">
				<label for="id_lot">@lang( 'hives.id_lot' )</label>
			</div>
			<div class="input-field col l6 m6 s12">
				<p>
					<label for="number_of_frames">@lang( 'hives.number_of_frames' )</label>
				</p>
				<br />
				<p class="range-field">
					<input type="range" name="number_of_frames"  id="number_of_frames" class="validate" min="0" max="10" value="{{ is_null( $hive ) ? '' : $hive->number_of_frames }}"/>
				<p class="range-field">
			</div>
			<div class="input-field col l6 m6 s12">
				<select name="beehive_type" id="beehive_type">
					<option value="" disabled {{ is_null( $hive ) ? 'selected' : ( is_null( $hive->beehive_type ) ? 'selected' : '' ) }}></option>
					@foreach( Hive::get_types() as $type )
					<option value="{{ $type }}"  {{ is_null( $hive ) ? '' : ( is_null( $hive->beehive_type ) ? '' : 'selected'  ) }}>{{ $type }}</option>
					@endforeach
				</select>
				<label for="beehive_type">@lang( 'hives.beehive_type' )</label>
			</div>
{{-- 			<div class="input-field col l6 m6 s12">
				<input type="text" name="number_of_rocks" id="number_of_rocks" class="validate" value="{{ is_null( $hive ) ? '' :  $hive->number_of_rocks  }}">
				<label for="number_of_rocks">@lang( 'hives.number_of_rocks' )</label>
			</div> --}}
			<div class="input-field col l12 m12 s12">
				@include( 'components.button_submit' )
			</div>
		</div>

{{ Form::close() }}
@stop