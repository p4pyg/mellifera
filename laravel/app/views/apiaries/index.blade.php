@extends('template')
@section('content')
<div class="column-group">
	<div class="all-100">
		<h1>@lang('apiaries.apiaries')&nbsp;
			<small>
				{{ HTML::decode(
					HTML::link( 'apiary/edit/', '<span class="fa fa-plus-circle fa-lg"></span>',  trans( 'tools.add' ) ) ) }}
			</small>
		</h1>
		<table id="apiaries" class="ink-table bordered hover alternating" data-page-size="5" data-pagination="#apiariesPagination" >
			<thead>
				<tr>
					<!-- <th class="align-left" data-sortable="true">@lang( 'apiaries.weathers' )</th> -->
					<th class="align-left" data-sortable="true">@lang( 'apiaries.id' )</th>
					<th data-sortable="true">@lang( 'apiaries.apiary_name' )</th>
					<th data-sortable="true">@lang( 'apiaries.address1' )</th>
					<th data-sortable="true">@lang( 'apiaries.address2' )</th>
					<th data-sortable="true">@lang( 'apiaries.postcode' )</th>
					<th data-sortable="true">@lang( 'apiaries.city' )</th>
					<th data-sortable="true">@lang( 'apiaries.longitude' )</th>
					<th data-sortable="true">@lang( 'apiaries.latitude' )</th>
					<th data-sortable="true">@lang( 'apiaries.altitude' )</th>
					<th data-sortable="true">@lang( 'apiaries.vegetation_type' )</th>
					<th data-sortable="true">@lang( 'apiaries.hives_capacity' )</th>
					<th data-sortable="true">@lang( 'apiaries.apiary_notes' )</th>
					<th data-sortable="true">@lang( 'apiaries.notes' )</th>
				</tr>
			</thead>
			<tbody>
			@foreach( $apiaries as $apiary )
				<tr id="apiary-{{ $apiary->id }}" data-item-index="{{ $apiary->id }}">
					<td>{{ $apiary->id }}</td>
					<td>{{ $apiary->apiary_name }}</td>
					<td>{{ $apiary->address1 }}</td>
					<td>{{ $apiary->address2 }}</td>
					<td>{{ $apiary->postcode }}</td>
					<td>{{ $apiary->city }}</td>
					<td>{{ $apiary->longitude }}</td>
					<td>{{ $apiary->latitude }}</td>
					<td>{{ $apiary->altitude }}</td>
					<td>{{ $apiary->hives_capacity }}</td>
					<td>{{ $apiary->vegetation_type }}</td>
					<td>{{ $apiary->apiary_notes }}</td>
					<td>{{ $apiary->notes }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		<nav class="ink-navigation" id="apiariesPagination">
			<ul class="pagination black"></ul>
		</nav>
		<script>
			Ink.requireModules( ['Ink.Dom.Selector_1','Ink.UI.Table_1'], function( Selector, Table ){
				var tableElement = Ink.s('#apiaries');
				var tableObj = new Table( tableElement );
			} );
			$( "tr[id^='apiary']" ).on( 'click', function(){
				// console.log("apiary_id", $( this ).attr( 'data-item-index' ) );
				document.location.href="apiary/edit/" + $( this ).attr( 'data-item-index' );
			} );
		</script>
	</div>
</div>
@stop

