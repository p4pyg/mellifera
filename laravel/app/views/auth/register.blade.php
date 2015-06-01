@extends('template')

@if(Session::has('message'))
    <p class="alert">{{ Session::get('message') }}</p>
@endif

@section('content')
<form class="" method="post" action="signup">

<ul>
@foreach($errors->all() as $error)
    <li>{{ $error }}</li>
@endforeach
</ul>

<label>Veuillez entrer votre email :</label>
<input type="text" id="email" name="email" value="">
<br />
<label>Choisissez un mot de passe :</label>
<input type="password" id="password" name="password" value="">
<br />
<label>Entrez votre mot de passe une seconde fois (pour confirmation) :</label>
<input type="password" id="password_confirmation" name="password_confirmation" value="">
<br />

<button class="">S'inscrire</button>
</form>
@stop
