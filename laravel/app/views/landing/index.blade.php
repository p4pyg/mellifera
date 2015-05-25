@extends('template')
@section('content')
<header>
	<div class="navbar-fixed">
		<nav>
			<div class="nav-wrapper">
				<a href="#"><img src="landing/images/bee.png" style="width:5rem; margin-top : 1rem; margin-left : 1rem" alt="BEE"></a>
				<a href="#" data-activates="mobile-landing-menu" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
				<ul id="landing-menu" class="right hide-on-med-and-down">
					<li><a href="/backoffice">Accès au back-office</a></li>
					<li><a href="/logout"><?php echo ( is_null( Session::get( 'user' ) ) ? '' : Session::get('user')[0]->name ) ; ?></a></li>
				</ul>
				<ul class="side-nav" id="mobile-landing-menu">
					<li><a href="/backoffice">Accès au back-office</a></li>
					<li><a href="/logout"><?php echo ( is_null( Session::get( 'user' ) ) ? '' : Session::get('user')[0]->name ) ; ?></a></li>
				</ul>
			</div>
		</nav>
	</div>
</header>
<main id="landing-page">
	<div id="header" class="parallax-container">
		<div class="parallax">
			<img src="landing/images/abeille-tournesol.png" alt="Image Top Parallax">
		</div>
		<div class="section">
			<div class="row">
				<h2 class="white-text">Bee <span class="orange-text text-darken-2">solutions</span></h2>
				<div id="subtitle" class="container hide-on-med-and-down">
					<div class="col l12 m12 s12">
						<p class="right-align grey-text text-darken-1">
							Un ensemble d'outils de gestion apicole<br />
							<span class="info">API RestFull, applications mobiles,<br /> interface d'administration des données</span>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container  brown-text">
		<div id="intro" class="row">
			<p class="center-align">
				<a href="#" class="waves-effect waves-light btn orange darken-3 white-text z-depth-2">Les applications pour smartphones</a>
			</p>
			<p class="center-align grey-text text-darken-2">
				Deux versions Android (SDK et Webview)
			</p>

			<h2 class="center-align">La mobilité en prime</h2>
			<p class="center-align">Sur smatphone ou tablette, synchronisez les données collectées sur le terrain, visualisez l'état de vos ruches, organisez vos transhumances</p>
			<div class="col l6 m6 s12">
				<img src="images/qr-code.png" alt="QR Code - Android">
			</div>
			<div class="col l6 m6 s12">
				<img src="images/qr-code.png" alt="QR Code - Webview">
			</div>
		</div>
	</div>

	<div id="description-header" class="parallax-container">
		<div class="parallax">
			<img src="landing/images/rucher.png" alt="Action rucher">
		</div>
		<div class="section">
			<div class="row">
				<h2 class="white-text center-align" style="text-shadow: 0 0 .3rem rgba(0,0,0,.5)"><big>Préparez vos interventions</big></h2>
			</div>
		</div>
	</div>
	<div class="container  brown-text">
		<div id="description" class="row">
			<div class="col l6 m6 s12">
				<img class="responsive-img" src="images/logo4.svg" alt="">
				<h3>Gérez vos essaims</h3>
				<p>Indiquez la race et l'origine d'une reine, son intégration à la colonnie et appréciez la force globale.</p>
			</div>
			<div class="col l6 m6 s12">
				<img class="responsive-img" src="images/logo3.svg" alt="">
				<h3>Listez vos ruches</h3>
				<p>Visualisez les ruches composant votre rucher, accedez à l'historique de chacune d'entre elles, paramétrez leur caractéristiques.</p>
			</div>
			<div class="col l6 m6 s12">
				<img class="responsive-img" src="images/logo2.svg" alt="">
				<h3>Localisez vos ruchers</h3>
				<p>Un outil de cartographie vous permet de visualiser la disposition de vos ruchers et ainsi vous aider à plannifier les repositionement dans le respect des règles de distance entre rucher.</p>
			</div>
			<div class="col l6 m6 s12">
				<img class="responsive-img" src="images/logo1.svg" alt="">
				<h3>Planifiez vos actions</h3>
				<p>Depuis l'interface de gestion, organisez vos traitements et interventions sur les ruchers, éditez vos étiquettes et feuilles d'intervention. </p>
			</div>
		</div>
	</div>
	<section id="team" class="parallax-container hide-on-med-and-down">
		<div class="parallax">
			<img src="images/honeycomb.jpg" alt="Team background Image">
		</div>

		<h2>Les équipes du projet</h2>
		<div class="slider">
			<ul class="slides">
				<li>
					<h4>Alane, David et Jonathan</h4>
					<h3><blockquote>L'équipe en charge des services web</blockquote></h3>
					<h4><em class="date">BeeWebServices</em></h4>
				</li>
				<li>
					<h4>Dominique et Shanti</h4>
					<h3><blockquote>Équipe de développeurs Android (SDK)</blockquote></h3>
					<h4><em class="date">BeeAppli</em></h4>
				</li>
				<li>
					<h4>Hugo et Sébastien</h4>
					<h3><blockquote>Équipe de développeurs Android (Ionic)</blockquote></h3>
					<h4><em class="date">BeeAppWeb</em></h4>
				</li>
				<li>
					<h4>Cyril, Laurent et Yoann</h4>
					<h3><blockquote>L'équipe en charge de l'interface de gestion</blockquote></h3>
					<h4><em class="date">BeeBackoffice</em></h4>
				</li>
			</ul>
		</div>
	</section>
