@extends('template')
@section('content')
<?php
if ( is_null( $person ) ) {
	$title 			= trans( 'persons.create_new_person' );
	$route 			= 'person/create';
}else{
	$title 			= trans( 'persons.edit_person' );
	$route 			= 'person/update';
}
?>
		<div class="row valign-wrapper">
			<div class="col l10 m10 s10">
				<h2>{{ $title }}&nbsp;</h2>
			</div>
			<div class="col l2 m2 s2 valign">
			@if( ! is_null( $person ) )
				@include( 'components.button_delete', [ 'item' => $person ] )
			@endif
			</div>
		</div>
{{	Form::open( [ 'url' => 'person/edit/' . ( is_null( $person ) ? '' :  $person->id ) , 'method' => 'POST', 'class' => 'col s12', 'id' => 'person_form' ] )	}}
		<div class="row">
			<div class="input-field col l6 m6 s12">
				<input type="text" name="name" id="name" class="validate" value="{{ is_null( $person ) ? '' : $person->name }}">
				<label for="name">@lang( 'persons.name' )</label>
			</div>
			<div class="input-field col l6 m6 s12">
				<input type="text" name="address1" id="address1" class="validate" value="{{ is_null( $person ) ? '' : $person->address1 }}">
				<label for="address1">@lang( 'persons.address1' )</label>
			</div>
			<div class="input-field col l6 m6 s12">
				<input type="text" name="address2" id="address2" class="validate" value="{{ is_null( $person ) ? '' : $person->address2 }}">
				<label for="address2">@lang( 'persons.address2' )</label>
			</div>
			<div class="input-field col l6 m6 s12">
				<input type="text" name="postcode" id="postcode" class="validate" value="{{ is_null( $person ) ? '' :  $person->postcode  }}">
				<label for="postcode">@lang( 'persons.postcode' )</label>
			</div>
			<div class="input-field col l6 m6 s12">
				<input type="text" name="city" id="city" class="validate" value="{{ is_null( $person ) ? '' :  $person->city  }}">
				<label for="city">@lang( 'persons.city' )</label>
			</div>
			<div class="input-field col l6 m6 s12">
				<input type="text" name="phone" id="phone" class="validate" value="{{ is_null( $person ) ? '' : $person->phone }}">
				<label for="phone">@lang( 'persons.phone' )</label>
			</div>
			<div class="input-field col l6 m6 s12">
				<input type="text" name="email" id="email" class="validate" value="{{ is_null( $person ) ? '' : $person->email }}">
				<label for="email">@lang( 'persons.email' )</label>
			</div>
			<div class="input-field col l6 m6 s12">
				<input type="text" name="user" id="user" class="validate" value="{{ is_null( $person ) ? '' : $person->user }}">
				<label for="user">@lang( 'persons.user' )</label>
			</div>
			<div class="input-field col l6 m6 s12">
				<input type="text" name="trades_with_sellers" id="trades_with_sellers" class="validate" value="{{ is_null( $person ) ? '' : $person->trades_with_sellers }}">
				<label for="trades_with_sellers">@lang( 'persons.trades_with_sellers' )</label>
			</div>
			<div class="input-field col l6 m6 s12">
				<input type="text" name="trades_with_buyers" id="trades_with_buyers" class="validate" value="{{ is_null( $person ) ? '' : $person->trades_with_buyers }}">
				<label for="trades_with_buyers">@lang( 'persons.trades_with_buyers' )</label>
			</div>
			
			
		@include( 'components.button_submit' )
		</div>

{{ Form::close() }}
@stop