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
{{	Form::open( [ 'url' => 'person/edit/' . ( is_null( $person ) ? '' :  $person->id ) , 'method' => 'POST', 'class' => 'col s12', 'id' => 'person_form' ] )	}}
<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
<div class="row valign-wrapper">
    <div class="col l8 m8 s8">
        <h2>{{ $title }}&nbsp;</h2>
    </div>
    <div class="col l2 m2 s2 valign">
        @include( 'components.button_back', [ 'item' => 'backoffice' ] )
    </div>
    <div class="col l2 m2 s2 valign">
        @include( 'components.button_submit' )
    </div>
    <div class="col l2 m2 s2 valign">
    @if( ! is_null( $person ) )
        @include( 'components.button_delete', [ 'item' => $person ] )
    @endif
    </div>
</div>
<fieldset>
    <legend>@lang( 'persons.ident_info' )</legend>
    <div class="row">
            <div class="input-field col l12 m12 s12">
                <input type="text" id="email" class="validate" name="email" value="{{ Auth::user()->email }}" />
                <label for="email">@lang( 'users.need_email')</label>
            </div>
            <div class="input-field col l12 m12 s12">
                <input type="password" id="password" class="validate" name="password" value="" />
                <label for="password">@lang( 'users.need_password' ) </label>
            </div>
            <div class="input-field col l12 m12 s12">
                <input type="password" id="password_confirmation" class="validate" name="password_confirmation" value="" />
                <label for="password_confirmation">@lang( 'users.need_password_confirmation' ) </label>
            </div>
    </div>
</fieldset>
<fieldset>
    <legend>@lang( 'persons.optionnal_info' )</legend>
    <div class="row">
        <div class="input-field col l6 m6 s12">
            <input type="text" name="first_name" id="first_name" class="validate" value="{{ is_null( $person ) ? '' : $person->first_name }}">
            <label for="first_name">@lang( 'persons.first_name' )</label>
        </div>
        <div class="input-field col l6 m6 s12">
            <input type="text" name="last_name" id="last_name" class="validate" value="{{ is_null( $person ) ? '' : $person->last_name }}">
            <label for="last_name">@lang( 'persons.last_name' )</label>
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
    </div>
</fieldset>
{{ Form::close() }}
@stop
