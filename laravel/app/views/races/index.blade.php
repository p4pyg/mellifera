@extends('template')
@section('content')
@include( 'components.index_header' )
<table id="races" class="responsive-table hover hoverable striped bordered" data-page-size="5" data-pagination="#racesPagination" >
	<thead>
		<tr>
			<th class="align-left" data-sortable="true">@lang('races.id')</th>
			<th data-sortable="true">@lang('races.race_name')</th>
			<th class="align-center" data-sortable="true">@lang('races.life_span')</th>
			<th data-sortable="true">@lang('races.geographical_origin')</th>
			<th data-sortable="true">@lang('races.characteristics')</th>
		</tr>
	</thead>
	<tbody>
	@foreach( $races as $race )
		<tr id="race-{{ $race->id }}" data-item-index="{{ $race->id }}">
			<td>{{ $race->id }}</td>
			<td>{{ ucfirst( $race->race_name ) }}</td>
			<td>{{ $race->life_span }}</td>
			<td>{{ $race->geographical_origin }}</td>
			<td>{{ $race->characteristics }}</td>
		</tr>
	@endforeach
	</tbody>
</table>
<ul class="pagination"  id="racesPagination"></ul>
@stop