@extends('template')
@section('content')
{{	Form::open( [ 'url' => 'signin' , 'method' => 'POST', 'class' => 'col s12', 'id' => 'signin_form' ] )	}}
<div class="row valign-wrapper">
	<div class="col l10 m10 s10">
		<h2>@lang( 'users.signin_title' )&nbsp;</h2>
	</div>
	<div class="col l2 m2 s2 valign">
		@include( 'components.button_back', [ 'item' => 'backoffice' ]  )
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
	</div>
	<div class="col l6 m6 s12">
		<h3>@lang( 'users.signup' )</h3>
		<p>@lang( 'users.signup_info' )</p>
		{{ HTML::link( 'signup', trans( 'users.signup_link' ), [ "class" => "waves-effect waves-light" ] ) }}

	</div>

</div>

{{ Form::close() }}
@stop
