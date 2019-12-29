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
                .setContent(`<p>${ketqua['features'][0]['properties']['name']}<br />
                                ${popLocation.lat.toFixed(3)}, ${popLocation.lng.toFixed(3)}
                                <button class='button is-primary is-outlined'>Add note</button>`)
                .openOn(map);
            $(this).addClass("done");
        });

    });
  }
}
</script>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    #mapid {
        width: 100vw;
        height: 100vh;
    }
</style>
