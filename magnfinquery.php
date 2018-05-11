<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0" />
    <style type="text/css">
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
// START of SCRIPT.
        //Connecting to the database.
       <?php	
            include("processrange.php");?>
       var magnit = [<?php if(mysqli_num_rows($result1) > 0) {
	   while($row = mysqli_fetch_assoc($result1)){
		echo "" . $row["Magnitude - (Richter scale)"] . ","; 
		    }
       }?>];
        var india = {lat: 26.5937, lng: 78.9629};
      function initMap() {

          //Creating the MAP
        var map = new google.maps.Map(document.getElementById('map'), {
          center: india,
          zoom: 5
        });

        //Creating the centre button.
        var centerControlDiv = document.createElement('div');
        var centerControl = new CenterControl(centerControlDiv, map);

        centerControlDiv.index = 1;
        map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(centerControlDiv);


        //Storing the lat and lng of earthquakes in locations.
        var locations = [<?php if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)){
                    echo "[" . $row["Latitude"] .", " . $row["Longitude"] . "],";
                }
        }?>];   


        //Creating the Markers
        var a;
        var b;
        var c;
        for(j=0;j<locations.length;j++){
            var loc = locations[j];
            if(magnit[j]>=7.5 && magnit[j]<=8.4){
            a = 70;
            b ="#ff0000";
            c = 0.8;
          }
          else if(magnit[j]>=6.5 && magnit[j]<=7.4){
            a = 80;
            b = "#ff3333";
            c = 0.7;
          }
          else if(magnit[j]>=5.5 && magnit[j]<=6.4){
            a = 50;
            b = "#ff6666";
            c = 0.6;
          }
          else if(magnit[j]>=4.5 && magnit[j]<=5.4){
            a = 25;
            b = "#ff8080";
            c = 0.5;
          }
          else if(magnit[j]>=3.5 && magnit[j]<=4.4){
            a = 15;
            b = "#ffb3b3";
            c = 0.4;
          }
          else if(magnit[j]>=2.5 && magnit[j]<=3.4){
            a = 8;
            b = "#ffcccc";
            c = 0.3;
          }
          else if(magnit[j]>=1.5 && magnit[j]<=2.4){
            a = 5;
            b = "#ffe6e6";
            c = 0.2;
          }
          else {
              a = 3;
              b = "#00ff80";
              c = 0.1;
              };
            var marking = new google.maps.Marker({
            position: {lat: loc[0], lng: loc[1]},
            icon: {
              path: google.maps.SymbolPath.CIRCLE,
              scale: a,
              fillColor: b,
              fillOpacity: 0.5,
              strokeWeight: 0
            }, 
            map: map
            })
        }   
      }

// End of the SCRIPT.

    </script>

    <script src="js/centre.js">
    </script>

    <script src="js/cluster.js">
    </script>

    <script async defer
         src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAASjCxFqv9Vhmk59ipWgGXOoYf0JIfYJ0&callback=initMap"></script>
    <?php include("mainpage2.php"); ?>
    <?php include("menu/rightsidebar3.html");?>
  </body>
</html>