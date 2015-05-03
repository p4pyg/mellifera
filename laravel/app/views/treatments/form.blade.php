@extends('template')
@section('content')
<?php
if ( is_null( $treatment ) ) {
	$title 			= trans( 'treatments.create_new_treatment' );
	$route 			= 'treatment/create';
	$markup_delete 	= '';
}else{
	$title 			= trans( 'treatments.edit_treatment' );
	$route 			= 'treatment/update';
	$markup_delete 	= '<button class="ink-button" id="delete" data-item-index="' . $treatment->id . '"><span class="fa fa-trash fa-lg"></span></button>';
}
?>
<div class="all-100">
	<h1>{{ $title }}</h1>
	{{ $markup_delete }}
{{	Form::open( [ 'url' => 'treatment/edit/' . ( is_null( $treatment ) ? '' :  $treatment->id ) , 'method' => 'POST', 'class' => 'ink-form', 'id' => 'treatment_form' ] )	}}

		<div class="column-group gutters">
			<div class="control-group all-33">
				<label for="treatment_name">@lang( 'treatments.treatment_name' )</label>
				<div class="control">
					<input type="text" name="treatment_name" id="treatment_name" placeholder="@lang( 'treatments.treatment_name' )" value="{{ is_null( $treatment ) ? '' : $treatment->treatment_name }}">
				</div>
				<p class="tip">Indiquez ici le nom de la treatment</p>
			</div>
			<div class="control-group all-33">
				<label for="characteristics">@lang( 'treatments.characteristics' )</label>
				<div class="control">
					<input type="text" name="characteristics" id="characteristics" value="{{ is_null( $treatment ) ? '' :  $treatment->characteristics  }}">
				</div>
				<p class="tip">Indiquez ici les caractéristiques de la treatment</p>
			</div>
			<div class="control-group all-33">
				<label for="geographical_origin">@lang( 'treatments.geographical_origin' )</label>
				<div class="control">
					<input type="text" name="geographical_origin" id="geographical_origin" value="{{ is_null( $treatment ) ? '' : $treatment->geographical_origin }}">
				</div>
				<p class="tip">Indiquez ici l'origine géographique</p>
			</div>
			<div class="control-group all-33">
				<label for="life_span">@lang( 'treatments.life_span' )</label>
				<div class="control">
					<input type="text" name="life_span"  id="life_span"  value="{{ is_null( $treatment ) ? '' : $treatment->life_span }}" >
				</div>
				<p class="tip">Indiquez ici la méthode de clippage</p>
			</div>

		</div>
		<button class="ink-button" id="valid">Valider</button>
{{ Form::close() }}
</div>
<script type="text/javascript">
	$( '#delete' ).on( 'click', function(){
		document.location.href="/treatment/delete/" + $( this ).attr( 'data-item-index' );
	} );

</script>
@stop