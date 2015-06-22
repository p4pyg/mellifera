@extends('template')
@section('content')
<?php
if ( is_null( $characteristic ) ) {
    $title 			= trans( 'characteristics.create_new_characteristic' );
    $route 			= 'characteristic/create';
}else{
    $title 			= trans( 'characteristics.edit_characteristic' );
    $route 			= 'characteristic/update';
}
?>
{{	Form::open( [ 'url' => 'characteristic/edit/' . ( is_null( $characteristic ) ? '' :  $characteristic->id ) , 'method' => 'POST', 'class' => 'col s12', 'id' => 'form' ] )	}}
<div class="row valign-wrapper">
    <div class="col l8 m8 s8">
        <h2>{{ $title }}&nbsp;</h2>
    </div>
    <div class="col l2 m2 s2 valign">
        @include( 'components.button_back', [ 'item' => 'characteristics' ] )
    </div>
    <div class="col l2 m2 s2 valign">
        @include( 'components.button_submit' )
    </div>
    <div class="col l2 m2 s2 valign">
    @if( ! is_null( $characteristic ) )
        @include( 'components.button_delete', [ 'item' => $characteristic ] )
    @endif
    </div>
</div>
<div class="row">
    {{-- [unit] => --}}
    <div class="input-field col l6 m6 s12">
        <input type="text" class="datepicker" name="date" id="date" value="{{ is_null( $characteristic ) ? '' :  date( 'd-m-Y', strtotime( $characteristic->date ) ) }}">
        <label>@lang( 'characteristics.date' )</label>
    </div>
    <div class="input-field col l6 m6 s12">
        <h6>@lang( 'characteristics.aggressivness_level' )</h6>
        <p class="range-field">
            <input type="range" id="aggressivness_level" name="aggressivness_level" min="0" max="100" value="{{ is_null( $characteristic ) ? '' : $characteristic->aggressivness_level }}" />
        </p>
        <h6>@lang( 'characteristics.swarming_level' )</h6>
        <p class="range-field">
            <input type="range" id="swarming_level" name="swarming_level" min="0" max="100" value="{{ is_null( $characteristic ) ? '' : $characteristic->swarming_level }}" />
        </p>
        <h6>@lang( 'characteristics.winter_hardiness_level' )</h6>
        <p class="range-field">
            <input type="range" id="winter_hardiness_level" name="winter_hardiness_level" min="0" max="100" value="{{ is_null( $characteristic ) ? '' : $characteristic->winter_hardiness_level }}" />
        </p>
    </div>
    <div class="input-field col l6 m6 s12">
        <select name="wake_up_month">
            <option value="" disabled {{ is_null( $characteristic ) ? 'selected' : '' }}></option>
            @foreach( BeeTools::listMonth() as $key => $month )
            <option value="{{ $key }}" {{ is_null( $characteristic ) ? '' : ( $characteristic->wake_up_month == $key ? 'selected' : '' ) }}>{{ $month }}</option>
            @endforeach
        </select>
        <label>@lang( 'characteristics.wake_up_month' )</label>
    </div>
    <div class="input-field col l6 m6 s12">
        <textarea name="comment" id="comment" class="materialize-textarea" cols="30" rows="10">{{ is_null( $characteristic ) ? '' : $characteristic->comment }}</textarea>
        <label>@lang( 'characteristics.comment' )</label>
    </div>
</div>
{{ Form::close() }}
<script>
var names = {{ BeeTools::getArraylist( 'races', 'name' ) }};
</script>
@stop
