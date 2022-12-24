<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
        <div class="card-white pd-30 height-100-p">
            <h2 class="mb-30 h4">Tracking Location</h2>
            <div id="map" style="width:100%!important; height:380px"></div>
            <br>
            <p><b>Informasi pelabuhan terakhir yang dilewati: </b>{{ $pelabuhan }}</p>
            {{-- <div class="pb-20">
                <table class="data-table table hover multiple-select-row nowrap">
                    <thead>
                        <tr class="table-primary">
                            <th class="table-plus datatable-nosort">Date & Time</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mqtt_history as $data)
                        <tr>
                            <td class="table-plus">{{ $data->value['TIME_STR'] }}</td>
                            <td>{{ $data->value['LAT_STRING'] }}</td>
                            <td>{{ $data->value['LON_STRING'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> --}}
        </div>
    </div>
</div>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=geometry"></script>

    <script type="text/javascript">
        var line;

        var map;
        var pointDistances;

        function initialize() {
            var mapOptions = {
                center: new google.maps.LatLng({{ $mqtt->value['GPS'] }}),
                zoom: 6,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById('map'), mapOptions);

            // var myLatLng = {lat: {{ $mqtt->value['LAT_STRING'] }}, lng: {{ $mqtt->value['LON_STRING'] }}};

            // var marker = new google.maps.Marker({
            //    position: myLatLng,
            //    map: map,
            //    title: 'Hello World!'
            // });
            var lineCoordinates = [
                // new google.maps.LatLng({{ $start->value['GPS'] }}),
                // new google.maps.LatLng(-5.196338676, 112.733549861),
                // new google.maps.LatLng({{ $mqtt->value['GPS'] }})
                @foreach ($mqtt_history as $data)
                    new google.maps.LatLng({{ $data->value['GPS'] }}),
                @endforeach
            ];

            map.setCenter(lineCoordinates[0]);

            // point distances from beginning in %
            var sphericalLib = google.maps.geometry.spherical;

            pointDistances = [];
            var pointZero = lineCoordinates[0];
            var wholeDist = sphericalLib.computeDistanceBetween(
                pointZero,
                lineCoordinates[lineCoordinates.length - 1]);

            for (var i = 0; i < lineCoordinates.length; i++) {
                pointDistances[i] = 100 * sphericalLib.computeDistanceBetween(
                    lineCoordinates[i], pointZero) / wholeDist;
                    console.log('pointDistances[' + i + ']: ' + pointDistances[i]
                );
            }

            // define polyline
            var lineSymbol = {
                path: google.maps.SymbolPath.CIRCLE,
                scale: 6,
                strokeColor: '#393'
            };

            line = new google.maps.Polyline({
                path: lineCoordinates,
                strokeColor: '#FF0000',
                strokeOpacity: 2.0,
                strokeWeight: 5,
                icons: [{
                    icon: lineSymbol,
                    offset: '100%'
                }],
                map: map
            });

            animateCircle();
        }

        var id;

        function animateCircle() {
            console.log();
            var startBlue = new google.maps.LatLng({{ $start->value['GPS'] }});
            var endBlue = new google.maps.LatLng({{ $mqtt->value['GPS'] }});
            var count = 0;
            var offset;
            var sentiel = -1;

            id = window.setInterval(function() {
                count = (count + 1) % 200;
                offset = count / 2;

                for (var i = pointDistances.length - 1; i > sentiel; i--) {
                    if (offset > pointDistances[i]) {
                        console.log('create marker');
                        var marker = new google.maps.Marker({
                            icon: {
                                url: "https://maps.gstatic.com/intl/en_us/mapfiles/markers2/measle_red.png",
                                size: new google.maps.Size(7, 7),
                                anchor: new google.maps.Point(4, 4)
                            },
                            position: line.getPath().getAt(i),
                            title: line.getPath().getAt(i).toUrlValue(6),
                            map: map
                        });

                        sentiel++;
                        break;
                    }
                }

                // we have only one icon
                var icons = line.get('icons');
                icons[0].offset = (offset) + '%';
                line.set('icons', icons);

                if (line.get('icons')[0].offset == "99.5%") {
                    icons[0].offset = '100%';
                    line.set('icons', icons);
                    window.clearInterval(id);
                }
            }, 20);

            new google.maps.Marker({
                position: startBlue,
                map: map
            });

            // mebuat konten untuk info window
            var contentString = '<h6>Lokasi Terkini</h6><br><span><b>{{ $mqtt->value['GPS'] }}</b></span>';

             // membuat objek info window
             var infowindow = new google.maps.InfoWindow({
                content: contentString,
                position: endBlue
            });

            var marker = new google.maps.Marker({
                position: endBlue,
                map: map,
                title: 'Lokasi Terkini'
            });

            // event saat marker diklik
            marker.addListener('click', function() {
                // tampilkan info window di atas marker
                infowindow.open(map, marker);
            });
        }

    google.maps.event.addDomListener(window, 'load', initialize);
    </script>
