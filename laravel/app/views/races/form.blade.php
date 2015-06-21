@extends('template')
@section('content')
<?php
if ( is_null( $race ) ) {
    $title 			= trans( 'races.create_new_race' );
    $route 			= 'race/create';
}else{
    $title 			= trans( 'races.edit_race' );
    $route 			= 'race/update';
}
?>
{{	Form::open( [ 'url' => 'race/edit/' . ( is_null( $race ) ? '' :  $race->id ) , 'method' => 'POST', 'class' => 'col s12', 'id' => 'race_form' ] )	}}
<div class="row valign-wrapper">
    <div class="col l8 m8 s8">
        <h2>{{ $title }}&nbsp;</h2>
    </div>
    <div class="col l2 m2 s2 valign">
        @include( 'components.button_submit' )
    </div>
    <div class="col l2 m2 s2 valign">
        @include( 'components.button_back', [ 'item' => 'races' ]  )
    </div>
    <div class="col l2 m2 s2 valign">
    @if( ! is_null( $race ) )
        @include( 'components.button_delete', [ 'item' => $race ] )
    @endif
    </div>
</div>
<div class="row">
    <div class="col l6 m6 s12">
        <h5>@lang( 'races.global' )</h5>
        <div class="input-field col l12 m12 s12">
            <input type="text" name="name" id="name" class="validate" value="{{ is_null( $race ) ? '' : $race->label }}">
            <label for="name">@lang( 'races.name' )</label>
        </div>
        <div class="input-field col l12 m12 s12">
            <input type="text" name="geographical_origin" id="geographical_origin" class="validate" value="{{ is_null( $race ) ? '' : $race->geographical_origin }}">
            <label for="geographical_origin">@lang( 'races.geographical_origin' )</label>
        </div>
        <div class="input-field col l12 m12 s12">
            <input type="text" name="life_span"  id="life_span" class="validate" value="{{ is_null( $race ) ? '' : $race->life_span }}" >
            <label for="life_span">@lang( 'races.life_span' )</label>
        </div>
        <div class="input-field col s12">
            <select name="characteristic_wake_up_month">
                <option value="" disabled {{ is_null( $race ) ? 'selected' : ( is_null( $characteristic ) ? 'selected' : '' ) }}></option>
                @foreach( BeeTools::listMonth() as $key => $month )
                <option value="{{ $key }}" {{ is_null( $race ) ? '' : ( is_null( $characteristic ) ? '' : ( $characteristic->wake_up_month == $key ? 'selected' : '' ) ) }}>{{ $month }}</option>
                @endforeach
            </select>
            <label>@lang( 'characteristics.wake_up_month' )</label>
        </div>
        <div class="input-field col l12 m12 s12">
            <textarea name="characteristic_comment" id="characteristic_comment" class="materialize-textarea" cols="30" rows="10">{{ is_null( $race ) ? '' : ( is_null( $characteristic ) ? '' : $characteristic->comment ) }}</textarea>
            <label>@lang( 'characteristics.comment' )</label>
        </div>
    </div>
    <div class="col l6 m6 s12">
        <h5>@lang( 'characteristics.characteristics' )</h5>
        <input type="hidden" name="characteristic_id" value="{{ is_null( $race ) ? '' : ( is_null( $characteristic ) ? '' : $characteristic->id ) }}">
        {{-- [characteristic_unit] => --}}
        <div class="input-field col l12 m12 s12">
            <input type="text" class="datepicker" name="characteristic_date" id="characteristic_date" value="{{ is_null( $race ) ? '' : ( is_null( $characteristic ) ? '' : date( 'd-m-Y', strtotime( $characteristic->date ) ) ) }}">
            <label>@lang( 'characteristics.date' )</label>
        </div>
        <div class="input-field col l12 m12 s12">
            <input type="text" name="characteristic_racial_type" id="characteristic_racial_type" value="{{ is_null( $race ) ? '' : ( is_null( $characteristic ) ? '' : $characteristic->racial_type ) }}" >
            <label>@lang( 'characteristics.racial_type' )</label>
        </div>
        <div class="input-field col l12 m12 s12">
            <h6>@lang( 'characteristics.aggressivness_level' )</h6>
            <p class="range-field">
                <input type="range" id="characteristic_aggressivness_level" name="characteristic_aggressivness_level" min="0" max="100" value="{{ is_null( $race ) ? '' : ( is_null( $characteristic ) ? '' : $characteristic->aggressivness_level ) }}" />
            </p>
            <h6>@lang( 'characteristics.swarming_level' )</h6>
            <p class="range-field">
                <input type="range" id="characteristic_swarming_level" name="characteristic_swarming_level" min="0" max="100" value="{{ is_null( $race ) ? '' : ( is_null( $characteristic ) ? '' : $characteristic->swarming_level ) }}" />
            </p>
            <h6>@lang( 'characteristics.winter_hardiness_level' )</h6>
            <p class="range-field">
                <input type="range" id="characteristic_winter_hardiness_level" name="characteristic_winter_hardiness_level" min="0" max="100" value="{{ is_null( $race ) ? '' : ( is_null( $characteristic ) ? '' : $characteristic->winter_hardiness_level ) }}" />
            </p>
        </div>
    </div>
</div>
{{ Form::close() }}
<script>
var names = {{ BeeTools::getArraylist( 'races', 'name' ) }};
</script>
@stop
