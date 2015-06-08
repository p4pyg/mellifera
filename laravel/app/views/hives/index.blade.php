@extends('template')
@section('content')
@include( 'components.index_header' )
<table id="hives" class="responsive-table hover hoverable striped bordered" data-page-size="5" data-pagination="#hivesPagination" >
    <thead>
        <tr>
            <th class="align-left" data-sortable="true">@lang( 'hives.id' )</th>
            <th data-sortable="true">@lang( 'hives.code_number' )</th>
            <th data-sortable="true">@lang( 'hives.type' )</th>
            <th data-sortable="true">@lang( 'hives.number_of_frames' )</th>
            <th>@lang( 'hives.barcode' )</th>


        </tr>
    </thead>
    <tbody>
    @foreach( $hives as $hive )
        <tr id="hive-{{ $hive->id }}" data-item-index="{{ $hive->id }}">
            <td>{{ $hive->id }}</td>
            <td>{{ $hive->code_number }}</td>
            <td>{{ $hive->type->name }}</td>
            <td>{{ $hive->number_of_frames }}</td>
            <td>{{ DNS2D::getBarcodeSVG( '{ "id":' . $hive->id . ', "code_number":' . $hive->code_number . ' }', "QRCODE",3,3,"#E65100") }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<ul class="pagination"  id="hivesPagination"></ul>
@stop
