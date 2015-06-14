{{ HTML::decode(
    HTML::link(
        str_singular( $entity ) . '/new/apiary/' . $apiary_id,
        '<span class="mdi-content-add tiny"></span>',
        [
            'data-position' 	=> 'bottom',
            'data-delay' 		=> '50',
            'data-tooltip' 		=> trans( 'tools.unit_add' ),
            'class' 			=> 'btn-floating btn-tiny tooltipped waves-effect waves-light white darken-4 z-depth-1 grey-text center-align'
        ]
    ) ) }}