<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!DOCTYPE html>
<html>
  <head>
    <title>Pick Location</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
        .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARu2nhezWBGpNr3dTmEXKoJZ6b5Lj4D7I&libraries=places&callback=initMap" async defer></script>
  </head>
  <body>
    <input id="pac-input" class="controls" type="text" placeholder="Search Box">
    <div id="map"></div>
    <script>
      var map;
      var marker;
      var infoWindow;
      var latitude = 3.6426183;
      var longitude = 98.529061;
      function initMap() {
        myLatLng = {lat: latitude, lng: longitude};

        map = new google.maps.Map(document.getElementById('map'), {
          center: myLatLng,
          zoom: 12
        });
        marker = new google.maps.Marker({
          map: map,
          position: myLatLng,
          draggable: true,
          animation: google.maps.Animation.DROP,
        });

        google.maps.event.addListener(map, 'click', handleListener);
        marker.addListener('dragend', handleListener);

        infowindow = new google.maps.InfoWindow();

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            handleListener(place.geometry)

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
      }

      function handleListener(event)
      {
        if (event.latLng) {
          marker.setPosition(event.latLng);
          newLat = event.latLng.lat();
          newLng = event.latLng.lng();
        } else if (event.location) {
          marker.setPosition(event.location);
          newLat = event.location.lat();
          newLng = event.location.lng();
        }
        newLat = newLat.toFixed(6);
        newLng = newLng.toFixed(6);
        $.ajax({
          url: "https://maps.googleapis.com/maps/api/geocode/json",
          method: "GET",
          data: {latlng: newLat +","+ newLng , key: "AIzaSyARu2nhezWBGpNr3dTmEXKoJZ6b5Lj4D7I"}
        })
        .done (function(data) {
          address = data.results[0].formatted_address;
          content = "<b>Jalan</b> : " + address +
            "<br><b>Latitude</b> : " + newLat +
            "<br><b>Longitude</b> : " + newLng +
            "<br><div style='float:right'><button type='button' onclick='sendDataToParent("+newLat+", "+newLng+")'>Pick This Location</div>";
          infowindow.setContent(content);
          infowindow.open(map, marker);
        });
      }

      function sendDataToParent(lat,lng)
      {
        window.opener.receiver(lat, lng);
      }
    </script>
  </body>
</html>

