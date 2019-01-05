<html>

<head>
  <meta charset="UTF-8">
  <title>Earthquake Spots</title>
  <link rel="stylesheet"  href="//cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.2/leaflet.css"/>
  <script type="text/javascript"  src="//cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.2/leaflet.js"> </script>
  <script type="text/javascript" src="//cdn.aerisjs.com/aeris.min.js"></script>
</head>

<body>

<div  id="map-canvas" style="width: auto; height: 800px;"></div>

<script type="text/javascript">
var map;

// Don't forget your API keys!

aeris.config.set({
apiId: '7yfh0mmZNda2MWCA7CmW2',
apiSecret:  '7jKOA70a3Ni8wD21oo2qwh9PUY8RYLrsC9OTLAB8'
});

//  Create an Aeris map

map=new aeris.maps.Map('map-canvas');

var earthquakeMarkers = new aeris.maps.markercollections.EarthquakeMarkers();

earthquakeMarkers.setMap(map);
earthquakeMarkers.fetchData();

map.on('change:bounds', function() {
    // Update the query parameters for the Aeris API request,
    // limited the search to the bounds of the map viewport
    earthquakeMarkers.setParams({
        p: map.getBounds()
    });
    earthquakeMarkers.fetchData();
});


// Render earthquake data on click
earthquakeMarkers.on('click', function(latLon, marker) {
    var infoBox = new aeris.maps.InfoBox({
        position: latLon,
        content: myTemplate(marker.getData().toJSON())
    });
    infoBox.setMap(map);
});

</script>

</body>

</html>