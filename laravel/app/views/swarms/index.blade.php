@extends('template')
@section('content')
@include( 'components.index_header', ['thumb' => 'images/logo4-frame.svg'] )
<?php


/**
 * @todo  Trouver une utilisation de la propriété trades
 */

?>
<table id="swarms" class="responsive-table hover hoverable striped bordered" data-page-size="10" data-pagination="#swarmsPagination" >
    <thead>
        <tr>
            <th data-sortable="true">@lang('swarms.id')</th>
            <th data-sortable="true">@lang('queens.hive')</th>
            <th data-sortable="true">@lang('swarms.origin')</th>
            <th data-sortable="true">@lang('swarms.race')</th>
            <th data-sortable="true">@lang('swarms.extermination')</th>
            <th data-sortable="true">@lang('swarms.purpose')</th>
        </tr>
    </thead>
    <tbody>
    @foreach( $swarms as $swarm )
        <tr id="swarm-{{ $swarm->id }}" data-item-index="{{ $swarm->id }}">
            <td class="center">{{ $swarm->id }}</td>
            <td class="center"><a class="modal-trigger waves-effect waves-light btn-flat darken-4 z-depth-1 text-orange " id="trans-{{ $swarm->id }}" href="#swarm_change">{{ !empty($swarm->is_in) ? $swarm->is_in[0]->label : trans('swarms.free')  }}</a></td>
            <td>{{ ucfirst( $swarm->origin ) }}</td>
            <td>{{ ucfirst( $swarm->race ) }}</td>
            <td>{{ $swarm->extermination }}</td>
            <td>{{ $swarm->purpose }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<ul class="pagination"  id="swarmsPagination"></ul>
<div id="swarm_change" class="modal">
    {{  Form::open(['url' => 'swarm/transfert', 'method' => 'POST', 'class' => 'col s12', 'id' => 'transfert_form'])  }}
        <input id="swarm_id" type="hidden" name="swarm" value="">
        <div class="modal-content">
            <div class="row">
                <div class="col l10 m10 s10">
                    <h4>@lang('swarms.transfert')</h4>
                </div>
                <div class="col l2 m2 s2">
                    @include('components.button_close')
                </div>
            </div>
            <p>@lang('swarms.swarm_to_hive')</p>
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
