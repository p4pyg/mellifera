@extends('template')
@section('content')
@include('components.index_header', ['thumb' => 'images/logo1-cert.svg'])
<table id="queens" class="responsive-table hover hoverable striped bordered" data-page-size="10" data-pagination="#queensPagination" >
    <thead>
        <tr>
            <th data-sortable="true">@lang('queens.id')</th>
            <th data-sortable="true">@lang('queens.hive')</th>
            <th data-sortable="true">@lang('queens.race')</th>
            <th data-sortable="true">@lang('queens.age')</th>
            <th data-sortable="true">@lang('queens.origin')</th>
            <th data-sortable="true">@lang('queens.clipping')</th>
        </tr>
    </thead>
    <tbody>
    @foreach($queens as $queen)
        <tr id="queen-{{ $queen->id }}" data-item-index="{{ $queen->id }}">
            <td class="center">{{ $queen->id }}</td>
            <td class="center"><a class="modal-trigger waves-effect waves-light btn-flat darken-4 z-depth-1 text-orange " id="trans-{{ $queen->id }}" href="#hive_change">{{ !empty($queen->is_in) ? $queen->is_in[0]->label : trans('queens.free')  }}</a></td>
            <td class="center">{{ !is_null($queen->race) ? $queen->race->label : '' }}</td>
            <td class="center">{{ BeeTools::elapsedTime($queen->birth_date) }}</td>
            <td class="center">{{ $queen->origin }}</td>
            <td class="center">{{ $queen->clipping }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<ul class="pagination"  id="queensPagination"></ul>
<div id="hive_change" class="modal">
    {{  Form::open(['url' => 'queen/transfert', 'method' => 'POST', 'class' => 'col s12', 'id' => 'transfert_form'])  }}
        <input id="queen_id" type="hidden" name="queen" value="">
        <div class="modal-content">
            <div class="row">
                <div class="col l10 m10 s10">
                    <h4>@lang('queens.transfert')</h4>
                </div>
                <div class="col l2 m2 s2">
                    @include('components.button_close')
                </div>
            </div>
            <p>@lang('queens.queen_to_hive')</p>
            <fieldset>
                <legend>@lang('hives.hive_list')</legend>
                <div class="input-field col l12 m12 s12">
                    <select name="hive" id="hive">
                        <option value="" disabled selected ></option>
                        @foreach($hives as $hive)
                        <option value="{{$hive->id}}">{{$hive->code_number}}</option>
                        @endforeach
                    </select>
                </div>
            </fieldset>
        </div>
        <div class="modal-footer row">
            <div class="offset-l10 col l2 m2 s2">
                @include('components.button_submit')
            </div>
        </div>
    {{ Form::close() }}
  </div>
@stop
