@extends('template')
@section('content')
<div class="column-group">
	<div class="all-100">
		<h1>@lang('races.races')&nbsp;
			<small>
				{{ HTML::decode(
					HTML::link( 'race/edit/', '<span class="fa fa-plus-circle fa-lg"></span>',  trans( 'tools.add' ) ) ) }}
			</small>
		</h1>
		<table id="races" class="ink-table bordered hover alternating" data-page-size="5" data-pagination="#racesPagination" >
			<thead>
				<tr>
					<th class="align-left" data-sortable="true">@lang('races.id')</th>
					{{-- <th data-sortable="true">@lang('races.race')</th>
					<th data-sortable="true">@lang('races.geographical_origin')</th> --}}
				</tr>
			</thead>
			<tbody>
			@foreach( $races as $race )
				<tr id="race-{{ $race->id }}" data-item-index="{{ $race->id }}">
					<td>{{ $race->id }}</td>
					{{-- <td>{{ $race->race_name }}</td>
					<td>{{ $race->life_span }}</td>
					<td>{{ $race->geographical_origin }}</td> --}}
					<td>{{ $race->characteristics }}
				</tr>
			@endforeach
			</tbody>
		</table>
		<nav class="ink-navigation" id="racesPagination">
			<ul class="pagination black"></ul>
		</nav>
		<script>
			Ink.requireModules( ['Ink.Dom.Selector_1','Ink.UI.Table_1'], function( Selector, Table ){
				var tableElement = Ink.s('#races');
				var tableObj = new Table( tableElement );
			} );
			$( "tr[id^='race']" ).on( 'click', function(){
				// console.log("race_id", $( this ).attr( 'data-item-index' ) );
				document.location.href="race/edit/" + $( this ).attr( 'data-item-index' );
			} );
		</script>
	</div>
</div>
@stop