@extends('template')
@section('content')
<div class="column-group">
	<div class="all-100">
		<h1>@lang('characteristics.characteristics')&nbsp;
			<small>
				{{ HTML::decode(
					HTML::link( 'characteristic/edit/', '<span class="fa fa-plus-circle fa-lg"></span>',  trans( 'tools.add' ) ) ) }}
			</small>
		</h1>
		<table id="characteristics" class="ink-table bordered hover alternating" data-page-size="5" data-pagination="#characteristicsPagination" >
			<thead>
				<tr>
					<th class="align-left" data-sortable="true">@lang( 'characteristics.id' )</th>
					<th data-sortable="true">@lang( 'characteristics.date' )</th>
					<th data-sortable="true">@lang( 'characteristics.racial_type' )</th>
					<th data-sortable="true">@lang( 'characteristics.aggressivness_level' )</th>
					<th data-sortable="true">@lang( 'characteristics.swarming_level' )</th>
					<th data-sortable="true">@lang( 'characteristics.winter_hardiness_level' )</th>
					<th data-sortable="true">@lang( 'characteristics.wake_up_month' )</th>
				</tr>
			</thead>
			<tbody>
			@foreach( $characteristics as $characteristic )
				<tr id="characteristic-{{ $characteristic->id }}" data-item-index="{{ $characteristic->id }}">
					<td>{{ $characteristic->id }}</td>
					<td>{{ $characteristic->date }}</td>
					<td>{{ $characteristic->racial_type }}</td>
					<td>{{ $characteristic->aggressivness_level }}</td>
					<td>{{ $characteristic->swarming_level }}</td>
					<td>{{ $characteristic->winter_hardiness_level }}</td>
					<td>{{ $characteristic->wake_up_month }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		<nav class="ink-navigation" id="characteristicsPagination">
			<ul class="pagination black"></ul>
		</nav>
		<script>
			Ink.requireModules( ['Ink.Dom.Selector_1','Ink.UI.Table_1'], function( Selector, Table ){
				var tableElement = Ink.s('#characteristics');
				var tableObj = new Table( tableElement );
			} );
			$( "tr[id^='characteristic']" ).on( 'click', function(){
				// console.log("characteristic_id", $( this ).attr( 'data-item-index' ) );
				document.location.href="characteristic/edit/" + $( this ).attr( 'data-item-index' );
			} );
		</script>
	</div>
</div>
@stop

