@extends('template')
@section('content')
@include( 'components.index_header' )
<table id="units" class="responsive-table hover hoverable striped bordered" data-page-size="5" data-pagination="#unitsPagination" >
    <thead>
        <tr>
            <th class="center-align" data-sortable="true">@lang('units.id')</th>
            <th class="center-align" data-sortable="true">@lang('queens.queen')</th>
            <th class="center-align" data-sortable="true">@lang('swarms.swarm')</th>
            <th class="center-align" data-sortable="true">@lang('hives.hive')</th>
        </tr>
    </thead>
    <tbody>
    @foreach( $units as $unit )
@if( is_int( $unit ) )
    <p class="orange-text text-darken-4">Identifiant sec : <strong>{{ $unit }}</strong></p>

@else
        <tr id="unit-{{ $unit->id }}" data-item-index="{{ $unit->id }}">
            <td class="center-align">{{ $unit->id }}</td>
            <td>{{ $unit->queen->id }}</td>
            <td class="center-align">{{ $unit->swarm->id }}</td>
            <td>{{ $unit->beehive->id }}</td>
        </tr>
@endif
    @endforeach
    </tbody>
</table>
<ul class="pagination"  id="unitsPagination"></ul>
@stop
