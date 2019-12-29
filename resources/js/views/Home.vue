<template>
    <div id="mapid"></div>
</template>
<script>
    export default {
        mounted() {
            var api = 'https://apis.wemap.asia/vector-tiles/styles/osm-bright/style.json?key=ZpIVSmYKNucNvxlHgRFRVBuj';

            var map = new mapboxgl.Map({
                container: 'mapid', // container id
                style: api, // stylesheet location
                center: [105.7827015, 21.0382399],  // starting position [lon, lat]
                zoom: 16 // starting zoom
            });
            var directions = new MapboxDirections({
                accessToken: 'ZpIVSmYKNucNvxlHgRFRVBuj',
                geocoder: {
                    // api: 'https://apis.wemap.asia/geocode-1/search?key=ZpIVSmYKNucNvxlHgRFRVBuj&'
                },
                styles: [],
            });
            map.addControl(
                directions
                ,
                'top-left',
            );
            map.on('load', function () {

                // Listen for the `directions.route` event that is triggered when a user
                // makes a selection and add a symbol that matches the result.
                directions.on('route', function (ev) {
                    [...document.getElementsByClassName('mapboxgl-popup-close-button')].forEach(i=> i.click())
                    axios.post('/api/get-notes-from-path', {routes: ev.route[0].legs[0].steps.map(step => step.name)}).then(res => {
                        res.data.data.forEach(item => {
                            let hihi = new mapboxgl.Popup({closeOnClick: false})
                                .setLngLat([item.longitude, item.latitude])
                                .setHTML(`
            <h5 class='title is-5 tool-tip-title' style='margin-bottom: 0.5rem !important;'>
                ${generateStyle(item.style)}
                ${item.name}
            </h5>
            ${item.street || '?'}, ${item.district || '?'}, ${item.city || '?'}, ${item.country || '?'}

            <div class='card' style='margin-top: 0.5rem; margin-bottom: 0.5rem'>
                <div class='card-image'>
                    <figure class='image is-16by9'>
                        <img src='${item.image || 'https://maps.gstatic.com/tactile/pane/default_geocode-2x.png'}' alt='Note image'>
                    </figure>
                </div>
                <div class='card-content' style='padding: 0.5rem'>
                    <div class='media' style='margin-bottom: 0.5rem'>
                        <div class='media-content'>
                            <p class='title is-6'>${item.title}</p>
                        </div>
                    </div>

                    <div class='content' style='margin-bottom: 0.5rem'>
                        ${item.description}
                        <hr/>
                        Bởi <a href='#'>${item.full_name}</a> (${item.points} <i class='fa fa-star-o'></i>)
                        <br/><time datetime='2016-1-1'>${item.created_at || ''}</time>
                    </div>
                    <div class='tool-bar'>
                        <div class='columns' style='margin: 0'>
                            <button type='button' class='button is-success is-outlined column action-btn'>
                                <span class='icon is-large'><i class='fa fa-thumbs-up'></i></span> ${countVoteUp(item.comments)}
                            </button>
                            <button type='button' class='button is-danger is-outlined column action-btn'>
                                <span class='icon is-large'><i class='fa fa-thumbs-down'></i></span> ${countVoteDown(item.comments)}
                            </button>
                            <button type='button' class='button is-info is-outlined column action-btn'>
                                <span class='icon is-large'><i class='fa fa-comment'></i></span> ${item.comments.length}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <button class='button is-primary add-btn'>Thêm ghi chú</button>
                            `).addTo(map)
                        })
                    })
                })
            });

            function syntaxHighlight(json) {
                json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
                    var cls = 'number';
                    if (/^"/.test(match)) {
                        if (/:$/.test(match)) {
                            cls = 'key';
                        } else {
                            cls = 'string';
                        }
                    } else if (/true|false/.test(match)) {
                        cls = 'boolean';
                    } else if (/null/.test(match)) {
                        cls = 'null';
                    }
                    return '<span class="' + cls + '">' + match + '</span>';
                });
            }

            function generateStyle(style) {
                var icon;
                switch (style) {
                    case 'success':
                        icon = 'fa fa-map-marker';
                        break;
                    case 'warning':
                        icon = 'fa fa-map-marker';
                        break;
                    case 'danger':
                        icon = 'fa fa-map-marker';
                        break;
                    default:
                        icon = 'fa fa-map-marker';
                        break;
                }

                return `<span class='icon has-text-${style}'><i class='${icon}'></i></span>`;
            }

            function countVoteUp(comments) {
                var count = 0;
                for (var i = 0; i < comments.length; i++) {
                    if (comments[i].is_up == 1) count++;
                }
                return count;
            }

            function countVoteDown(comments) {
                var count = 0;
                for (var i = 0; i < comments.length; i++) {
                    if (comments[i].is_up == 0) count++;
                }
                return count;
            }
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
        margin-left: 0.1rem;
    }

    .add-btn {
        width: 100%;
    }

    .tool-bar {
        margin-bottom: 5px;
        width: 100%;
        margin: 0px auto;

        .button {
            margin-bottom: 5px;
            i {
                margin-right: 10px;
            }
        }
    }
</style>
