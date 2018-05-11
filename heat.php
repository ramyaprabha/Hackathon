<!DOCTYPE html>
<html>
  <head> 
    <meta charset="utf-8">
    <title>Heatmaps</title>
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
      /*#floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }*/
      #floating-panel {
        background-color: #fff;
        border: 1px solid #999;
        left: 42%;
        padding: 5px;
        position: absolute;
        top: 90px;
        z-index: 10;
      }
    </style>
  </head>

    <body style="overflow:hidden;">
      <div id="floating-panel">
        <button onclick="toggleHeatmap()">Toggle Heatmap</button>
        <button onclick="changeGradient()">Change gradient</button>
        <button onclick="changeRadius()">Change radius</button>
        <button onclick="changeOpacity()">Change opacity</button>
      </div>
    <div id="map"></div>
    <script>
    <?php	
        include("processrange.php");
    ?>
    
    var india = {lat: 20.5937, lng: 78.9629};
    

      // This example requires the Visualization library. Include the libraries=visualization
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=visualization">

      var map, heatmap;

      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 5,
          center: {lat: 23.5937, lng: 78.9629}
          //mapTypeId: 'satellite'
        });

        heatmap = new google.maps.visualization.HeatmapLayer({
          data: getPoints(),
          map: map,
          radius: 25
        });
              //Creating the centre button
        var centerControlDiv = document.createElement('div');
        var centerControl = new CenterControl(centerControlDiv, map);

        centerControlDiv.index = 1;
        map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(centerControlDiv);
        
      }

      function toggleHeatmap() {
        heatmap.setMap(heatmap.getMap() ? null : map);
      }

      function changeGradient() {
        var gradient = [
          'rgba(0, 255, 255, 0)',
          'rgba(0, 255, 255, 1)',
          'rgba(0, 191, 255, 1)',
          'rgba(0, 127, 255, 1)',
          'rgba(0, 63, 255, 1)',
          'rgba(0, 0, 255, 1)',
          'rgba(0, 0, 223, 1)',
          'rgba(0, 0, 191, 1)',
          'rgba(0, 0, 159, 1)',
          'rgba(0, 0, 127, 1)',
          'rgba(63, 0, 91, 1)',
          'rgba(127, 0, 63, 1)',
          'rgba(191, 0, 31, 1)',
          'rgba(255, 0, 0, 1)'
        ]
        heatmap.set('gradient', heatmap.get('gradient') ? null : gradient);
      }

      function changeRadius() {
        heatmap.set('radius', heatmap.get('radius')!=20 ? 20 : 40);
      }

      function changeOpacity() {
        heatmap.set('opacity', heatmap.get('opacity') ? null : 0.2);
      }

      // Heatmap data: 500 Points
      function getPoints() {
        return [
         <?php if(mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)){
                echo  "new google.maps.LatLng(".$row["Latitude"].", ".$row["Longitude"]."),";
              }
      }?>
          
        ];
      }
    </script>
    <script src="js/centre.js"></script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAASjCxFqv9Vhmk59ipWgGXOoYf0JIfYJ0&libraries=visualization&callback=initMap">
    </script>
  </body>
  
  <?php include("mainpage2.php"); ?>
    <?php include("menu/rightsidebar2.html"); ?>
</html>