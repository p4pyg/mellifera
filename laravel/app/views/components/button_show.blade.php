{{ HTML::decode(
    HTML::link(
        str_singular( $entity ) . '/show/' . $item,
        '<span class="mdi-action-visibility"></span>',
        [
            'data-position' 	=> 'bottom',
            'data-delay' 		=> '50',
            'data-tooltip' 		=> trans( 'tools.show' ),
            'class' 			=> 'btn-floating tooltipped waves-effect waves-light white darken-4 z-depth-1 grey-text center-align'
        ]
    ) ) }}
