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
        margin-top: 100px;
        margin-left: 50px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 650px;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body style="overflow:hidden;">
    <div id="map"></div>

    <script>
    <?php	
    $connect=mysqli_connect('localhost','root','rameena123','test'); 
    if(mysqli_connect_errno($connect))
    {
            echo 'Failed to connect';
    }
    $result = mysqli_query($connect, "SELECT e.`LAT`,e.`LNG` FROM liveeq AS e") or die(mysqli_error($connect)); 
    $result1 = mysqli_query($connect, "SELECT e.`DATE`,e.`LAT`,e.`LNG` FROM liveeq AS e "); ?>
          var dat = [<?php if(mysqli_num_rows($result1) > 0) {
              while($row = mysqli_fetch_assoc($result1)){
                echo "'Date is " . $row["DATE"] . "',";
              }
      }?>];

      <?php $result2 = mysqli_query($connect,"SELECT * FROM liveeq");?>
       var tim = [<?php if(mysqli_num_rows($result2) > 0) {
	   while($row = mysqli_fetch_assoc($result2)){
		echo "'TIME = " . $row["TIME"] . "',"; 
		    }
       }?>];
       <?php $result3 = mysqli_query($connect,"SELECT * FROM liveeq");?>
       var dep = [<?php if(mysqli_num_rows($result3) > 0) {
	   while($row = mysqli_fetch_assoc($result3)){
		echo "'DEPTH=" . $row["Depth"] . "',"; 
		    }
       }?>];
       <?php $result4 = mysqli_query($connect,"SELECT * FROM liveeq");?>
       var magnit = [<?php if(mysqli_num_rows($result4) > 0) {
	   while($row = mysqli_fetch_assoc($result4)){
		echo "'" . $row["Magnitude"] . "',"; 
		    }
       }?>];
       var india = {lat: 20.5937, lng: 78.9629};
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
        function popupMarker(location, i) {
          var m = new google.maps.Marker({
            position: location,
          });
            var temp = m.getPosition();   
              google.maps.event.addListener(m, 'click', function() {
              infowindow.setContent('<div><strong>Details of the earthquake:  </strong></div><br>'+ dat[i] + '<br>' + tim[i] + '<br>(Lat °N,Lng °E) = '+ temp + '<br>The Depth =' + dep[i] + '<br>' + 'Magnitude = '+ magnit[i]);
              infowindow.open(map, this);
              if (m.getAnimation() !== null) {
                m.setAnimation(null);
              } else {
                m.setAnimation(google.maps.Animation.BOUNCE);
              }
            });
          return m;
        }
        var markers = locations.map(popupMarker);
        // Add a marker clusterer to manage the markers.
        var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
      }
          var locations = [<?php if(mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)){
                echo "{lat: " . $row["LAT"] .", lng: " . $row["LNG"] . "},";
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
    <?php include("legend.html"); ?>
    <?php include("mainpage2.php");?>
  </body>
</html>