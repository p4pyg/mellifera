@extends('template')
@section('content')
<?php
if ( is_null( $treatment ) ) {
	$title 			= trans( 'treatments.create_new_treatment' );
	$route 			= 'treatment/create';
}else{
	$title 			= trans( 'treatments.edit_treatment' );
	$route 			= 'treatment/update';
}
?>
{{	Form::open( [ 'url' => 'treatment/edit/' . ( is_null( $treatment ) ? '' :  $treatment->id ) , 'method' => 'POST', 'class' => 'col s12', 'id' => 'treatment_form' ] )	}}
<div class="row valign-wrapper">
	<div class="col l8 m8 s8">
		<h2>{{ $title }}&nbsp;</h2>
	</div>
	<div class="col l2 m2 s2 valign">
		@include( 'components.button_submit' )
	</div>
	<div class="col l2 m2 s2 valign">
		@include( 'components.button_back', [ 'item' => 'treatment' ]  )
	</div>
	<div class="col l2 m2 s2 valign">
	@if( ! is_null( $treatment ) )
		@include( 'components.button_delete', [ 'item' => $treatment ] )
	@endif
	</div>
</div>
<div class="row">
	<div class="col l6 m6 s12">
		<div class="input-field col l12 m12 s12">
			<input type="text" name="treatment_name" id="treatment_name" class="validate" value="{{ is_null( $treatment ) ? '' : $treatment->treatment_name }}">
			<label for="treatment_name">@lang( 'treatments.treatment_name' )</label>
		</div>
		<div class="input-field col l12 m12 s12">
			<input type="text" name="treatment_date" id="treatment_date" class="validate" value="{{ is_null( $treatment ) ? '' : $treatment->treatment_date }}">
			<label for="treatment_date">@lang( 'treatments.treatment_date' )</label>
		</div>
		<div class="input-field col l12 m12 s12">
			<input type="text" name="desease_treated" id="desease_treated" class="validate" value="{{ is_null( $treatment ) ? '' : $treatment->desease_treated }}">
			<label for="desease_treated">@lang( 'treatments.desease_treated' )</label>
		</div>
		<div class="input-field col l12 m12 s12">
			<input type="text" name="product_quantity" id="product_quantity" class="validate" value="{{ is_null( $treatment ) ? '' : $treatment->product_quantity }}">
			<label for="product_quantity">@lang( 'treatments.product_quantity' )</label>
		</div>
	</div>
</div>
{{ Form::close() }}
@stop