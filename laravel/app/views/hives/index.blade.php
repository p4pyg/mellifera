@extends('template')
@section('content')
@include( 'components.index_header' )
<table id="hives" class="responsive-table hover hoverable striped bordered" data-page-size="5" data-pagination="#hivesPagination" >
	<thead>
		<tr>
<<<<<<< HEAD
			<th class="center-align" data-sortable="true">@lang('hives.id')</th>
			<th class="center-align" data-sortable="true">@lang('hives.id_lot')</th>
			<th class="center-align" data-sortable="true">@lang('hives.beehive_type')</th>
			<th class="center-align" data-sortable="true">@lang('hives.number_of_frames')</th>
			<th class="center-align" data-sortable="true">@lang('hives.number_of_rocks')</th>
=======
			<th class="align-left" data-sortable="true">@lang('hives.id')</th>
			<th data-sortable="true">@lang('hives.id_lot')</th>
			<th class="align-center" data-sortable="true">@lang('hives.beehive_type')</th>
			<th data-sortable="true">@lang('hives.number_of_frames')</th>
			<th data-sortable="true">@lang('hives.number_of_rocks')</th>
			<th data-sortable="true">@lang('hives.comment')</th>

>>>>>>> 21eea5a4f14cb708c9bfa7409d53f1ba0df382fd
		</tr>
	</thead>
	<tbody>
	@foreach( $hives as $hive )
		<tr id="hive-{{ $hive->id }}" data-item-index="{{ $hive->id }}">
			<td class="center-align">{{ $hive->id }}</td>
			<td>{{ ucfirst( $hive->id_lot ) }}</td>
			<td class="center-align">{{ $hive->beehive_type }}</td>
			<td>{{ $hive->number_of_frames }}</td>
			<td>{{ $hive->number_of_rocks }}</td>
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 21eea5a4f14cb708c9bfa7409d53f1ba0df382fd
			<td>{{ $hive->comment }}</td>
		</tr>
>>>>>>> 21eea5a4f14cb708c9bfa7409d53f1ba0df382fd
	@endforeach
	</tbody>
</table>
<ul class="pagination"  id="hivesPagination"></ul>
@stop