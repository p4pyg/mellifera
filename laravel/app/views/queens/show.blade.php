@extends('template')
@section('content')
@include( 'components.index_header' )
 <h3>Liste des affectations (units)</h3>
 <ul class='collection'>
@foreach ( $queen->is_in as $key => $unit )
    <li class="collection-item avatar">
        <span class="title">Identifiant : {{ $unit->id }}</span>
        <p>
            Label : {{ $unit->label }}<br />
            Mise à jour : {{ date( 'd-m-Y', time( $unit->updated_at ) ) }}
        </p>
        <a href="#!" class="secondary-content"><i class="mdi-action-grade"></i></a>
    </li>
@endforeach
 </ul>
@stop
