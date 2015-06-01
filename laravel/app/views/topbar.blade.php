<nav>
	<div class="nav-wrapper">
		<a href="/" class="brand-logo"><h4>Mellifera<small> Back-office</small></h4></a>
		<a href="#" data-activates="mobile-menu" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
		<ul class="right hide-on-med-and-down">
			<li>{{ HTML::link( 'backoffice', 'Mon exploitation', [ "class" => "waves-effect waves-light" ] ) }}</li>
			<li>{{ HTML::link( 'account', 'Mon compte', [ "class" => "waves-effect waves-light" ] ) }}</li>
			<li>{{ HTML::link( 'logout', 'Me déconnecter', [ "class" => "waves-effect waves-light" ] ) }}</li>
			{{--@if(!Auth::check())
				<li>{{ HTML::link( 'login', 'Se connecter', [ "class" => "waves-effect waves-light" ] ) }}</li>
			@else
				<li>{{ HTML::link( 'logout', 'Se deconnecter, [ "class" => "waves-effect waves-light" ]' ) }}</li>
			@endif--}}
		</ul>
		<ul class="side-nav" id="mobile-menu">
			<li>{{ HTML::link( 'backoffice', 'Mon exploitation', [ "class" => "waves-effect waves-light" ] ) }}</li>
			<li>{{ HTML::link( 'account', 'Mon compte', [ "class" => "waves-effect waves-light" ] ) }}</li>
			<li>{{ HTML::link( 'logout', 'Me déconnecter', [ "class" => "waves-effect waves-light" ] ) }}</li>

			{{--@if(Auth::check())
				<li>{{ HTML::link( 'login', 'Se connecter', [ "class" => "waves-effect waves-light" ] ) }}</li>
			@else
				<li>{{ HTML::link( 'logout', 'Se deconnecter', [ "class" => "waves-effect waves-light" ] ) }}</li>
			@endif--}}

		</ul>
	</div>
</nav>
