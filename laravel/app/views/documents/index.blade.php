@extends('template')
@section('content')
@include( 'components.index_header' )
<table id="documents" class="responsive-table hover hoverable striped bordered" data-page-size="5" data-pagination="#documentsPagination" >
    <thead>
        <tr>
            <th class="align-left" data-sortable="true">@lang('documents.id')</th>
            <th data-sortable="true">@lang('documents.type')</th>
            <th class="align-center" data-sortable="true">@lang('documents.name')</th>
        </tr>
    </thead>
    <tbody>
    @foreach( $documents as $document )
        <tr id="document-{{ $document->id }}" data-item-index="{{ $document->id }}">
            <td>{{ $document->id }}</td>
            <td>{{ $document->type }}</td>
            <td>{{ $document->name }}</td>
            <td>{{ $document->email }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<ul class="pagination"  id="documentsPagination"></ul>
@stop
