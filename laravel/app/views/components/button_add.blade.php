{{ HTML::decode(
	HTML::link(
		str_singular( $entity ) . '/edit/',
		'<span class="mdi-content-add tiny"></span>',
		[
			'data-position' 	=> 'bottom',
			'data-delay' 		=> '50',
			'data-tooltip' 		=> trans( 'tools.add' ),
			'class' 			=> 'btn-floating btn-tiny tooltipped waves-effect waves-light orange darken-4 z-depth-1 text-white center-align'
		]
	) ) }}
