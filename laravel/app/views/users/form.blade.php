@extends('template')
@section('content')

{{	Form::open( [ 'url' => 'user/edit/' . ( is_null( $user ) ? '' :  $user->id ) , 'method' => 'POST', 'class' => 'col s12', 'id' => 'user_form' ] )	}}
<div class="row valign-wrapper">
    <div class="col l10 m10 s10">
        <h2>@lang( 'users.signup_title' )&nbsp;</h2>
    </div>
    <div class="col l2 m2 s2 valign">
        @include( 'components.button_back', [ 'item' => 'users' ]  )
    </div>
    <div class="col l2 m2 s2 valign">
        @include( 'components.button_submit' )
    </div>
</div>
<div class="row">
    <div class="col l6 m6 s12">
        <div class="input-field col l12 m12 s12">
            <input type="text" id="email" class="validate" name="email" value="" />
            <label for="email">@lang( 'users.need_email_guest')</label>
        </div>
        <div class="input-field col l12 m12 s12">
            <input type="password" id="password" class="validate" name="password" value="" />
            <label for="password">@lang( 'users.need_password_guest' ) </label>
        </div>
        <div class="input-field col l12 m12 s12">
            <input type="password" id="password_confirmation" class="validate" name="password_confirmation" value="" />
            <label for="password_confirmation">@lang( 'users.need_password_confirmation_guest' ) </label>
        </div>
    </div>
</div>
{{ Form::close() }}
@stop
