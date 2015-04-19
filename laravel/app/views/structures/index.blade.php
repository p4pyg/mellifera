@extends('template')
@section('content')
			<div class="column-group">
				<div class="all-100">
					<table id="races" class="ink-table bordered hover alternating" >
						<thead>
							<tr>
								<th class="align-left" data-sortable="true">Entité</th>
								<th data-sortable="true">Structure</th>
							</tr>
						</thead>
						<tbody>
							@foreach( $structures as $key => $structure )

							<tr id="entity-{{ $structure->id }}" data-item-index="{{ $structure->id }}" data-item-name="{{ str_singular( $key ) }}">
								<td>{{ BeeTools::table_entity( $key ) }}</td>
								<td><pre>{{ print_r( $structure ) }}</pre></td>
							</tr>

							@endforeach
						</tbody>
					</table>
				</div>
			</div>
<script>
	$( "tr[id^='entity']" ).on( 'click', function(){
		document.location.href=$( this ).attr( 'data-item-name' ) + "/edit/" + $( this ).attr( 'data-item-index' );
	} );
</script>
@stop
