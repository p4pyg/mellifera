@extends('template')
@section('content')
@include( 'components.index_header' )
<p>@lang( 'users.list_info' )</p>
<table id="users" class="responsive-table hover hoverable striped bordered" data-page-size="5" data-pagination="#usersPagination" >
	<thead>
		<tr>
			<th class="align-left" data-sortable="true">@lang('users.id')</th>
			<th data-sortable="true">@lang('users.firstname')</th>
			<th class="align-center" data-sortable="true">@lang('users.lastname')</th>
			<th data-sortable="true">@lang('users.email')</th>
		</tr>
	</thead>
	<tbody>
	@foreach( $users as $user )
		<tr id="user-{{ $user->id }}" data-item-index="{{ $user->id }}">
			<td>{{ $user->id }}</td>
			<td>@if( ! is_null( $user->person ) ){{ $user->firstname }} @else {{ "n.c" }} @endif</td>
			<td>@if( ! is_null( $user->person ) ){{ $user->lastname }} @else {{ "n.c" }} @endif</td>
			<td>{{ $user->email }}</td>
		</tr>
	@endforeach
	</tbody>
</table>
<ul class="pagination"  id="usersPagination"></ul>
@stop
