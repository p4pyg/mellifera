@extends('template')
@section('content')
<?php
if ( is_null( $hive ) ) {
	$title 			= trans( 'hives.create_new_hive' );
	$route 			= 'hive/create';
	$markup_delete 	= '';
}else{
	$title 			= trans( 'hives.edit_hive' );
	$route 			= 'hive/update';
	$markup_delete 	= '<button class="ink-button" id="delete" data-item-index="' . $hive->id . '"><span class="fa fa-trash fa-lg"></span></button>';
}
?>
<div class="all-100">
	<h1>{{ $title }}</h1>
	{{ $markup_delete }}
{{	Form::open( [ 'url' => 'hive/edit/' . ( is_null( $hive ) ? '' :  $hive->id ) , 'method' => 'POST', 'class' => 'ink-form', 'id' => 'hive_form' ] )	}}

		<div class="column-group gutters">
			<div class="control-group all-33">
				<label for="hive_id">@lang( 'hives.hive_name' )</label>
				<div class="control">
					<input type="text" name="hive_name" id="hive_name" placeholder="@lang( 'hives.hive_name' )" value="{{ is_null( $hive ) ? '' : $hive->hive_name }}">
				</div>
				<p class="tip">Indiquez ici le nom de la hive</p>
			</div>
			<div class="control-group all-33">
				<label for="characteristics">@lang( 'hives.characteristics' )</label>
				<div class="control">
					<input type="text" name="characteristics" id="characteristics" value="{{ is_null( $hive ) ? '' :  $hive->characteristics  }}">
				</div>
				<p class="tip">Indiquez ici les caractéristiques de la hive</p>
			</div>
			<div class="control-group all-33">
				<label for="geographical_origin">@lang( 'hives.geographical_origin' )</label>
				<div class="control">
					<input type="text" name="geographical_origin" id="geographical_origin" value="{{ is_null( $hive ) ? '' : $hive->geographical_origin }}">
				</div>
				<p class="tip">Indiquez ici l'origine géographique</p>
			</div>
			<div class="control-group all-33">
				<label for="life_span">@lang( 'hives.life_span' )</label>
				<div class="control">
					<input type="text" name="life_span"  id="life_span"  value="{{ is_null( $hive ) ? '' : $hive->life_span }}" >
				</div>
				<p class="tip">Indiquez ici la méthode de clippage</p>
			</div>

		</div>
		<button class="ink-button" id="valid">Valider</button>
{{ Form::close() }}
</div>
<script type="text/javascript">
	$( '#delete' ).on( 'click', function(){
		document.location.href="/hive/delete/" + $( this ).attr( 'data-item-index' );
	} );

</script>
@stop