@extends('template')
@section('content')
@include( 'components.index_header' )
<table id="hives" class="responsive-table hover hoverable striped bordered" data-page-size="5" data-pagination="#hivesPagination" >
	<thead>
		<tr>
			<th class="align-left" data-sortable="true">@lang('hives.id')</th>
			<th data-sortable="true">@lang('hives.id_lot')</th>
			<th class="align-center" data-sortable="true">@lang('hives.beehive_type')</th>
			<th data-sortable="true">@lang('hives.number_of_frames')</th>
			<th data-sortable="true">@lang('hives.number_of_rocks')</th>
			<th data-sortable="true">@lang('hives.comment')</th>

		</tr>
	</thead>
	<tbody>
	@foreach( $hives as $hive )
		<tr id="hive-{{ $hive->id }}" data-item-index="{{ $hive->id }}">
			<td>{{ $hive->id }}</td>
			<td>{{ $hive->id_lot }}</td>
			<td>{{ $hive->beehive_type }}</td>
			<td>{{ $hive->number_of_frames }}</td>
			<td>{{ $hive->number_of_rocks }}</td>
			<td>{{ $hive->comment }}</td>
		</tr>
	@endforeach
	</tbody>
</table>
<ul class="pagination" id="hivesPagination"></ul>
@stop