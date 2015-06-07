{{ HTML::decode(
    Form::button(
        '<i class="mdi-content-send right"></i>',
        [
            'type' 				=> 'submit',
            'data-position' 	=> 'bottom',
            'data-delay' 		=> '50',
            'data-tooltip' 		=> trans( 'tools.submit' ) ,
            'class' 			=> 'btn-floating btn-tiny tooltipped waves-effect waves-light green accent-4 z-depth-1 text-white center-align'
        ]
    ) ) }}
