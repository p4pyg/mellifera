<?php list( $entity, $page ) = explode( '.', Route::currentRouteName() ); ?>

<div class="row valign-wrapper">
    <div class="col l8 m8 s8">
        @if( $page !== 'show' )
            <div class="col l4 m4 s4">
                <img src="{{ isset($thumb) ? $thumb : null }}" class="thumb" alt="Thumb logo">
            </div>
            <div class="col l8 m8 s8">
                <h2>@lang( $entity . '.' . $entity )&nbsp;</h2>
            </div>
        @else
            <div class="col l4 m4 s4">
                <img src="{{ isset($thumb) ? $thumb : null }}" class="thumb" alt="Thumb logo">
            </div>
            <div class="col l8 m8 s8">
                <h2>@lang( $entity . '.' . str_singular( $entity ) )&nbsp;</h2>
            </div>
        @endif
    </div>
    <div class="col l2 m2 s2 valign">
        @include( 'components.button_back', ['item'=>'backoffice'] )
    </div>
    @if( $page !== 'show' )
    <div class="col l2 m2 s2 valign">
        @include( 'components.button_add' )
    </div>
    @endif
</div>
