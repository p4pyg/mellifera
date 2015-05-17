@extends('template')
@section('content')
@include( 'components.index_header' )
<table id="swarms" class="responsive-table hover hoverable striped bordered" data-page-size="5" data-pagination="#swarmsPagination" >
	<thead>
		<tr>
			<th class="center-align" data-sortable="true">@lang('swarms.id')</th>
			<th class="center-align" data-sortable="true">@lang('swarms.race')</th>
			<th class="center-align" data-sortable="true">@lang('swarms.creation')</th>
			<th class="center-align" data-sortable="true">@lang('swarms.extermination')</th>
			<th class="center-align" data-sortable="true">@lang('swarms.purpose')</th>
		</tr>
	</thead>
	<tbody>
	@foreach( $swarms as $swarm )
@if( is_int( $swarm ) )
	<p class="orange-text text-darken-4">Identifiant sec : <strong>{{ $swarm }}</strong></p>

@else
		<tr id="swarm-{{ $swarm->id }}" data-item-index="{{ $swarm->id }}">
			<td class="center-align">{{ $swarm->id }}</td>
			<td>{{ ucfirst( $swarm->race ) }}</td>
			<td class="center-align">{{ $swarm->creation }}</td>
			<td>{{ $swarm->extermination }}</td>
			<td>{{ $swarm->purpose }}</td>
			<td>{{ $swarm->label }}</td>

		</tr>
@endif
	@endforeach
	</tbody>
</table>
<ul class="pagination"  id="swarmsPagination"></ul>
@stop