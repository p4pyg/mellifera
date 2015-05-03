@extends('template')
@section('content')
<table id="races" class="responsive-table hover hoverable striped bordered" >
	<thead>
		<tr>
			<th>Entité</th>
			<th>Structure</th>
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
@stop
