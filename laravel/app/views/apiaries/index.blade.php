@extends('template')
@section('content')
@include( 'components.index_header' )
<table id="apiaries" class="responsive-table hover hoverable striped bordered" data-page-size="5" data-pagination="#apiariesPagination" >
	<thead>
		<tr>
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
			<th data-sortable="true">@lang( 'apiaries.rank' )</th>
		</tr>
	</thead>
	<tbody>
	@foreach( $apiaries as $apiary )
		<tr id="apiary-{{ $apiary->id }}" data-item-index="{{ $apiary->id }}">
			<td>{{ $apiary->id }}</td>
			<td>{{ ucfirst( $apiary->name ) }}</td>
			<td>{{ $apiary->address1 }}</td>
			<td>{{ $apiary->address2 }}</td>
			<td>{{ $apiary->postcode }}</td>
			<td>{{ $apiary->city }}</td>
			<td>{{ $apiary->longitude }}</td>
			<td>{{ $apiary->latitude }}</td>
			<td>{{ $apiary->altitude }}</td>
			<td>{{ $apiary->vegetation_type }}</td>
			<td>{{ $apiary->hives_capacity }}</td>
			<td>{{ $apiary->rank }}</td>
		</tr>
	@endforeach
	</tbody>
</table>
<ul class="pagination"  id="apiariesPagination"></ul>
@stop