@if(Auth::check())
<ul id="basics" class="dropdown-content">
    <li>{{ HTML::link('races', trans('races.races'),     ["class" => "waves-effect waves-light"]) }}</li>
    <li>{{ HTML::link('queens', trans('queens.queens'),  ["class" => "waves-effect waves-light"]) }}</li>
    <li>{{ HTML::link('swarms', trans('swarms.swarms'),  ["class" => "waves-effect waves-light"]) }}</li>
    <li>{{ HTML::link('hives', trans('hives.hives'),     ["class" => "waves-effect waves-light"]) }}</li>
</ul>
<ul id="admin"  class="dropdown-content">
    <li>{{ HTML::link('person/edit/' . (is_null(Auth::user()->person) ? '' : Auth::user()->person->id), trans('tools.account'), ["class" => "waves-effect waves-light"]) }}</li>
    <li>{{ HTML::link('persons', trans('persons.persons'), ["class" => "waves-effect waves-light"]) }}</li>
    @if(Auth::user()->is_owner)
        <li>{{ HTML::link('users', trans('users.users'), ["class" => "waves-effect waves-light"]) }}</li>
    @endif
    </ul>
</ul>
<ul  id="manage"  class="dropdown-content">
    <li>{{ HTML::link('apiaries',      trans('apiaries.apiaries')) }}</li>
    <li>{{ HTML::link('treatments',    trans('treatments.treatments')) }}</li>
    <li>{{ HTML::link('documents',     trans('documents.documents')) }}</li>
    <li><a href="#">Aide</a></li>
</ul>
<ul id="mobile-basics" class="dropdown-content">
    <li>{{ HTML::link('races', trans('races.races'),     ["class" => "waves-effect waves-light"]) }}</li>
    <li>{{ HTML::link('queens', trans('queens.queens'),  ["class" => "waves-effect waves-light"]) }}</li>
    <li>{{ HTML::link('swarms', trans('swarms.swarms'),  ["class" => "waves-effect waves-light"]) }}</li>
    <li>{{ HTML::link('hives', trans('hives.hives'),     ["class" => "waves-effect waves-light"]) }}</li>
</ul>
<ul id="mobile-admin"  class="dropdown-content">
    <li>{{ HTML::link('person/edit/' . (is_null(Auth::user()->person) ? '' : Auth::user()->person->id), trans('tools.account'), ["class" => "waves-effect waves-light"]) }}</li>
    <li>{{ HTML::link('persons', trans('persons.persons'), ["class" => "waves-effect waves-light"]) }}</li>
    @if(Auth::user()->is_owner)
        <li>{{ HTML::link('users', trans('users.users'), ["class" => "waves-effect waves-light"]) }}</li>
    @endif
    </ul>
</ul>
<ul  id="mobile-manage"  class="dropdown-content">
    <li>{{ HTML::link('apiaries',      trans('apiaries.apiaries')) }}</li>
    <li>{{ HTML::link('treatments',    trans('treatments.treatments')) }}</li>
    <li>{{ HTML::link('documents',     trans('documents.documents')) }}</li>
    <li><a href="#">Aide</a></li>
</ul>
@endif
<nav>
    <div class="nav-wrapper">
        <a href="/" class="brand-logo"><h4>Mellifera<small> Back-office</small></h4></a>
        <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
        <ul class="right hide-on-med-and-down">
            @if(Auth::check())
                <li>{{ HTML::link('backoffice', trans('tools.dashboard'), ["class" => "waves-effect waves-light deep-orange darken-4 z-depth-2"]) }}</li>
                <li><a class="dropdown-button waves-effect waves-light" id="drop-basics" href="#!" data-activates="basics">@lang('tools.basics')</a></li>
                <li><a class="dropdown-button waves-effect waves-light" id="drop-manage" href="#!" data-activates="manage">@lang('tools.manage')</a></li>
                <li><a class="dropdown-button waves-effect waves-light" id="drop-admin" href="#!" data-activates="admin">@lang('tools.admin')</a></li>
                <li>{{ HTML::link('logout', trans('tools.logout'), ["class" => "waves-effect waves-light"]) }}</li>
            @endif
        </ul>
        <ul class="side-nav" id="mobile-menu">
            @if(Auth::check())
                <li>{{ HTML::link('backoffice', trans('tools.dashboard'), ["class" => "waves-effect waves-light deep-orange darken-4 z-depth-2"]) }}</li>
                <li><a class="dropdown-button waves-effect waves-light" id="drop-mobile-basics" href="#!" data-activates="mobile-basics">@lang('tools.basics')</a></li>
                <li><a class="dropdown-button waves-effect waves-light" id="drop-mobile-manage" href="#!" data-activates="mobile-manage">@lang('tools.manage')</a></li>
                <li><a class="dropdown-button waves-effect waves-light" id="drop-mobile-admin" href="#!" data-activates="mobile-admin">@lang('tools.admin')</a></li>
                <li>{{ HTML::link('logout', trans('tools.logout'), ["class" => "waves-effect waves-light"]) }}</li>
            @endif

        </ul>
    </div>
</nav>
