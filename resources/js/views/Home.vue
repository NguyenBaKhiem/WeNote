<template>
      <div id="mapid"></div>
</template>
<script>
export default {
  mounted () {
    var api = 'https://apis.wemap.asia/vector-tiles/styles/osm-bright/style.json?key=ZpIVSmYKNucNvxlHgRFRVBuj';

    var map = new mapboxgl.Map({
        container: 'mapid', // container id
        style: api, // stylesheet location
        center: [105.7827015, 21.0382399],  // starting position [lon, lat]
        zoom: 16 // starting zoom
    });

    map.addControl(
        new MapboxDirections({
            accessToken: 'ZpIVSmYKNucNvxlHgRFRVBuj',
            geocoder: {
                // api: 'https://apis.wemap.asia/geocode-1/search?key=ZpIVSmYKNucNvxlHgRFRVBuj&'
            },
            styles: [],
        }),
        'top-left',

    );
  }
}
</script>
<style lang="scss">
    * {
        margin: 0;
        padding: 0;
    }

    #mapid {
        width: 100vw;
        height: 100vh;
    }
    .leaflet-popup-content-wrapper {
      width: 16rem;
    }
    .add-btn {
      width: 100%;
      margin-bottom: 6px;
    }
    .note-img {
      width: 100%;
      height: 200px;
    }
    .tool-tip-title {
      margin-bottom: 0px !important;
    }
    .tool-bar {
      margin-bottom: 5px;
      width: 100%;
      margin: 0px auto;
      .button {
        width: 32%;
        margin-bottom: 5px;
          //border-radius: 41px !important;
          i {
            margin-right: 10px;
          }
      }
    }
</style>
