@extends('template')
@section('content')
<?php
if ( is_null( $queen ) ) {
	$title 			= trans( 'queens.create_new_queen' );
	$route 			= 'queen/create';
	$markup_delete 	= '';
}else{
	$title 			= trans( 'queens.edit_queen' );
	$route 			= 'queen/edit';
	$markup_delete 	= '<button><span class="fa fa-trash fa-lg"></span></button>';
}
?>
<div class="all-100">
	<h1>{{ $title }}</h1>
	<form class="ink-form">
		<div class="column-group gutters">
			<div class="control-group all-33">
				<label for="parent_tree">@lang( 'queens.parent_tree' )</label>
				<div class="control">
					<input type="text" name="parent_tree" id="parent_tree" value="{{ is_null( $queen ) ? '' : $queen->parent_tree }}">
				</div>
				<p class="tip">You can add tips to fields</p>
			</div>
			<div class="control-group all-33">
				<label for="age">@lang( 'queens.age' )</label>
				<div class="control">
					<input type="text" name="age" id="age" value="{{ is_null( $queen ) ? '' : $queen->age }}">
				</div>
				<p class="tip">You can add tips to fields</p>
			</div>
			<div class="control-group all-33">
				<label for="origin">@lang( 'queens.origin' )</label>
				<div class="control">
					<input type="text" name="origin" id="origin" value="{{ is_null( $queen ) ? '' : $queen->origin }}">
				</div>
				<p class="tip">You can add tips to fields</p>
			</div>
			<div class="control-group all-33">
				<label for="clipping">@lang( 'queens.clipping' )</label>
				<ul class="control unstyled">
					<li><input type="radio" id="clipping_1" name="clipping" value="0"><label for="clipping_1">None</label></li>
					<li><input type="radio" id="clipping_2" name="clipping" value="1"><label for="clipping_2">Right</label></li>
					<li><input type="radio" id="clipping_3" name="clipping" value="2"><label for="clipping_3">Left</label></li>
				</ul>
				<p class="tip">You can add tips to fields</p>
			</div>
			<div class="control-group all-33">
				<label for="current_swarm">@lang( 'queens.current_swarm' )</label>
				<div class="control">
					<input type="text" name="current_swarm" id="current_swarm" value="{{ is_null( $queen ) ? '' : $queen->current_swarm }}">
				</div>
				<p class="tip">You can add tips to fields</p>
			</div>
			<div class="control-group all-33">
				<label for="die_date">@lang( 'queens.die_date' )</label>
				<div class="control">
					<input type="text" name="die_date" id="die_date" value="{{ is_null( $queen ) ? '' : $queen->die_date }}">
				</div>
				<p class="tip">You can add tips to fields</p>
			</div>
			<div class="control-group all-33">
				<label for="thumbnail">@lang( 'queens.thumbnail' )</label>
				<div class="control">
					<input type="text" name="thumbnail" id="thumbnail" value="{{ is_null( $queen ) ? '' : $queen->thumbnail }}">
				</div>
				<p class="tip">You can add tips to fields</p>
			</div>
			<div class="control-group all-33">
				<label for="thumbname">@lang( 'queens.thumbname' )</label>
				<div class="control">
					<input type="text" name="thumbname" id="thumbname" value="{{ is_null( $queen ) ? '' : $queen->thumbname }}">
				</div>
				<p class="tip">You can add tips to fields</p>
			</div>
		</div>
	</form>
</div>
@stop