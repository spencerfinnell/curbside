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
					//icon: 'images/current-location.png',
				});
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

	function canvasHeight() {
		if ( $(window).height() < 600 ) {
			$( m.getSetting( 'el' ) ).css( 'height', 'auto' );
		}
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
	},

	m.drawRoute = function( destination ) {
		m.getMap().drawRoute({
			origin: m.getLocated,
			destination: destination,
			travelMode: 'walking',
			strokeColor: '#131540',
			strokeOpacity: 0.6,
			strokeWeight: 6
		});
	}

	return m;
}