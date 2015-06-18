@extends('template')
@section('content')
@include( 'components.index_header' )
<table id="hives" class="responsive-table hover hoverable striped bordered" data-page-size="10" data-pagination="#hivesPagination" >
    <thead>
        <tr>
            <th data-sortable="true">@lang( 'hives.code_number' )</th>
            <th>@lang( 'hives.alert' )</th>
            <th data-sortable="true">@lang( 'apiaries.apiary' )</th>
            <th data-sortable="true">@lang( 'hives.type' )</th>
            <th data-sortable="true">@lang( 'hives.number_of_frames' )</th>
            <th>@lang( 'hives.barcode' )</th>
        </tr>
    </thead>
    <tbody>
    @foreach( $hives as $hive )
        <tr id="hive-{{ $hive->id }}" data-item-index="{{ $hive->id }}">
            <td>{{ $hive->code_number }}</td>
            <td class="center">{{ Hive::colorizeAlert( is_null( $hive->number_of_rocks ) ? 0 : $hive->number_of_rocks ) }}</td>
            <td class="center"><a class="modal-trigger waves-effect waves-light btn-flat darken-4 z-depth-1 text-orange " id="trans-{{ $hive->id }}" href="#apiary_change">{{ ( isset( $hive->apiary ) && ! is_null( $hive->apiary) ) ? $hive->apiary : trans('hives.free')  }}</a></td>
            <td>{{ ! is_null( $hive->type ) ? $hive->type->name : null }}</td>
            <td class="center">{{ $hive->number_of_frames }}</td>
            <td class="center">{{ DNS2D::getBarcodeSVG( '{ "id":' . $hive->id . ', "code_number":' . $hive->code_number . ' }', "QRCODE",2,2,"#E65100") }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<ul class="pagination"  id="hivesPagination"></ul>
<div id="apiary_change" class="modal">
    {{  Form::open( [ 'url' => 'hive/transhumance', 'method' => 'POST', 'class' => 'col s12', 'id' => 'transhumance_form' ] )  }}
        <input id="hive_id" type="hidden" name="hive" value="">
        <div class="modal-content">
            <div class="row">
                <div class="col l10 m10 s10">
                    <h4>Transhumance</h4>
                </div>
                <div class="col l2 m2 s2">
                    @include('components.button_close')
                </div>
            </div>
            <p>Vers quel rucher voulez-vous transférer cette ruche ?</p>
            <fieldset>
                <legend>Liste des ruchers disponibles</legend>
                <div class="input-field col l12 m12 s12">
                    <select name="apiary" id="apiary">
                        <option value="" disabled selected ></option>
                        @foreach($apiaries as $apiary)
                        <option value="{{$apiary->id}}">{{$apiary->name}}</option>
                        @endforeach
                    </select>
                </div>
            </fieldset>
        </div>
        <div class="modal-footer row">
            <div class="offset-l10 col l2 m2 s2">
                @include('components.button_submit')
            </div>
        </div>
    {{ Form::close() }}
  </div>

@stop
