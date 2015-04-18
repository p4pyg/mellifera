@extends('template')
@section('content')
			<div class="column-group">
				<div class="all-100">
					<h1>Structures</h1>
					<p>Outil de visualisation de la structure JSON mise en forme pour une entité donnée.</p>
					<form class="ink-form" method="post" action="/structures">
						<fieldset>
							<legend>Sélectionnez l'entité</legend>
							<div class="control-group">
								<ul class="control unstyled">
								@foreach( $entities as $key => $entity )
									<li><input type="radio" id="entity{{ $key }}" name="entity" value="{{ $entity }}"><label for="entity{{ $key }}">{{ ucfirst( str_singular( $entity ) )}}</label></li>
								@endforeach
								</ul>
							</div>
						</fieldset>
						<button class="ink-button">Voir la structure</button>
					</form>
				</div>
			</div>
@stop