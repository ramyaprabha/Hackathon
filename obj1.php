<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Marker Clustering</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 650px;
        margin-top:100px;
        margin-left:50px;
        
        
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 650px;   
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
    <?php	
    $connect=mysqli_connect('localhost','root','rameena123','test'); 
    if(mysqli_connect_errno($connect))
    {
            echo 'Failed to connect';
    }
    $result = mysqli_query($connect, "SELECT e.`Latitude`,e.`Longitude` FROM obj AS e");
    
    ?>
    var india = {lat: 20.5937, lng: 78.9629};
    
      <?php
      $result1 = mysqli_query($connect, "SELECT * FROM obj"); ?>
          var station = [<?php if(mysqli_num_rows($result1) > 0) {
              while($row = mysqli_fetch_assoc($result1)){
                echo "'Station name is " . $row["Station"] . "',";
              }
      }?>];

      <?php $result2 = mysqli_query($connect,"SELECT * FROM obj");?>
       var dist = [<?php if(mysqli_num_rows($result2) > 0) {
	   while($row = mysqli_fetch_assoc($result2)){
		echo "'District is " . $row["District"] . "',"; 
		    }
       }?>];
       <?php $result3 = mysqli_query($connect,"SELECT * FROM obj");?>
       var state = [<?php if(mysqli_num_rows($result3) > 0) {
	   while($row = mysqli_fetch_assoc($result3)){
		echo "'State is " . $row["State"] . "',"; 
		    }
       }?>];
      function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 5,
          center: india
        });
        var infowindow = new google.maps.InfoWindow();
        //Creating the centre button
        var centerControlDiv = document.createElement('div');
        var centerControl = new CenterControl(centerControlDiv, map);

        centerControlDiv.index = 1;
        map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(centerControlDiv);

        // Create an array of alphabetical characters used to label the markers.
        // var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        function hi(location, i) {
          var m = new google.maps.Marker({
            position: location,
           // label: labels[i % labels.length]
          });
          var temp = m.getPosition();   
          google.maps.event.addListener(m, 'click', function() {
              infowindow.setContent('<div><strong>Details of the Observatory:  </strong></div><br>'+ station[i] + '<br>' + state[i] + '<br>' + dist[i] +  '<br>(Lat °N,Lng °E) = '+ temp );
              infowindow.open(map, this);
              if (m.getAnimation() !== null) {
                m.setAnimation(null);
              } else {
                m.setAnimation(google.maps.Animation.BOUNCE);
              }
            });
            m.setIcon('icon/map-marker-20 (2).png');
            
          return m;
        }
        // Add some markers to the map.
        // Note: The code uses the JavaScript Array.prototype.map() method to
        // create an array of markers based on a given "locations" array.
        // The map() method here has nothing to do with the Google Maps API.
        var markers = locations.map(hi);
        // Add a marker clusterer to manage the markers.
        var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
      }
          var locations = [<?php if(mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)){
                echo "{lat: " . $row["Latitude"] .", lng: " . $row["Longitude"] . "},";
              }
      }?>];
    </script>
    <script src="js/centre.js">
    </script>
    <script src="js/cluster.js">
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAASjCxFqv9Vhmk59ipWgGXOoYf0JIfYJ0&callback=initMap">
    </script>
    <?php include("mainpage2.php");?>
  </body>
</html>