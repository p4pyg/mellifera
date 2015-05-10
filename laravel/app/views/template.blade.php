<?php list( $entity, $page ) = explode( '.', Route::currentRouteName() ); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Mellifera</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		{{ HTML::style( "bower_components/Ink/dist/css/font-awesome.min.css" ) }}
		{{ HTML::style( "bower_components/materialize/dist/css/materialize.min.css" ) }}
		{{ HTML::style( "css/main.css" ) }}

	</head>
	<body>
		<header>
			@include( 'topbar' )
			@include( 'sidenav' )
		</header>
		<main role="main">
			<div class="container">
				<div class="col l12 m12 s12 ">
					@yield('content')
				</div>
			</div>
		</main>
		<footer class="page-footer orange"  role="contentinfo">
			@include( 'footer' )
		</footer>
		@include( 'components.button_scroll_top' )
		{{ HTML::script( "https://code.jquery.com/jquery-2.1.1.min.js" ) }}
		{{ HTML::script( "bower_components/Ink/dist/js/ink-all.min.js" ) }}
		{{ HTML::script( "bower_components/materialize/dist/js/materialize.min.js" ) }}
		<script>
			$( document ).ready( function(){
				$( ".button-collapse" ).sideNav();
			} );
			/* Scroll to top */
			var offset = 300, offset_opacity = 1200, scroll_top_duration = 700, $back_to_top = $('.cd-top'); $(window).scroll(function(){( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out'); if( $(this).scrollTop() > offset_opacity ) {$back_to_top.addClass('cd-fade-out'); } }); $back_to_top.on('click', function(event){event.preventDefault(); $('body,html').animate({scrollTop: 0 , }, scroll_top_duration ); });
		</script>
@if( $page == 'index' )
		<script>
			Ink.requireModules( ['Ink.Dom.Selector_1','Ink.UI.Table_1'], function( Selector, Table ){
				var tableElement = Ink.s('#{{ $entity }}');
				var tableObj = new Table( tableElement );
			} );
			Ink.requireModules(['Ink.UI.Pagination_1'], function( Pagination ){
				Pagination._optionDefinition.previousLabel 	= ['String', '<i class="mdi-navigation-chevron-left"></i>'];
				Pagination._optionDefinition.nextLabel 		= ['String', '<i class="mdi-navigation-chevron-right"></i>'];
			});
			$( document ).ready( function(){
				$( "tr[id^='{{ str_singular( $entity ) }}']" ).on( 'click', function(){
					document.location.href="{{ str_singular( $entity ) }}/edit/" + $( this ).attr( 'data-item-index' );
				} );
			} );
		</script>
@endif
@if( in_array( $page, [ 'create', 'edit' ] ) )
		<script type="text/javascript">
			$( document ).ready( function(){
				$( '#delete' ).on( 'click', function(){
					document.location.href="/{{  str_singular( $entity )  }}/delete/" + $( this ).attr( 'data-item-index' );
				} );
				$('.datepicker').pickadate({
					selectMonths: true, // Creates a dropdown to control month
					selectYears: 15, // Creates a dropdown of 15 years to control year
					labelMonthNext: 'Mois suivant',
					labelYearSelect: 'Sélectionnez une année',
					// Months and weekdays
					monthsFull: [ 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre' ],
					monthsShort: [ 'Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aout', 'Sept', 'Oct', 'Nov', 'Dec' ],
					weekdaysFull: [ 'Dimanche', 'Lundi', 'Jeudi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi' ],
					weekdaysShort: [ 'Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam' ],

					// Materialize modified
					weekdaysLetter: [ 'D', 'L', 'M', 'M', 'J', 'V', 'S' ],

					// Today and clear
					today: 'Aujourd\'hui',
					clear: '<i class="mdi-content-undo"></i>',
					close: '<i class="mdi-content-clear"></i>',

					// The format to show on the `input` element
					format: 'd-mm-yyyy',

				} );
				$('select').material_select();
			} );
		</script>
@endif

@if( $page == 'home' )
<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script>
/**
 * @name  InfoBox
 * @version  1.1.12 [December 11, 2012]
 * @author  Gary Little (inspired by proof-of-concept code from Pamela Fox of Google)
 * @copyright  Copyright 2010 Gary Little [gary at luxcentral.com]
 * @fileoverview  InfoBox extends the Google Maps JavaScript API V3 <tt>OverlayView</tt> class.
 *  <p>
 *  An InfoBox behaves like a <tt>google.maps.InfoWindow</tt>, but it supports several
 *  additional properties for advanced styling. An InfoBox can also be used as a map label.
 *  <p>
 *  An InfoBox also fires the same events as a <tt>google.maps.InfoWindow</tt>.
 * More informations about Infobox: http://stackoverflow.com/questions/7616666/google-maps-api-v3-custom-styles-for-infowindow
 */
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('6 8(a){a=a||{};r.s.1P.2j(2,36);2.M=a.1y||"";2.1z=a.1q||J;2.U=a.1H||0;2.G=a.1B||1g r.s.1Y(0,0);2.E=a.Y||1g r.s.2B(0,0);2.X=a.V||t;2.1p=a.1s||"2g";2.1m=a.F||{};2.1G=a.1E||"39";2.N=a.1j||"34://31.r.2W/2Q/2O/2K/1u.2I";3(a.1j===""){2.N=""}2.19=a.1A||1g r.s.1Y(1,1);3(p a.A==="q"){3(p a.18==="q"){a.A=L}v{a.A=!a.18}}2.w=!a.A;2.17=a.1n||J;2.1I=a.2f||"2d";2.15=a.1l||J;2.4=t;2.z=t;2.14=t;2.T=t;2.B=t;2.R=t}8.9=1g r.s.1P();8.9.24=6(){5 i;5 f;5 a;5 d=2;5 c=6(e){e.20=L;3(e.1i){e.1i()}};5 b=6(e){e.2T=J;3(e.1Z){e.1Z()}3(!d.15){c(e)}};3(!2.4){2.4=16.2N("2M");2.1d();3(p 2.M.1v==="q"){2.4.Q=2.I()+2.M}v{2.4.Q=2.I();2.4.1e(2.M)}2.2F()[2.1I].1e(2.4);2.1t();3(2.4.7.C){2.R=L}v{3(2.U!==0&&2.4.Z>2.U){2.4.7.C=2.U;2.4.7.2A="2x";2.R=L}v{a=2.22();2.4.7.C=(2.4.Z-a.13-a.12)+"11";2.R=J}}2.1r(2.1z);3(!2.15){2.B=[];f=["2q","1N","2p","2o","1M","2n","2m","2l","2k"];1o(i=0;i<f.1L;i++){2.B.1K(r.s.u.1c(2.4,f[i],c))}2.B.1K(r.s.u.1c(2.4,"1N",6(e){2.7.1J="2i"}))}2.T=r.s.u.1c(2.4,"2h",b);r.s.u.S(2,"2e")}};8.9.I=6(){5 a="";3(2.N!==""){a="<2c";a+=" 2b=\'"+2.N+"\'";a+=" 2a=12";a+=" 7=\'";a+=" Y: 29;";a+=" 1J: 28;";a+=" 27: "+2.1G+";";a+="\'>"}K a};8.9.1t=6(){5 a;3(2.N!==""){a=2.4.3f;2.z=r.s.u.1c(a,"1M",2.26())}v{2.z=t}};8.9.26=6(){5 a=2;K 6(e){e.20=L;3(e.1i){e.1i()}r.s.u.S(a,"3e");a.1u()}};8.9.1r=6(d){5 m;5 n;5 e=0,H=0;3(!d){m=2.1F();3(m 3d r.s.3c){3(!m.25().3a(2.E)){m.38(2.E)}n=m.25();5 a=m.37();5 h=a.Z;5 f=a.23;5 k=2.G.C;5 l=2.G.1k;5 g=2.4.Z;5 b=2.4.23;5 i=2.19.C;5 j=2.19.1k;5 o=2.21().35(2.E);3(o.x<(-k+i)){e=o.x+k-i}v 3((o.x+g+k+i)>h){e=o.x+g+k+i-h}3(2.17){3(o.y<(-l+j+b)){H=o.y+l-j-b}v 3((o.y+l+j)>f){H=o.y+l+j-f}}v{3(o.y<(-l+j)){H=o.y+l-j}v 3((o.y+b+l+j)>f){H=o.y+b+l+j-f}}3(!(e===0&&H===0)){5 c=m.33();m.32(e,H)}}}};8.9.1d=6(){5 i,F;3(2.4){2.4.30=2.1p;2.4.7.2Z="";F=2.1m;1o(i 2Y F){3(F.2X(i)){2.4.7[i]=F[i]}}3(p 2.4.7.1f!=="q"&&2.4.7.1f!==""){2.4.7.2V="2S(1f="+(2.4.7.1f*2R)+")"}2.4.7.Y="2P";2.4.7.P=\'1b\';3(2.X!==t){2.4.7.V=2.X}}};8.9.22=6(){5 c;5 a={1a:0,1h:0,13:0,12:0};5 b=2.4;3(16.1w&&16.1w.1X){c=b.2L.1w.1X(b,"");3(c){a.1a=D(c.1W,10)||0;a.1h=D(c.1V,10)||0;a.13=D(c.1U,10)||0;a.12=D(c.1T,10)||0}}v 3(16.2J.O){3(b.O){a.1a=D(b.O.1W,10)||0;a.1h=D(b.O.1V,10)||0;a.13=D(b.O.1U,10)||0;a.12=D(b.O.1T,10)||0}}K a};8.9.2H=6(){3(2.4){2.4.2G.2U(2.4);2.4=t}};8.9.1x=6(){2.24();5 a=2.21().2E(2.E);2.4.7.13=(a.x+2.G.C)+"11";3(2.17){2.4.7.1h=-(a.y+2.G.1k)+"11"}v{2.4.7.1a=(a.y+2.G.1k)+"11"}3(2.w){2.4.7.P=\'1b\'}v{2.4.7.P="A"}};8.9.2D=6(a){3(p a.1s!=="q"){2.1p=a.1s;2.1d()}3(p a.F!=="q"){2.1m=a.F;2.1d()}3(p a.1y!=="q"){2.1S(a.1y)}3(p a.1q!=="q"){2.1z=a.1q}3(p a.1H!=="q"){2.U=a.1H}3(p a.1B!=="q"){2.G=a.1B}3(p a.1n!=="q"){2.17=a.1n}3(p a.Y!=="q"){2.1D(a.Y)}3(p a.V!=="q"){2.1R(a.V)}3(p a.1E!=="q"){2.1G=a.1E}3(p a.1j!=="q"){2.N=a.1j}3(p a.1A!=="q"){2.19=a.1A}3(p a.18!=="q"){2.w=a.18}3(p a.A!=="q"){2.w=!a.A}3(p a.1l!=="q"){2.15=a.1l}3(2.4){2.1x()}};8.9.1S=6(a){2.M=a;3(2.4){3(2.z){r.s.u.W(2.z);2.z=t}3(!2.R){2.4.7.C=""}3(p a.1v==="q"){2.4.Q=2.I()+a}v{2.4.Q=2.I();2.4.1e(a)}3(!2.R){2.4.7.C=2.4.Z+"11";3(p a.1v==="q"){2.4.Q=2.I()+a}v{2.4.Q=2.I();2.4.1e(a)}}2.1t()}r.s.u.S(2,"2C")};8.9.1D=6(a){2.E=a;3(2.4){2.1x()}r.s.u.S(2,"1Q")};8.9.1R=6(a){2.X=a;3(2.4){2.4.7.V=a}r.s.u.S(2,"2z")};8.9.2y=6(a){2.w=!a;3(2.4){2.4.7.P=(2.w?"1b":"A")}};8.9.2w=6(){K 2.M};8.9.1C=6(){K 2.E};8.9.2v=6(){K 2.X};8.9.2u=6(){5 a;3((p 2.1F()==="q")||(2.1F()===t)){a=J}v{a=!2.w}K a};8.9.2t=6(){2.w=J;3(2.4){2.4.7.P="A"}};8.9.3b=6(){2.w=L;3(2.4){2.4.7.P="1b"}};8.9.2s=6(c,b){5 a=2;3(b){2.E=b.1C();2.14=r.s.u.2r(b,"1Q",6(){a.1D(2.1C())})}2.1O(c);3(2.4){2.1r()}};8.9.1u=6(){5 i;3(2.z){r.s.u.W(2.z);2.z=t}3(2.B){1o(i=0;i<2.B.1L;i++){r.s.u.W(2.B[i])}2.B=t}3(2.14){r.s.u.W(2.14);2.14=t}3(2.T){r.s.u.W(2.T);2.T=t}2.1O(t)};',62,202,'||this|if|div_|var|function|style|InfoBox|prototype||||||||||||||||typeof|undefined|google|maps|null|event|else|isHidden_|||closeListener_|visible|eventListeners_|width|parseInt|position_|boxStyle|pixelOffset_|yOffset|getCloseBoxImg_|false|return|true|content_|closeBoxURL_|currentStyle|visibility|innerHTML|fixedWidthSet_|trigger|contextListener_|maxWidth_|zIndex|removeListener|zIndex_|position|offsetWidth||px|right|left|moveListener_|enableEventPropagation_|document|alignBottom_|isHidden|infoBoxClearance_|top|hidden|addDomListener|setBoxStyle_|appendChild|opacity|new|bottom|stopPropagation|closeBoxURL|height|enableEventPropagation|boxStyle_|alignBottom|for|boxClass_|disableAutoPan|panBox_|boxClass|addClickHandler_|close|nodeType|defaultView|draw|content|disableAutoPan_|infoBoxClearance|pixelOffset|getPosition|setPosition|closeBoxMargin|getMap|closeBoxMargin_|maxWidth|pane_|cursor|push|length|click|mouseover|setMap|OverlayView|position_changed|setZIndex|setContent|borderRightWidth|borderLeftWidth|borderBottomWidth|borderTopWidth|getComputedStyle|Size|preventDefault|cancelBubble|getProjection|getBoxWidths_|offsetHeight|createInfoBoxDiv_|getBounds|getCloseClickHandler_|margin|pointer|relative|align|src|img|floatPane|domready|pane|infoBox|contextmenu|default|apply|touchmove|touchend|touchstart|dblclick|mouseup|mouseout|mousedown|addListener|open|show|getVisible|getZIndex|getContent|auto|setVisible|zindex_changed|overflow|LatLng|content_changed|setOptions|fromLatLngToDivPixel|getPanes|parentNode|onRemove|gif|documentElement|mapfiles|ownerDocument|div|createElement|en_us|absolute|intl|100|alpha|returnValue|removeChild|filter|com|hasOwnProperty|in|cssText|className|www|panBy|getCenter|http|fromLatLngToContainerPixel|arguments|getDiv|setCenter|2px|contains|hide|Map|instanceof|closeclick|firstChild'.split('|'),0,{}));

	/* Initialize Google Maps */
	function googleMap() {
		$( '.map' ).each( function ( i, e ) {
			$map 		= $( e );
			$map_lat 	= $map.attr( 'data-mapLat' );
			$map_lon 	= $map.attr( 'data-mapLon' );
			$map_zoom 	= parseInt( $map.attr( 'data-mapZoom' ) );
			$map_img 	= $map.attr( 'data-img' );
			$map_color 	= $map.attr( 'data-color' );
			$map_height = $map.attr( 'data-height' );
			var latlng 	= new google.maps.LatLng( $map_lat, $map_lon );
			var options = { scrollwheel: false, draggable: true, zoomControl: true, disableDoubleClickZoom: false, disableDefaultUI: false, zoom: $map_zoom, center: latlng, mapTypeId: google.maps.MapTypeId.ROADMAP };

			/* Map's style */
			if ( $map_color == 'invert' ) {
				var styles 	= [ { "stylers": [ { "invert_lightness": "true" }, { "hue": "0xffbb00" }, { "saturation": "-100" }, { "lightness": "15" } ] } ],
				textcolor 	= '#333';
			}
			var styledMap 	= new google.maps.StyledMapType( styles, { name: "Styled Map" } );
			var map 		= new google.maps.Map( $map[0], options );
			var icon 		= { url: $map_img, size: null, origin: new google.maps.Point( 0, 0 ), anchor: new google.maps.Point( 8, 8 ), scaledSize: new google.maps.Size( 24, 24 ) };
			map.mapTypes.set( 'map_style', styledMap );
			map.setMapTypeId( 'map_style' );
			if ( ! $map.parent( 'div' ).is( 'main' ) ) {
				$map.css( { 'height': $map_height + 'em'} );
			} else {
				function adaptMapH() {
					var sectionH = $map.parent( '#intro' ).height();
					$map.css( { 'height': sectionH } );
				}
				adaptMapH();
				$( window ).resize( adaptMapH );
			}

			/* Markers */
			var infobox_close = 0;
			$.get( "http://api.mellifera.cu.cc/apiaries ", function( apiaries ) {
				$.each( apiaries, function( index, apiary ){
					var contentString 	= '<div class="infobox-inner" style="color: ' + textcolor + ';"><a href="/apiary/edit/' + apiary.id + '">' + apiary.name + '</a></div>';
					var infobox 		= new InfoBox(
						{ 	content: contentString,
							disableAutoPan: false,
							maxWidth: 0,
							zIndex: null,
							boxStyle: { width: "110px" },
							closeBoxURL: "",
							closeBoxMargin: "2px 2px 2px 2px",
							pixelOffset: new google.maps.Size( -55, 35 ),
							infoBoxClearance: new google.maps.Size( 1, 1 )
						} );
					var marker 			= new google.maps.Marker( { position: new google.maps.LatLng( apiary.latitude, apiary.longitude ) , title: apiary.apiary_name, map: map, icon: icon } );
					google.maps.event.addListener( marker, 'click', function () {
						if( infobox_close ) {
							infobox_close = 0;
							infobox.close();
						}else {
							infobox_close = 1;
							infobox.open( map, marker );
						}

					} );
				} );
			} );

			google.maps.event.addDomListener( window, "resize", function () {
				var center = map.getCenter();
				google.maps.event.trigger( map, "resize" );
				map.setCenter( center );
			} );
		} );
	}
	if ( $( '.map' ).length ) {
		googleMap();
	}

</script>
@endif
	</body>
</html>
