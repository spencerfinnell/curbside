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
					lng: position.coords.longitude,
					//icon: curbsideSettings.template_path + '/images/current-location.png',
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

		$.each(m.getSetting( 'markers' ), function(key, coords) {
			console.log(m.getMap());
			m.map.addMarker({
				lat: coords.lat,
				lng: coords.lng,
				//icon: 'images/current-location.png',
			});
		});
	}

	function drawRoute() {
		if ( ! m.getSetting( 'toPlace' ) ) {
			return;
		}

		/*m.getMap().drawRoute({
			origin: m.geoLocated,
			destination: m.getSetting( 'toPlace' ),
			travelMode: 'walking',
			strokeColor: '#131540',
			strokeOpacity: 0.6,
			strokeWeight: 6
		});

		console.log(m.geoLocated, m.getSetting( 'toPlace' ));*/

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
				});

				m.getMap().fitZoom();

				$( '.distance-to' ).html( results[0].legs[0].distance.text );
			}
		});

		//m.distanceTo = m.getMap().geometry.spherical.computeDistanceBetween( m.geoLocated, m.getSetting( 'toPlace' ) );

		//console.log( m.distanceTo );
	}

	function canvasHeight() {

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