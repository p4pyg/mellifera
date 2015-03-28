<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Mellifera</title>
		<meta name="description" content="">
		<meta name="author" content="ink, cookbook, recipes">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

		<!-- Place favicon.ico and apple-touch-icon(s) here  -->
		{{ HTML::style( "bower_components/Ink/dist/img/favicon.ico" ) }}
		{{ HTML::style( "bower_components/Ink/dist/img/touch-icon-iphone.png" ) }}
		{{ HTML::style( "bower_components/Ink/dist/img/touch-icon-ipad.png" ) }}
		{{ HTML::style( "bower_components/Ink/dist/img/touch-icon-iphone-retina.png" ) }}
		{{ HTML::style( "bower_components/Ink/dist/img/touch-icon-ipad-retina.png" ) }}
		{{ HTML::style( "bower_components/Ink/dist/img/splash.320x460.png" , [ 'media' => "screen and (min-device-width: 200px) and (max-device-width: 320px) and (orientation:portrait)" ] ) }}
		{{ HTML::style( "bower_components/Ink/dist/img/splash.768x1004.png" , [ 'media' => "screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)" ] ) }}
		{{ HTML::style( "bower_components/Ink/dist/img/splash.1024x748.png" , [ 'media' => "screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)" ] ) }}

		<!-- load Ink's CSS -->
		{{ HTML::style( "bower_components/Ink/dist/css/ink-flex.min.css" ) }}
		{{ HTML::style( "bower_components/Ink/dist/css/font-awesome.min.css" ) }}

		<!-- load Ink's CSS for IE8 -->
		<!--[if lt IE 9 ]>
			{{ HTML::style( "bower_components/Ink/dist/css/ink-ie.min.css", [ 'type' => "text/css", 'media' => "screen", 'title' => "no title", 'charset' => "utf-8" ] ) }}
		<![endif]-->

		<!-- test browser flexbox support and load legacy grid if unsupported -->
		{{ HTML::script( "bower_components/Ink/dist/js/modernizr.js" ) }}
		<script type="text/javascript">
			Modernizr.load({
			  test: Modernizr.flexbox,
			  nope : '../css/ink-legacy.min.css'
			});
		</script>

		<!-- load Ink's javascript files -->
		{{ HTML::script( "bower_components/Ink/dist/js/holder.js" ) }}
		{{ HTML::script( "bower_components/Ink/dist/js/ink-all.min.js" ) }}
		{{ HTML::script( "bower_components/Ink/dist/js/autoload.js" ) }}
		{{ HTML::script( "bower_components/Ink/src/js/Ink/Util/I18n/1/lib.js" ) }}
		{{ HTML::script( "bower_components/jquery/dist/jquery.min.js" ) }}
		<style>
			html, body {
				height: 100%;
				background: #f0f0f0;
			}
			.wrap {
				min-height: 100%;
				height: auto !important;
				height: 100%;
				margin: 0 auto -120px;
				overflow: auto;
			}
			.push, footer {
				height: 120px;
				margin-top: 0;
			}
			footer {
				background: #ccc;
				border: 0;
			}
			footer * {
				line-height: inherit;
			}
			.top-menu {
				background: #1a1a1a;
			}
			.table-img{
				width : 8rem;
				height: auto;
			}
		</style>
	</head>
	<body>
			<!--[if lte IE 9 ]>
		<div class="ink-grid">
			<div class="ink-alert basic" role="alert">
				<button class="ink-dismiss">&times;</button>
				<p>
					<strong>You are using an outdated Internet Explorer version.</strong>
					Please <a href="http://browsehappy.com/">upgrade to a modern  browser</a> to improve your web experience.
				</p>
			</div>
		</div>
			<![endif]-->
		<div class="wrap">
			@include( 'topbar' )
			<div class="ink-grid vertical-space">
				@yield('content')
			</div>
			<div class="push"></div>
		</div>
		<footer class="clearfix">
			<div class="ink-grid">
				<ul class="unstyled inline half-vertical-space">
					<li><a href="#">Aide</a></li>
				</ul>
				<p class="note">Mellifera Backoffice - Creative Commons BY ND SA</p>
			</div>
		</footer>
	</body>
</html>
