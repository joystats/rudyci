<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Bangsue Restaurants</title>
<link rel="stylesheet" href="<?=base_url();?>css/style.css"/>
<script src="<?=base_url();?>js/map.js"></script>
</head>
<body>
	<div id="map"></div>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBY6xKIPtyEp3smE8us-pRWEYJq8vO-rI4&libraries=places&callback=initMap" async defer></script>
</body>
</html>
