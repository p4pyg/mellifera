@extends('template')
@section('content')
<?php
if ( is_null( $document ) ) {
	$title 			= trans( 'documents.create_new_document' );
	$route 			= 'document/create';
}else{
	$title 			= trans( 'documents.edit_document' );
	$route 			= 'document/update';
}
?>
<div class="row valign-wrapper">
	<div class="col l10 m10 s10">
		<h2>{{ $title }}&nbsp;</h2>
	</div>
	<div class="col l2 m2 s2 valign">
		@include( 'components.button_submit' )
	</div>
	<div class="col l2 m2 s2 valign">
	@if( ! is_null( $document ) )
		@include( 'components.button_delete', [ 'item' => $document ] )
	@endif
	</div>
</div>
{{	Form::open( [ 'url' => 'document/edit/' . ( is_null( $document ) ? '' :  $document->id ) , 'method' => 'POST', 'class' => 'col s12', 'id' => 'document_form' ] )	}}
<div class="row">
	<div class="input-field col l6 m6 s12">
		<input type="text" name="name" id="name" class="validate" value="{{ is_null( $document ) ? '' : $document->name }}">
		<label for="name">@lang( 'documents.name' )</label>
	</div>
	<div class="input-field col l6 m6 s12">
		<input type="text" name="type" id="type" class="validate" value="{{ is_null( $document ) ? '' :  $document->type  }}">
		<label for="type">@lang( 'documents.type' )</label>
	</div>
		<div class="input-field col l6 m6 s12">
		<input type="text" name="name" id="name" class="validate" value="{{ is_null( $document ) ? '' :  $document->name  }}">
		<label for="name">@lang( 'documents.name' )</label>
	</div>
</div>
{{ Form::close() }}
@stop