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
					<td>{{ $race->race_name }}</td>
					<td>{{ $race->life_span }}</td>
					<td>{{ $race->geographical_origin }}</td>
					<td>{{ $race->characteristics }}</td>
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
				document.location.href="race/edit/" + $( this ).attr( 'data-item-index' );
			} );
		</script>
	</div>
</div>
@stop