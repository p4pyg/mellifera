@extends('template')

{{--

{"id": 1221,
"comment": null,
"created_at": 1431954843585,
"updated_at": 1431954843585,
"deleted_at": null,
"email": "coin@coin.coin",
"password": null,
"client_id": "c62f11dd2015-05-18 13:13:59",
"client_key": "t454pPr154L1r30Uqu01?",
"token": "90572d92e62f47a18ce932d87d886cc7",
"valid": true,
"person": null,
"group_owner": {
"id": 1181,
"comment": null,
"created_at": 1431954843454,
"updated_at": 1431954843454,
"deleted_at": null,
"group": {
"id": 1201,
"comment": null,
"created_at": 1431954843478,
"updated_at": 1431954843478,
"deleted_at": null,
"name": "group_0002",
"users": 
[1221],
"units": [ ],
"owner": 1181,
"label": "group_0002"},
"user": 1221,
"label": "1221"},
"group": 1201,
"group_name": null,
"label": "1221"}

--}}
@if(Session::has('message'))
	<p class="alert">{{ Session::get('message') }}</p>
@endif


@section('content')
<form class="" method="post" action="signin">

<ul>
@foreach($errors->all() as $error)
	<li>{{ $error }}</li>
@endforeach
</ul>
<input type="hidden" id="id" name="id" value="9999">
<br />


<label>Veuillez entrer votre email :</label>
<input type="text" id="email" name="email" value="">
<br />
<label>Et votre mot de passe :</label>
<input type="password" id="password" name="password" value="">
<br />

<button class="">Me connecter</button>
</form>
@stop
