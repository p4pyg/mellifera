@extends('template')
@section('content')
<div class="column-group">
	<div class="all-100">
		<h1>@lang('treatments.treatments')&nbsp;
			<small>
				{{ HTML::decode(
					HTML::link( 'treatment/edit/', '<span class="fa fa-plus-circle fa-lg"></span>',  trans( 'tools.add' ) ) ) }}
			</small>
		</h1>
		<table id="treatments" class="ink-table bordered hover alternating" data-page-size="5" data-pagination="#treatmentsPagination" >
			<thead>
				<tr>
					<th class="align-left" data-sortable="true">@lang('treatments.id')</th>
					<th data-sortable="true">@lang('treatments.treatment_date')</th>
					<th class="align-center" data-sortable="true">@lang('treatments.desease_treated')</th>
					<th data-sortable="true">@lang('treatments.product_quantity')</th>
				</tr>
			</thead>
			<tbody>
			@foreach( $treatments as $treatment )
				<tr id="treatment-{{ $treatment->id }}" data-item-index="{{ $treatment->id }}">
					<td>{{ $treatment->id }}</td>
					<td>{{ $treatment->treatment_date }}</td>
					<td>{{ $treatment->desease_treated }}</td> --}}
					<td>{{ $treatment->product_quantity }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		<nav class="ink-navigation" id="treatmentsPagination">
			<ul class="pagination black"></ul>
		</nav>
		<script>
			Ink.requireModules( ['Ink.Dom.Selector_1','Ink.UI.Table_1'], function( Selector, Table ){
				var tableElement = Ink.s('#treatments');
				var tableObj = new Table( tableElement );
			} );
			$( "tr[id^='treatment']" ).on( 'click', function(){
				// console.log("treatment_id", $( this ).attr( 'data-item-index' ) );
				document.location.href="treatment/edit/" + $( this ).attr( 'data-item-index' );
			} );
		</script>
	</div>
</div>
@stop
