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
    var popup = new mapboxgl.Popup({ closeOnClick: false })
.setLngLat([105.7827015, 21.0382399])
.setHTML(`<p class='title is-5 tool-tip-title'>dd</p>
                <br/>
                  231312332, 12323, 12323
                <br/>
                21323 - 213123
                <img class="note-img" src="https://cdn.24h.com.vn/upload/3-2018/images/2018-09-20/1537376428-892-nu-than-phim-18--khien-trieu-fan-soc-khi-co-y-dinh-nghi-huu-kirara-asuka-1537371671-width660height880.jpg">
                <p class='title is-6' style='margin-bottom: -10px;margin-top:0px;'>Title</p>
                <p>HIHI dm cac ban - <a>Yuki Khiem Nguyen</a></p>
                <div class='tool-bar' >
                  <button type='button' class='button is-success'>
                  <span class='icon is-large'><i class='fa fa-thumbs-up'></i></span>
                   200
                  </button>
                  <button type='button' class='button is-danger'>
                  <span class='icon is-large'><i class='fa fa-thumbs-down'></i></span>
                   200
                  </button>
                  <button type='button' class='button is-info'>
                  <span class='icon is-large'><i class='fa fa-comment'></i></span>
                   200
                  </button>
                </div>
                <button class='button is-primary is-outlined add-btn'>Show 4 more ...</button>
                <button class='button is-primary add-btn'>Add note</button>`)
.addTo(map);
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
