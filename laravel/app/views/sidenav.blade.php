<ul id="slide-out" class="side-nav">
	{{-- <li>{{ HTML::link( 'home', 'Accueil' ) }}</li> --}}
	{{-- <li><a href="#">Colonies</a></li> --}}
	<li>{{ HTML::link( 'apiaries', trans( 'apiaries.apiaries' ) ) }}</li>
	<li>{{ HTML::link( 'hives', trans( 'hives.hives' ) ) }}</li>
	<li>{{ HTML::link( 'races', trans( 'races.races' ) ) }}</li>
	<li>{{ HTML::link( 'queens', trans( 'queens.queens' ) ) }}</li>
	<li>{{ HTML::link( 'characteristics', trans( 'characteristics.characteristics' ) ) }}</li>
	<li>{{ HTML::link( 'structures', 'Structures JSON' ) }}</li>
	<li><a href="#">Aide</a></li>
</ul>
<a href="#" data-activates="slide-out" class="button-collapse waves-effect waves-light orange-text text-darken-4"><i class="mdi-navigation-apps medium"></i></a>