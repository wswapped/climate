<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://js.arcgis.com/4.6/esri/css/main.css">
<style>
  html, body, #viewDiv {
    padding: 0;
    margin: 0;
    height: 100%;
    width: 100%;
  }
</style>
<script src="https://js.arcgis.com/4.6/"></script>
<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
<title>Intro to MapView - Create a 2D map</title>
</head>
<body>
	<div id="viewDiv"></div>
	<script>
	require([
	  "esri/Map",
	  "esri/views/MapView",
	  "esri/views/SceneView",
	  "dojo/domReady!"
	], function(Map, MapView) {
	  // Code to create the map and view will go here
	  var map = new Map({
	    basemap: "satellite"
	  });

	  //Loading the view
	  var view = new MapView({
	    container: "viewDiv",  // Reference to the DOM node that will contain the view
	    map: map               // References the map object created in step 3
	  });
	});

	
	</script>
</body>
</html>