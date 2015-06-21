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
{{	Form::open( [ 'url' => 'hive/edit/' . ( is_null( $hive ) ? '' :  $hive->id ) , 'method' => 'POST', 'class' => 'col s12', 'id' => 'hive_form' ] )	}}
<div class="row valign-wrapper">
    <div class="col l8 m8 s8">
        <h2>{{ $title }}&nbsp;</h2>
    </div>
    <div class="col l2 m2 s2 valign">
        @include( 'components.button_submit' )
    </div>
        <div class="col l2 m2 s2 valign">
        @include( 'components.button_back', [ 'item' => 'hives' ] )
    </div>
    <div class="col l2 m2 s2 valign">
    @if( ! is_null( $hive ) )
        @include( 'components.button_delete', [ 'item' => $hive ] )
    @endif
    </div>
</div>
<div class="row">
    <div class="input-field col l6 m6 s12">
        <input type="text" name="code_number" id="code_number" class="validate" value="{{ is_null( $hive ) ? '' :  $hive->code_number  }}">
        <label for="code_number">@lang( 'hives.code_number' )</label>
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
        <input type="text" name="type" id="type" value="{{ ( is_null( $hive ) || is_null( $hive->type ) ) ? '' : $hive->type->name }}">
        <label for="type">@lang( 'hives.type' )</label>
    </div>
</div>
{{ Form::close() }}
<script>
var types = {{ BeeTools::getArraylist( 'beehives', 'type' ) }};
</script>
@stop
