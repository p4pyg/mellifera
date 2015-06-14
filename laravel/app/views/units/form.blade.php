@extends('template')
@section('content')
<?php
if ( is_null( $unit ) ) {
    $title          = trans( 'units.create_new_unit' );
    $route          = 'unit/create';
}else{
    $title          = trans( 'units.edit_unit' );
    $route          = 'unit/update';
}
?>
{{  Form::open( [ 'url' => 'unit/edit/' . ( is_null( $unit ) ? '' :  $unit->id ) , 'method' => 'POST', 'class' => 'col s12', 'id' => 'unit_form' ] )    }}
<input type="hidden" name="apiary_id" value="{{ is_null( $apiary_id ) ? '' : $apiary_id }}">
<div class="row valign-wrapper">
    <div class="col l10 m10 s10">
        <h2>{{ $title }}&nbsp;</h2>
    </div>
    <div class="col l2 m2 s2 valign">
        @include( 'components.button_submit' )
    </div>
    <div class="col l2 m2 s2 valign">
    @if( ! is_null( $unit ) )
        @include( 'components.button_delete', [ 'item' => $unit ] )
    @endif
    </div>
</div>
<div class="row">
    <div class="col l4 m4 s4">
    <label>@lang( 'queens.queen' )</label>
        <select name="queen">
            <option value="" disabled selected ></option>
            @foreach( $queens as $queen )
            <option {{ ! is_null( $unit ) && $queen->id == $unit->queen->id ? 'selected' : '' }} value="{{ $queen->id }}">{{ $queen->id }}</option>
            @endforeach
        </select>
    </div>
    <div class="col l4 m4 s4">
    <label>@lang( 'swarms.swarm' )</label>
        <select name="swarm">
            <option value="" disabled selected ></option>
            @foreach( $swarms as $swarm )
            <option {{ ! is_null( $unit ) && $swarm->id == $unit->swarm->id ? 'selected' : '' }} value="{{ $swarm->id }}">{{ $swarm->id }}</option>
            @endforeach
        </select>
    </div>
    <div class="col l4 m4 s4">
    <label>@lang( 'hives.hive' )</label>
        <select name="beehive">
            <option value="" disabled selected ></option>
            @foreach( $hives as $hive )
            <option {{ ! is_null( $unit ) && $hive->id == $unit->beehive->id ? 'selected' : '' }} value="{{ $hive->id }}">{{ $hive->code_number }}</option>
            @endforeach
        </select>
    </div>
</div>
{{ Form::close() }}
@stop
