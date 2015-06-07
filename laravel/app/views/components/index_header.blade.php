<?php list( $entity, $page ) = explode( '.', Route::currentRouteName() ); ?>

<div class="row valign-wrapper">
    <div class="col l8 m8 s8">
        <h2>@lang( $entity . '.' . $entity )&nbsp;</h2>
    </div>
    <div class="col l2 m2 s2 valign">
        @include( 'components.button_back' )
    </div>
    <div class="col l2 m2 s2 valign">
        @include( 'components.button_add' )
    </div>
</div>
