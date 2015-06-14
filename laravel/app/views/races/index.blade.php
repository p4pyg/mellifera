@extends('template')
@section('content')
@include( 'components.index_header' )
<table id="races" class="responsive-table hover hoverable striped bordered" data-page-size="5" data-pagination="#racesPagination" >
    <thead>
        <tr>
            <th class="center-align" data-sortable="true">@lang('races.id')</th>
            <th class="center-align" data-sortable="true">@lang('races.name')</th>
            <th class="center-align" data-sortable="true">@lang('races.life_span')</th>
            <th class="center-align" data-sortable="true">@lang('races.geographical_origin')</th>
        </tr>
    </thead>
    <tbody>
    @foreach( $races as $race )
@if( is_int( $race ) )
    <p class="orange-text text-darken-4">Identifiant sec : <strong>{{ $race }}</strong></p>

@else
        <tr id="race-{{ $race->id }}" data-item-index="{{ $race->id }}">
            <td class="center-align">{{ $race->id }}</td>
            <td>{{ ucfirst( $race->label ) }}</td>
            <td class="center-align">{{ $race->life_span }}</td>
            <td>{{ $race->geographical_origin }}</td>
        </tr>
@endif
    @endforeach
    </tbody>
</table>
<ul class="pagination"  id="racesPagination"></ul>
@stop
