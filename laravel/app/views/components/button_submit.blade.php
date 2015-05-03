{{ HTML::decode(
	Form::button(
		trans( 'tools.submit' ) . '<i class="mdi-content-send right"></i>',
		[
			'type' 				=> 'submit',
			'class' 			=> 'btn waves-effect waves-light orange darken-4 z-depth-1'
		]
	) ) }}
