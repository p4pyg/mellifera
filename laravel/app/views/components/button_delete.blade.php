{{ HTML::decode(
    HTML::link(
        '#',
        '<span class="fa fa-trash tiny"></span>',
        [
            'id' 				=> 'delete',
            'data-item-index' 	=> $item->id,
            'data-position' 	=> 'bottom',
            'data-delay' 		=> '50',
            'data-tooltip' 		=> trans( 'tools.delete' ),
            'class' 			=> 'btn-floating btn-tiny tooltipped waves-effect waves-light orange darken-4 z-depth-1 text-white center-align'
        ]
    ) ) }}
