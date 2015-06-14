<?php list( $entity, $page ) = explode( '.', Route::currentRouteName() ); ?>

<div class="row valign-wrapper">
    <div class="col l8 m8 s8">
        @if( $page !== 'show' )
        	<h2>@lang( $entity . '.' . $entity )&nbsp;</h2>
        @else
			<h2>@lang( $entity . '.' . str_singular( $entity ) )&nbsp;</h2>
        @endif
    </div>
    <div class="col l2 m2 s2 valign">
        @include( 'components.button_back' )
    </div>
    @if( $page !== 'show' )
    <div class="col l2 m2 s2 valign">
        @include( 'components.button_add' )
    </div>
    @endif
</div>
