@extends('template')
@section('content')
<div class="column-group">
	<div class="all-100">
		<h1>@lang('queens.queens')&nbsp;
			<small>
				{{ HTML::decode(
					HTML::link( 'queen/edit/', '<span class="fa fa-plus-circle fa-lg"></span>',  trans( 'tools.add' ) ) ) }}
			</small>
		</h1>
		<table id="queens" class="ink-table bordered hover alternating" data-page-size="5" data-pagination="#queensPagination" >
			<thead>
				<tr>
					<th class="align-left" data-sortable="true">@lang('queens.id')</th>
					<th data-sortable="true">@lang('queens.race')</th>
					<th class="align-center" data-sortable="true">@lang('queens.age')</th>
					<th data-sortable="true">@lang('queens.geographical_origin')</th>
					<th data-sortable="true">@lang('queens.clipping')</th>
{{-- 					<th data-sortable="true">@lang('queens.current_swarm')</th>
					<th data-sortable="true">@lang('queens.thumbnail')</th> --}}
					<th data-sortable="true">@lang('queens.die_date')</th>
				</tr>
			</thead>
			<tbody>
			@foreach( $queens as $queen )
				<tr id="queen-{{ $queen->id }}" data-item-index="{{ $queen->id }}">
					<td>{{ $queen->id }}</td>
					<td>{{ $queen->race->race_name }}</td>
					<td>{{ date( 'Y', time() ) - date( 'Y' , strtotime( $queen->birth_date ) ) }}</td>
					<td>{{ $queen->race->geographical_origin }}</td>
					<td>{{ $queen->clipping }}</td>
					{{-- <td>{{ $queen->current_swarm }}</td>
					<td><figure  class="ink-image table-img">{{ HTML::image( $queen->thumbnail, $queen->thumbname, [ 'class' => 'table-img' ] ) }}</figure></td> --}}
					<td>{{ is_null( $queen->death_date ) ? '-' : date( 'd/m/Y', strtotime( $queen->death_date ) ) }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		<nav class="ink-navigation" id="queensPagination">
			<ul class="pagination black"></ul>
		</nav>
		<script>
			Ink.requireModules( ['Ink.Dom.Selector_1','Ink.UI.Table_1'], function( Selector, Table ){
				var tableElement = Ink.s('#queens');
				var tableObj = new Table( tableElement );
			} );
			$( "tr[id^='queen']" ).on( 'click', function(){
				// console.log("queen_id", $( this ).attr( 'data-item-index' ) );
				document.location.href="queen/edit/" + $( this ).attr( 'data-item-index' );
			} );
		</script>
	</div>
</div>
@stop