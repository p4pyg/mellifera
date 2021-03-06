@extends('template')
@section('content')
<?php
if ( is_null( $queen ) ) {
        $title = trans( 'queens.create_new_queen' );
        $route = 'queen/create';
}else{
        $title = trans( 'queens.edit_queen' );
        $route = 'queen/update';
}
?>
{{  Form::open( [ 'url' => 'queen/edit/' . ( is_null( $queen ) ? '' : $queen->id ), 'method' => 'POST', 'class' => 'col s12', 'id' => 'queen_form' ] )  }}
<div class="row valign-wrapper">
    <div class="col l8 m8 s8">
            <h2>{{ $title }}&nbsp;</h2>
    </div>
    <div class="col l2 m2 s2 valign">
        @include( 'components.button_back', [ 'item' => 'queens'] )
    </div>
    <div class="col l2 m2 s2 valign">
        @include( 'components.button_submit' )
    </div>
    <div class="col l2 m2 s2 valign">
    @if( ! is_null( $queen ) )
        @include( 'components.button_delete', [ 'item' => $queen ] )
    @endif
    </div>
</div>
<div class="row">
    <div class="input-field col l6 m6 s12">
        <input type="text" class="datepicker picker__input" name="birth_date" id="birth_date" value="{{ is_null( $queen ) || is_null( $queen->birth_date ) ? '' : date( 'd-m-Y', strtotime( $queen->birth_date ) ) }}">
        <label for="birth_date">@lang( 'queens.birth_date' )</label>
    </div>
    <div class="input-field col l6 m6 s12">
        <input type="text" class="datepicker picker__input" name="death_date" id="death_date" value="{{ is_null( $queen ) || is_null( $queen->death_date ) ? '' : date( 'd-m-Y', strtotime( $queen->death_date ) ) }}">
        <label for="death_date">@lang( 'queens.death_date' )</label>
    </div>
    <div class="col l6 m6 s12">
        <h6>@lang( 'queens.clipping' )</h6>
        <div class="switch">
            <label>
                Non
                <input type="checkbox" name="clipping" {{ is_null( $queen ) ? '' : ( $queen->clipping ? 'checked' : '' ) }} value="true" >
                <span class="lever"></span>
                Oui
            </label>
        </div>
    </div>
    <div class="input-field col l6 m6 s12">
        <select name="race">
            <option value="" disabled selected ></option>
            @foreach( $races as $race )
            <option value="{{ $race->id }}">{{ $race->label }}</option>
            @endforeach
        </select>
    <label>@lang( 'queens.race' )</label>
    </div>
</div>
{{ Form::close() }}
@stop
