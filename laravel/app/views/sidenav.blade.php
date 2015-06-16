<ul id="slide-out" class="side-nav">
    {{-- <li>{{ HTML::link( 'home', 'Accueil' ) }}</li> --}}
    {{-- <li><a href="#">Colonies</a></li> --}}
    <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
            <li>
                <a class="collapsible-header">Les basiques<i class="mdi-navigation-arrow-drop-down"></i></a>
                <div class="collapsible-body">
                    <ul>
                        <li>{{ HTML::link( 'races', trans( 'races.races' ) ) }}</li>
                        <li>{{ HTML::link( 'characteristics', trans( 'characteristics.characteristics' ) ) }}</li>
                        <li>{{ HTML::link( 'queens', trans( 'queens.queens' ) ) }}</li>
                        <li>{{ HTML::link( 'swarms', trans( 'swarms.swarms' ) ) }}</li>
                        <li>{{ HTML::link( 'hives', trans( 'hives.hives' ) ) }}</li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>
    <li>{{ HTML::link( 'apiaries', trans( 'apiaries.apiaries' ) ) }}</li>
    <li>{{ HTML::link( 'treatments', trans( 'treatments.treatments' ) ) }}</li>
    <li>{{ HTML::link( 'documents', trans( 'documents.documents' ) ) }}</li>
    <li class="no-padding">
        <ul class="collapsible" data-collapsible="accordion">
            <li>
                <div class="collapsible-header">Administration<i class="mdi-navigation-arrow-drop-down"></i></div>
                <div class="collapsible-body">
                    <ul>
                        <li>{{ HTML::link( 'persons', trans( 'persons.persons' ) ) }}</li>
                        @if( Auth::user()->is_owner )
                            <li>{{ HTML::link( 'users', trans( 'users.users' ) ) }}</li>
                        @endif

                    </ul>
                </div>
            </li>
        </ul>
    </li>
    {{-- <li>{{ HTML::link( 'structures', 'Structures JSON' ) }}</li> --}}
    <li><a href="#">Aide</a></li>
</ul>
<a href="#" data-activates="slide-out" class="button-collapse waves-effect waves-light orange-text text-darken-4"><i class="mdi-navigation-apps medium"></i></a>
