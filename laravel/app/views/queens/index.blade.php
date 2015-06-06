@extends('template')
@section('content')
@include( 'components.index_header' )
<table id="queens" class="responsive-table hover hoverable striped bordered" data-page-size="5" data-pagination="#queensPagination" >
	<thead>
		<tr>
			<th class="align-left" data-sortable="true">@lang('queens.id')</th>
			<th data-sortable="true">@lang('queens.race')</th>
			<th class="align-center" data-sortable="true">@lang('queens.age')</th>
			<th data-sortable="true">@lang('queens.origin')</th>
			<th data-sortable="true">@lang('queens.clipping')</th>
			<th data-sortable="true">@lang('queens.is_in')</th>
			<th data-sortable="true">@lang('queens.death_date')</th>
		</tr>
	</thead>
	<tbody>
	@foreach( $queens as $queen )
		<tr id="queen-{{ $queen->id }}" data-item-index="{{ $queen->id }}">
			<td>{{ $queen->id }}</td>
			<td>{{ $queen->race }}</td>
			<td>{{ date( 'Y', time() ) - date( 'Y' , strtotime( $queen->birth_date ) ) }}</td>
			<td>{{ $queen->origin }}</td>
			<td>{{ $queen->clipping }}</td>
			<td>{{ empty ($queen->is_in ) ? "N.A" : "is_in" }}</td>
			<td>{{ is_null( $queen->death_date ) ? '-' : date( 'd/m/Y', strtotime( $queen->death_date ) ) }}</td>
		</tr>
	@endforeach
	</tbody>
</table>
<ul class="pagination"  id="queensPagination"></ul>
@stop
