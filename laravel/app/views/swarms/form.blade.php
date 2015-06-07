@extends('template')
@section('content')
<?php
if ( is_null( $swarm ) ) {
    $title 			= trans( 'swarms.create_new_swarm' );
    $route 			= 'swarm/create';
}else{
    $title 			= trans( 'swarms.edit_swarm' );
    $route 			= 'swarm/update';
}
?>
{{	Form::open( [ 'url' => 'swarm/edit/' . ( is_null( $swarm ) ? '' :  $swarm->id ) , 'method' => 'POST', 'class' => 'col s12', 'id' => 'swarm_form' ] )	}}
<div class="row valign-wrapper">
    <div class="col l8 m8 s8">
        <h2>{{ $title }}&nbsp;</h2>
    </div>
    <div class="col l2 m2 s2 valign">
        @include( 'components.button_submit' )
    </div>
    <div class="col l2 m2 s2 valign">
        @include( 'components.button_back', [ 'item' => 'swarms' ]  )
    </div>
    <div class="col l2 m2 s2 valign">
    @if( ! is_null( $swarm ) )
        @include( 'components.button_delete', [ 'item' => $swarm ] )
    @endif
    </div>
</div>
<div class="row">
    <div class="col l6 m6 s12">
        <h5>@lang( 'swarms.global' )</h5>
        <div class="input-field col l12 m12 s12">
            <input type="text" name="race" id="race" class="validate" value="{{ is_null( $swarm ) ? '' : $swarm->race }}">
            <label for="race">@lang( 'swarms.race' )</label>
        </div>
        <div class="input-field col l12 m12 s12">
            <input type="text" name="creation" id="creation" class="validate" value="{{ is_null( $swarm ) ? '' : $swarm->creation }}">
            <label for="creation">@lang( 'swarms.creation' )</label>
        </div>
        <div class="input-field col l12 m12 s12">
            <input type="text" name="extermination"  id="extermination" class="validate" value="{{ is_null( $swarm ) ? '' : $swarm->extermination }}" >
            <label for="extermination">@lang( 'swarms.extermination' )</label>
        </div>
        <div class="input-field col l12 m12 s12">
            <input type="text" name="purpose"  id="purpose" class="validate" value="{{ is_null( $swarm ) ? '' : $swarm->purpose }}" >
            <label for="purpose">@lang( 'swarms.purpose' )</label>
        </div>
    </div>
</div>
{{ Form::close() }}
@stop
