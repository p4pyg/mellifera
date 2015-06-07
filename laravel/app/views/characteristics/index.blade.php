@extends('template')
@section('content')
@include( 'components.index_header' )
<table id="characteristics" class="responsive-table hover hoverable striped bordered" data-page-size="5" data-pagination="#characteristicsPagination" >
    <thead>
        <tr>
            <th class="align-left" data-sortable="true">@lang( 'characteristics.id' )</th>
            {{-- <th data-sortable="true">@lang( 'characteristics.racial_type' )</th> --}}
            <th data-sortable="true">@lang( 'characteristics.date' )</th>
            <th data-sortable="true">@lang( 'characteristics.aggressivness_level' )</th>
            <th data-sortable="true">@lang( 'characteristics.swarming_level' )</th>
            <th data-sortable="true">@lang( 'characteristics.winter_hardiness_level' )</th>
            <th data-sortable="true">@lang( 'characteristics.wake_up_month' )</th>
        </tr>
    </thead>
    <tbody>
    @foreach( $characteristics as $characteristic )
        <tr id="characteristic-{{ $characteristic->id }}" data-item-index="{{ $characteristic->id }}">
            <td>{{ $characteristic->id }}</td>
            {{-- <td>{{ $characteristic->racial_type }}</td> --}}
            <td>{{ date( 'd-m-Y', strtotime( $characteristic->date ) ) }}</td>
            <td>{{ $characteristic->aggressivness_level }}</td>
            <td>{{ $characteristic->swarming_level }}</td>
            <td>{{ $characteristic->winter_hardiness_level }}</td>
            <?php $month = BeeTools::list_month( $characteristic->wake_up_month ); ?>
            <td>{{ is_array( $month ) ? 'ND' : $month }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
    <ul class="pagination" id="characteristicsPagination"></ul>
@stop
