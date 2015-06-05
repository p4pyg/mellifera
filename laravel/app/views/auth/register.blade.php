@extends('template')
@section('content')
{{	Form::open( [ 'url' => 'signup' , 'method' => 'POST', 'class' => 'col s12', 'id' => 'signup_form' ] )	}}
<div class="row valign-wrapper">
	<div class="col l10 m10 s10">
		<h2>@lang( 'users.signup_title' )&nbsp;</h2>
	</div>
	<div class="col l2 m2 s2 valign">
		@include( 'components.button_back', [ 'item' => 'login' ]  )
	</div>
	<div class="col l2 m2 s2 valign">
		@include( 'components.button_submit' )
	</div>
</div>
<div class="row">
	<div class="col l6 m6 s12">
		<div class="input-field col l12 m12 s12">
			<input type="text" id="email" class="validate" name="email" value="" />
			<label for="email">@lang( 'users.need_email')</label>
		</div>
		<div class="input-field col l12 m12 s12">
			<input type="password" id="password" class="validate" name="password" value="" />
			<label for="password">@lang( 'users.need_password' ) </label>
		</div>
		<div class="input-field col l12 m12 s12">
			<input type="password" id="password_confirmation" class="validate" name="password_confirmation" value="" />
			<label for="password_confirmation">@lang( 'users.need_password_confirmation' ) </label>
		</div>
	</div>
</div>
{{ Form::close() }}
@stop
