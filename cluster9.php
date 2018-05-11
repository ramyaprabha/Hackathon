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
        margin-right:290px;
        
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
      include("processrange.php");
    ?>
    var india = {lat: 20.5937, lng: 78.9629};      
      var mag = [<?php if(mysqli_num_rows($result1) > 0) {
        while($row = mysqli_fetch_assoc($result1)){
          echo "'" . $row["Depth"] . "',";
        }
      }?>];

      
       var date = [<?php if(mysqli_num_rows($result2) > 0) {
	   while($row = mysqli_fetch_assoc($result2)){
		echo "'Date=" . $row["day"] . "-" . $row["Month"] . "-" . $row["Year"] . "',"; 
		    }
       }?>];
       
       var time = [<?php if(mysqli_num_rows($result3) > 0) {
	   while($row = mysqli_fetch_assoc($result3)){
		echo "'Time=" . $row["Origin-TIME (UTC) - hr"] . "\:" . $row["Origin-TIME (UTC) - min"] . "\:" . $row["Origin-TIME (UTC) - sec"] . "',"; 
		    }
       }?>];
       
       var magnit = [<?php if(mysqli_num_rows($result4) > 0) {
	   while($row = mysqli_fetch_assoc($result4)){
		echo "'" . $row["Magnitude - (Richter scale)"] . "',"; 
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
            title: 'Depth is '+mag[i].toString(),
           // label: labels[i % labels.length]
          });
          if(magnit[i]>=7.5 && magnit[i]<=8.4){
            m.setIcon('http://maps.google.com/mapfiles/ms/icons/red-dot.png');
          }
          else if(magnit[i]>=6.5 && magnit[i]<=7.4){
            m.setIcon('http://individual.icons-land.com/IconsPreview/MapMarkers/PNG/Centered/32x32/MapMarker_Marker_Outside_Blue.png');
          }
          else if(magnit[i]>=5.5 && magnit[i]<=6.4){
            m.setIcon('http://maps.google.com/mapfiles/ms/icons/orange-dot.png');
          }
          else if(magnit[i]>=4.5 && magnit[i]<=5.4){
            m.setIcon('http://maps.google.com/mapfiles/ms/icons/green-dot.png');
          }
          else if(magnit[i]>=3.5 && magnit[i]<=4.4){
            m.setIcon('http://maps.google.com/mapfiles/ms/icons/yellow-dot.png');
          }
          else if(magnit[i]>=2.5 && magnit[i]<=3.4){
            m.setIcon('http://maps.google.com/mapfiles/ms/icons/blue-dot.png');
          }
          else if(magnit[i]>=1.5 && magnit[i]<=2.4){
            m.setIcon('http://maps.google.com/mapfiles/ms/icons/purple-dot.png');
          }
          else m.setIcon('http://maps.google.com/mapfiles/ms/icons/pink-dot.png');

          var temp = m.getPosition();   
          google.maps.event.addListener(m, 'click', function() {
              infowindow.setContent('<div><strong>Details of the earthquake:  </strong></div><br>'+ date[i] + '<br>' + time[i] + '<br>(Lat °N,Lng °E) = '+ temp + '<br>The Depth =' + mag[i] + 'km<br>' + 'Magnitude = '+ magnit[i]);
              infowindow.open(map, this);
              if (m.getAnimation() !== null) {
                m.setAnimation(null);
              } else {
                m.setAnimation(google.maps.Animation.BOUNCE);
              }
            });
            
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
    <script src="js/centre.js"></script>
    <script src="js/cluster.js">
    </script>
    <script async defe
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAASjCxFqv9Vhmk59ipWgGXOoYf0JIfYJ0&callback=initMap">
    </script>
    
    <?php include("mainpage2.php");?>
    <?php include("menu/rightsidebar.html"); ?>
    <?php include("menu/legend.html");?>
    
    </body>
</html>