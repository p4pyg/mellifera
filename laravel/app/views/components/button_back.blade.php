
<?php if( !isset($entity) ) $entity = $item; ?>
{{ HTML::decode(
	HTML::link(
		$entity ,
		'<span class="mdi-content-reply"></span>',
		[
			'data-position' 	=> 'bottom',
			'data-delay' 		=> '50',
			'data-tooltip' 		=> trans( 'tools.back' ),
			'class' 			=> 'btn-floating btn-tiny tooltipped waves-effect waves-light orange darken-4 z-depth-1 text-white center-align'
		]
	) ) }}
