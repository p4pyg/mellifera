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

        {{-- <h5>@lang( 'swarms.global' )</h5> --}}
        <div class="input-field col l6 m6 s12">
            <select name="origin">
                <option value="" disabled selected ></option>
                @foreach( $units as $unit )
                <option value="{{ $unit->id }}">{{ $unit->id }}</option>
                @endforeach
            </select>
            <label>@lang( 'swarms.origin' )</label>
        </div>



        <div class="input-field col l6 m6 s12">
            <input type="text" name="purpose"  id="purpose" class="validate" value="{{ is_null( $swarm ) ? '' : $swarm->purpose }}" >
            <label for="purpose">@lang( 'swarms.purpose' )</label>
        </div>
        <div class="input-field col l6 m6 s12">
            <input type="text" class="datepicker picker__input" name="extermination" id="extermination" value="{{ is_null( $swarm ) || is_null( $swarm->extermination ) ? '' : date( 'd-m-Y', strtotime( $swarm->extermination ) ) }}">
            <label for="extermination">@lang( 'swarms.extermination' )</label>
        </div>

        <div class="input-field col l6 m6 s12">
            <textarea name="comment" id="comment" class="materialize-textarea" cols="30" rows="10">{{ is_null( $swarm ) ? '' : $swarm->comment }}</textarea>
            <label>@lang( 'swarms.comment' )</label>
        </div>

        <div class="input-field col l6 m6 s12">
            <fieldset>
                <legend>@lang( 'swarms.multiple' )</legend>
                <p>@lang( 'swarms.multi_info' )</p>
                <p class="range-field">
                    <input type="range" id="multiple" name="multiple" min="1" max="30" value="1" />
                </p>
            </fieldset>
        </div>
</div>
{{ Form::close() }}
@stop
