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

				m.map.addMarker({
					lat: position.coords.latitude,
					lng: position.coords.longitude
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

		m.getMap().addMarkers(m.getSetting( 'markers' ));
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

	function canvasHeight() {
		//$( m.getSetting( 'el' ) ).css( 'height' )
	}

	m.init = function(settings) {
		m.settings = settings;
		m.geoLocated = false;
		m.map = null;

		canvasHeight();
		initMap();

		$(window).resize(function() {
			canvasHeight();
		});
	},

	m.getSetting = function( key ) {
		return m.settings[key];
	}

	m.getMap = function() {
		return m.map;
	}

	return m;
}