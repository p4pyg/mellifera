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
				<p class="tip">Indiquez ici le nom du traitement</p>
			</div>
			<div class="control-group all-33">
				<label for="treatment_date">@lang( 'treatments.treatment_date' )</label>
				<div class="control">
					<input type="text" name="treatment_date" id="treatment_date" placeholder="@lang( 'treatments.treatment_date' )" value="{{ is_null( $treatment ) ? '' : $treatment->treatment_date }}">
				</div>
				<p class="tip">Indiquez ici la date du traitement</p>
			</div>
			<div class="control-group all-33">
				<label for="desease_treated">@lang( 'treatments.desease_treated' )</label>
				<div class="control">
					<input type="text" name="desease_treated" id="desease_treated" placeholder="@lang( 'treatments.desease_treated' )" value="{{ is_null( $treatment ) ? '' : $treatment->desease_treated }}">
				</div>
				<p class="tip">Indiquez ici la maladie traitée</p>
			</div>
			<div class="control-group all-33">
				<label for="product_quantity">@lang( 'treatments.product_quantity' )</label>
				<div class="control">
					<input type="text" name="product_quantity" id="product_quantity" placeholder="@lang( 'treatments.product_quantity' )" value="{{ is_null( $treatment ) ? '' : $treatment->product_quantity }}">
				</div>
				<p class="tip">Indiquez ici la quantité de produit utilisée</p>
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