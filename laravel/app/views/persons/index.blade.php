@extends('template')
@section('content')
@include( 'components.index_header' )
<table id="persons" class="responsive-table hover hoverable striped bordered" data-page-size="5" data-pagination="#personsPagination" >
	<thead>
		<tr>
			<th class="align-left" data-sortable="true">@lang( 'persons.id' )</th>
			<th data-sortable="true">@lang( 'persons.first_name' )</th>
			<th data-sortable="true">@lang( 'persons.last_name' )</th>
			<th data-sortable="true">@lang( 'persons.address1' )</th>
			<th data-sortable="true">@lang( 'persons.address2' )</th>
			<th data-sortable="true">@lang( 'persons.postcode' )</th>
			<th data-sortable="true">@lang( 'persons.city' )</th>
			<th data-sortable="true">@lang( 'persons.phone' )</th>
			<th data-sortable="true">@lang( 'persons.email' )</th>
			<th data-sortable="true">@lang( 'persons.user' )</th>
			<th data-sortable="true">@lang( 'persons.trades_with_sellers' )</th>
			<th data-sortable="true">@lang( 'persons.trades_with_buyers' )</th>

		</tr>
	</thead>
	<tbody>
	@foreach( $persons as $person )
		<tr id="person-{{ $person->id }}" data-item-index="{{ $person->id }}">
			<td>{{ $person->id }}</td>
			<td>{{ ucfirst( $person->first_name ) }}</td>
			<td>{{ ucfirst( $person->last_name ) }}</td>
			<td>{{ $person->address1 }}</td>
			<td>{{ $person->address2 }}</td>
			<td>{{ $person->postcode }}</td>
			<td>{{ $person->city }}</td>
			<td>{{ $person->phone }}</td>
			<td>{{ $person->email }}</td>
			<td>{{ $person->user }}</td>
			<td>{{ $person->trades_with_sellers }}</td>
			<td>{{ $person->trades_with_buyers }}</td>

		</tr>
	@endforeach
	</tbody>
</table>
<ul class="pagination"  id="personsPagination"></ul>
@stop