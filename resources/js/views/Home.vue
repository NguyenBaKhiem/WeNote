<template>
      <div id="mapid"></div>
</template>
<script>
export default {
  mounted () {
    var api = `https://apis.wemap.asia/raster-tiles/styles/osm-bright/{z}/{x}/{y}@2x.png?key=${process.env.MIX_MAP_API_KEY}`
    //starting position [lat, lon] , zoom int
    var map = L.map('mapid').setView([21.0382399, 105.7827015], 16)

    L.tileLayer(api, {
        attribution: 'Map data &copy; <a href="https://wemap.asia/">WeMap</a>',
        maxZoom: 20,
    }).addTo(map)

    //API Search of WeMap
    let apiSearch = "https://apis.wemap.asia/geocode-3/api?key=ZpIVSmYKNucNvxlHgRFRVBuj&location_bias_scale=2&limit=15&"

    //Add photon search in map
    L.control.photon({
        url: apiSearch,
        resultsHandler: myHandler,
        placeholder: 'Search Here …',
        position: 'topleft'
    }).addTo(map)

    function myHandler(geojson) {
        console.log(geojson);
    };

    //API Reverse of WeMap
    var apiReverse = "https://apis.wemap.asia/we-tools/reverse?key=ZpIVSmYKNucNvxlHgRFRVBuj&"

    //Add event click on map an call API Reverse
    map.on('click', function (point) {
        var popLocation = point.latlng;
        console.log(popLocation);
        $.ajax({
            url: `${apiReverse}lat=${popLocation.lat}&lon=${popLocation.lng}`,
            type: 'GET',
            dataType: 'json',
        }).done(function (ketqua) {
            console.log(ketqua)
            var popup = L.popup()
                .setLatLng(popLocation)
                .setContent(`<p class='title is-5 tool-tip-title'>${ketqua['features'][0]['properties']['name']}</p>
                                <br/>
                                  ${ketqua['features'][0]['properties']['street']}, ${ketqua['features'][0]['properties']['district']}, ${ketqua['features'][0]['properties']['city']}
                                <br/>
                                ${popLocation.lng.toFixed(10)} - ${popLocation.lat.toFixed(10)}
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
                .openOn(map);
            $(this).addClass("done");
        });

    });
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
