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
.setHTML(`<h5 class='title is-5 tool-tip-title'>Point Title</h5>
            <br/>Point address, misc...
            <br/>21323 - 213123

<div class='card' style='margin-top: 0.5rem; margin-bottom: 0.5rem'>
  <div class='card-image'>
    <figure class='image is-16by9'>
      <img src='https://maps.gstatic.com/tactile/pane/default_geocode-2x.png' alt='Note image'>
    </figure>
  </div>
  <div class='card-content' style='padding: 0.5rem'>
    <div class='media' style='margin-bottom: 0.5rem'>
      <div class='media-content'>
        <p class='title is-6'>Note Title</p>
      </div>
    </div>

    <div class='content' style='margin-bottom: 0.5rem'>
      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      Phasellus nec iaculis mauris.
      <hr/>
      Bởi <a href='#'>Yuki Khiêm</a> (1914 điểm)
      <br/><time datetime='2016-1-1'>11:09 PM - 1 Jan 2016</time>
    </div>
      <div class='tool-bar'>
        <div class='columns' style='margin: 0'>
          <button type='button' class='button is-success is-outlined column action-btn'>
            <span class='icon is-large'><i class='fa fa-thumbs-up'></i></span> 200
          </button>
          <button type='button' class='button is-danger is-outlined column action-btn'>
            <span class='icon is-large'><i class='fa fa-thumbs-down'></i></span> 200
          </button>
          <button type='button' class='button is-info is-outlined column action-btn'>
            <span class='icon is-large'><i class='fa fa-comment'></i></span> 200
          </button>
        </div>
      </div>
  </div>
</div>

            <button class='button is-primary is-outlined add-btn'>Hiện 4 ghi chú khác...</button>
            <button class='button is-primary add-btn'>Thêm ghi chú</button>`)
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

    hr {
        margin: 0.2rem !important;
    }

    #mapid {
        width: 100vw;
        height: 100vh;
    }

    .leaflet-popup-content-wrapper {
      width: 18rem;
    }

    .action-btn {
        padding: 0 !important;
        margin-left: 2px;
    }

    .add-btn {
      width: 100%;
      margin-bottom: 6px;
    }

    .tool-tip-title {
      margin-bottom: 0px !important;
    }

    .tool-bar {
      margin-bottom: 5px;
      width: 100%;
      margin: 0px auto;
      .button {
        //width: 32%;
        margin-bottom: 5px;
          //border-radius: 41px !important;
          i {
            margin-right: 10px;
          }
      }
    }
</style>
