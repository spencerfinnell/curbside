function curbsideApp() {
	var c = {};
	var $ = jQuery;

	c.init = function() {
		$( '.icon-bars' ).click(function(e) {
			console.log( 'wat' );
			e.preventDefault();

			$( '.off-navigation, .site' ).toggleClass( 'open' );
		});
	}

	return c;
}

jQuery(document).ready(function($) {
	var curbside = curbsideApp();

	return curbside.init();
});

function curbsideMap() {
	var m = {};
	var $ = jQuery;

	function initMap() {
		if ( m.getSetting( 'geolocate' ) && ! m.geoLocated ) {
			return initGeoLocate();
		}

		m.map = new GMaps({
			div: m.getSetting( 'el' ),
			lat: m.getSetting( 'lat' ),
			lng: m.getSetting( 'lng' )
		});

		addMarkers();
		drawRoute();

		m.getMap().fitBounds(m.bounds);

		return m.map;
	}

	function initGeoLocate() {
		GMaps.geolocate({
			success: function(position) {
				m.geoLocated = [
					position.coords.latitude,
					position.coords.longitude
				];

				initMap();

				m.addMarker({
					lat: position.coords.latitude,
					lng: position.coords.longitude,
					icon: curbsideSettings.template_path + '/images/current-location.png'
				});

				m.map.setCenter(position.coords.latitude, position.coords.longitude);
			},
			error: function(error) {
				alert('Geolocation failed: ' + error.message);
			},
			not_supported: function() {
				alert("Your browser does not support geolocation");
			}
		});
	}

	function addMarkers() {
		if ( ! m.getSetting( 'markers' ) ) {
			return;
		}

		$.each(m.getSetting( 'markers' ), function(key, value) {
			m.addMarker(value);
		});
	}

	function drawRoute() {
		if ( ! m.getSetting( 'toPlace' ) ) {
			return;
		}

		var routes = m.getMap().getRoutes({
			origin: m.geoLocated,
			destination: m.getSetting( 'toPlace' ),
			travelMode: 'walking',
			callback: function( results ) {
				m.route = new GMaps.Route({
					map: m.getMap(),
              		route: results[0],
					strokeColor: '#131540',
					strokeOpacity: 0.6,
					strokeWeight: 6
				});

				$.each(results[0].legs[0].steps, function() {
					m.route.forward();

					if ( ! m.route.steps[m.route.step_count] ) {
						return;
					}

					$( '.step-list' ).append( '<li class="table-view-cell"><span class="badge">' + m.route.steps[m.route.step_count].distance.text + '</span>' + m.route.steps[m.route.step_count].instructions + '</li>' );
				});

				$( '.distance-to' ).html( results[0].legs[0].distance.text );
			}
		});
	}

	function mapHeight() {
		var map = $( '#map' );

		if ( ! map.length > 0 ) {
			return;
		}

		var windowHeight = $(window).height();
		var contentHeight = $( '.content' ).height();

		/*if ( $( 'body' ).hasClass( 'home' ) ) {
			return map.css( 'height', contentHeight - 25 );
		}*/

		var contentContents = $( '.content > *' );
		var contentContentsHeight = 0;

		var mapHeight = map.outerHeight();

		$.each(contentContents, function() {
			contentContentsHeight += parseInt( $(this).outerHeight() );
		});

		console.log( contentContentsHeight );
		console.log( contentHeight );

		if ( contentContentsHeight < contentHeight ) {
			return map.css( 'height', mapHeight + ( contentHeight - contentContentsHeight ) - 40 );
		}

		var remainingHeight = contentHeight - contentContentsHeight;

		return map.css( 'height', contentHeight - 100 );
	}

	m.init = function(settings) {
		m.settings = settings;
		m.geoLocated = false;
		m.map = null;
		m.bounds = new google.maps.LatLngBounds();

		mapHeight();
		initMap();

		$(window).resize(function() {
			mapHeight();
		});
	},

	m.getSetting = function( key ) {
		return m.settings[key];
	}

	m.getMap = function() {
		return m.map;
	},

	m.addMarker = function(value) {
		var defaults = {
			lat: value.lat,
			lng: value.lng,
			details: value.details,
			click: function(e) {
				if ( value.details.permalink ) {
					window.location.replace( value.details.permalink );
				}
			}
		}

		var settings = $.extend(value, defaults);

		console.log(settings);

		var marker = m.getMap().addMarker(settings);

		m.bounds.extend( new google.maps.LatLng( settings.lat, settings.lng ) );
	}

	return m;
}