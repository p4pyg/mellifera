@extends('template')
@section('content')
        <div class="row">
            <h2>@lang('tools.dashboard')</h2>
            <blockquote>
                <p>@lang('tools.dash_info')</p>
            </blockquote>
            <div class="col l6 m6 s12">
                <ul class="collection">
                    <li class="collection-item avatar">
                        <img src="images/logo5-hive.svg" alt="" class="circle">
                        <span class="title">{{ $apiaries_nb }}&nbsp;{{ $apiaries_nb > 1 ? trans('apiaries.apiaries') : trans('apiaries.apiary') }}</span>
                        <a href="/apiaries" class="secondary-content"><i class="mdi-image-remove-red-eye"></i></a>
                    </li>
                    <li class="collection-item avatar">
                        <img src="images/logo5-hive-v2.svg" alt="" class="circle">
                        <span class="title">{{ $hives_nb }}&nbsp;{{ $hives_nb > 1 ? trans('hives.hives') : trans('hives.hive') }}</span>
                        <a href="/hives" class="secondary-content"><i class="mdi-image-remove-red-eye"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col l6 m6 s12">
                <ul class="collection">
                    <li class="collection-item avatar">
                        <img src="images/logo1-cert.svg" alt="" class="circle">
                        <span class="title">{{ $queens_nb }}&nbsp;{{ $queens_nb > 1 ? trans('queens.queens') : trans('queens.queen') }}</span>
                        <a href="/queens" class="secondary-content"><i class="mdi-image-remove-red-eye"></i></a>
                    </li>
                    <li class="collection-item avatar">
                        <img src="images/logo4-frame.svg" alt="" class="circle">
                        <span class="title">{{ $swarms_nb }}&nbsp;{{ $swarms_nb > 1 ? trans('swarms.swarms') : trans('swarms.swarm') }}</span>
                        <a href="/swarms" class="secondary-content"><i class="mdi-image-remove-red-eye"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
    <section id="map">
        <div class="map" id="map_1" data-maplat="43.754718" data-maplon="3.726423" data-mapzoom="7" data-color="invert" data-height="32.222" data-img="images/bee_marker_2.svg" data-info="Premier rucher"></div>
    </section>
<div class="container">
    <div class="col l12 m12 s12 ">
@stop
