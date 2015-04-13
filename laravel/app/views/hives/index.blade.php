@extends('template')
@section('content')
<div class="column-group">
	<div class="all-100">
		<h1>@lang('hives.hives')&nbsp;
			<small>
				{{ HTML::decode(
					HTML::link( 'hive/edit/', '<span class="fa fa-plus-circle fa-lg"></span>',  trans( 'tools.add' ) ) ) }}
			</small>
		</h1>
		<table id="hives" class="ink-table bordered hover alternating" data-page-size="5" data-pagination="#hivesPagination" >
			<thead>
				<tr>
					<th class="align-left" data-sortable="true">@lang('hives.id')</th>
					<th data-sortable="true">@lang('hives.id_lot')</th>
					<th class="align-center" data-sortable="true">@lang('hives.beehive_type')</th>
					<th data-sortable="true">@lang('hives.acquisition_date')</th>
					<th data-sortable="true">@lang('hives.number_of_frames')</th>
					<th data-sortable="true">@lang('hives.number_of_rocks')</th>
					<th data-sortable="true">@lang('hives.notes')</th>

				</tr>
			</thead>
			<tbody>
			@foreach( $hives as $hive )
				<tr id="hive-{{ $hive->id }}" data-item-index="{{ $hive->id }}">
					<td>{{ $hive->id }}</td>
					<td>{{ $hive->id_lot }}</td>
					<td>{{ $hive->beehive_type }}</td>
					<td>{{ $hive->acquisition_date  }}</td>
					<td>{{ $hive->number_of_frames }}</td>
					<td>{{ $hive->number_of_rocks }}</td>
					<td>{{ $hive->notes }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		<nav class="ink-navigation" id="hivesPagination">
			<ul class="pagination black"></ul>
		</nav>
		<script>
			Ink.requireModules( ['Ink.Dom.Selector_1','Ink.UI.Table_1'], function( Selector, Table ){
				var tableElement = Ink.s('#hives');
				var tableObj = new Table( tableElement );
			} );
			$( "tr[id^='hive']" ).on( 'click', function(){
				document.location.href="hive/edit/" + $( this ).attr( 'data-item-index' );
			} );
		</script>
	</div>
</div>
@stop