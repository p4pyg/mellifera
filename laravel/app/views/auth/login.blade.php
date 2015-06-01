@extends('template')
@section('content')
<div class="row valign-wrapper">
	<div class="col l10 m10 s10">
		<h2>@lang( 'users.signin_title' )&nbsp;</h2>
	</div>
</div>
{{	Form::open( [ 'url' => 'signin' , 'method' => 'POST', 'class' => 'col s12', 'id' => 'signin_form' ] )	}}
	<input type="hidden" id="id" name="id" value="9999" />
	<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
	<div class="input-field col l6 m6 s12">
		<input type="text" id="email" class="validate" name="email" value="" />
		<label for="email">Veuillez entrer votre email :</label>
	</div>
	<div class="input-field col l6 m6 s12">
		<input type="password" id="password" class="validate" name="password" value="" />
		<label for="password">Et votre mot de passe :</label>
	</div>
	@include( 'components.button_submit' )
{{ Form::close() }}
@stop
