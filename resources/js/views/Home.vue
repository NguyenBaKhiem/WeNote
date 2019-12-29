<template>
      <div id="map"></div>
</template>
<script>
export default {
  mounted () {
    // API stylesheet location of wemap

    var map = new mapboxgl.Map({
        container: 'map', // container id
        style: process.env.MIX_MAP_API, // stylesheet location
        center: [105.7827015, 21.0382399],  // starting position [lon, lat]
        zoom: 16 // starting zoom
    });

    ///**** YOUR CODE HERE ****///
  }
}
</script>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    #map {
        width: 100vw;
        height: 100vh;
    }
</style>