</main>
<section class="orange darken-5">
	<div class="container">
		<h2 class="white-text" style="text-transform : uppercase">Les quatres briques</h2>
		<div class="row">
			<div class="col l6 m6 s12">
				<div class="card orange accent-1">
					<div class="card-content brown-text">
						<p class="center-align"><i class="large mdi-device-storage"></i></p>
						<h2 class="center-align card-title">Service web</h2>
						<hr />
						<p class="center-align">Les données</p>
						<ul class="item-list">
							<li>Accès sécurisé aux données</li>
							<li>Format ouvert des échanges</li>
							<li>Intégration de services tiers</li>
						</ul>
					</div>
					<div class="card-action">
						<button type="button" class="btn orange darken-3">En savoir plus</button>
					</div>
				</div>
			</div>
			<div class="col l6 m6 s12">
				<div class="card orange accent-1">
					<div class="card-content brown-text">
						<p class="center-align"><i class="large mdi-hardware-desktop-windows"></i></p>
						<h2 class="center-align card-title">Plateforme</h2>
						<hr />
						<p class="center-align">La gestion</p>
						<ul class="item-list">
							<li>Administration</li>
							<li>Création de ruchers</li>
							<li>Édition des données</li>
						</ul>
					</div>
					<div class="card-action">
						<button type="button" class="btn orange darken-3">En savoir plus</button>
					</div>
				</div>
			</div>
			<div class="col l6 m6 s12">
				<div class="card orange accent-1">
					<div class="card-content brown-text">
						<p class="center-align"><i class="large mdi-hardware-phone-android"></i></p>
						<h2 class="center-align card-title">Smartphone</h2>
						<hr />
						<p class="center-align">La mobilté</p>
						<ul class="item-list">
							<li>Relevé sur le terrain</li>
							<li>Mode hors connexion</li>
							<li>Mise à jour et historique</li>
						</ul>
					</div>
					<div class="card-action">
						<button type="button" class="btn orange darken-3">En savoir plus</button>
					</div>
				</div>
			</div>
			<div class="col l6 m6 s12">
				<div class="card orange accent-1">
					<div class="card-content brown-text">
						<p class="center-align"><i class="large mdi-hardware-tablet-android"></i></p>
						<h2 class="center-align card-title">Tablette</h2>
						<hr />
						<p class="center-align">L'ergonomie</p>
						<ul class="item-list">
							<li>Confort d'utilisation</li>
							<li>Interopérabilité</li>
							<li>Fonctionnalité avancée</li>
						</ul>
					</div>
					<div class="card-action">
						<button type="button" class="btn orange darken-3">En savoir plus</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<footer style="background-color:#F2BA01">
	<div class="container brown-text">
		<div class="row">
			<div class="col l3 m3 s6">
				<h4>Navigation</h4>
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">Vue d'ensemble</a></li>
					<li><a href="#">Code source</a></li>
					<li><a href="#">License</a></li>
					<li><a href="#">Support</a></li>
				</ul>
			</div>
			<div class="col l4 m4 s6">
				<h4>Montpellier, Hérault</h4>
				<address>1337, boulevard Open Source - 34000</address>
				<strong class="phone"><a href="tel:XXXXXXXXXX">XX XX XX XX XX</a></strong>
				<span class="available">Ne pas déranger</span>
			</div>
			<div class="col l5 m5 s12">
				<h4>Info</h4>
				<p>Wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex commodo consequat. Autem vel hendrerit iriure dolor in hendrerit.</p>
			</div>
		</div>
	</div>
</footer>

@stop