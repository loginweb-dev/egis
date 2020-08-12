<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Panel</title>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <!-- Bootstrap core CSS -->
        <link href="{{ asset('vendor/mdb/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="{{ asset('vendor/mdb/css/mdb.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('vendor/mdb/css/addons-pro/timeline.min.css') }}">
        <style type="text/css">
        #map {
            height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        </style>
        @laravelPWA
    </head>
    <body>
        
        <div id="style-selector-control" class="map-control">
            <div class="md-form input-group">
                <input id="mytext" type="text" class="form-control" placeholder="Ingresa tu Busqueda" aria-label="Ingresa tu Busqueda" aria-describedby="MaterialButton-addon2">
                <div class="input-group-append">
                    <button class="btn btn-md btn-primary" type="button" id="myboton">Buscar</button>
                </div>
                <hr />
                <div id="right-panel"></div>
            </div>
        </div>
        <div id="map"></div>

          <!--  JQuery  -->
  <script type="text/javascript" src="{{ asset('vendor/mdb/js/jquery-3.4.1.min.js') }}"></script>
  <!--  Bootstrap tooltips  -->
  {{--  <script type="text/javascript" src="{{ asset('vendor/mdb/popper.min.js') }}"></script>  --}}
  <!--  Bootstrap core JavaScript  -->
  {{--  <script type="text/javascript" src="{{ asset('vendor/mdb/bootstrap.min.js') }}"></script>  --}}
  <!--  MDB core JavaScript  -->
  {{--  <script type="text/javascript" src="{{ asset('vendor/mdb/js/mdb.min.js') }}"></script>  --}}

        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnHV6QtGETar9olguruwVjjcDAFhrV-sg&callback=initMap&libraries=&v=weekly" defer></script>

        <script>
            let map, infoWindow, marker, mylat, mylng;
            let labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            let labelIndex = 0;
            let directionsRenderer, directionsService;
            function initMap() {
                //----------------------------- Directions ------------------
                directionsRenderer = new google.maps.DirectionsRenderer();
                directionsService = new google.maps.DirectionsService();
                //-------------------------------------------------------------


                //------------------  MAPA --------------------------------------
                //----------------------------------------------------------------
                map = new google.maps.Map(document.getElementById("map"), {
                    center: { lat: -34.397, lng: 150.644 },
                    zoom: 14
                });
                infoWindow = new google.maps.InfoWindow();
                directionsRenderer.setMap(map);
                //----------------------MAPA-----------------------------------------


                navigator.geolocation.getCurrentPosition(function (position) {
                    mylat = position.coords.latitude;
                    mylng = position.coords.longitude;

                    var geolocpoint = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    map.setCenter(geolocpoint);

                    const contentString =
                        '<strong>{{ Auth::user()->name }}</strong>';

                    const infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });

                    //--------------------------MARK--------------------------------
                    marker = new google.maps.Marker({
                        map,
                        //draggable: true,
                        animation: google.maps.Animation.DROP,
                        position: { lat: position.coords.latitude, lng: position.coords.longitude },
                        label: labels[labelIndex++ % labels.length],
                    });

                    infowindow.open(map, marker);

                    marker.addListener("click", function(){
                        marker.setAnimation(google.maps.Animation.BOUNCE);
                    });

                    marker.addListener("click", () => {
                        infowindow.open(map, marker);
                    });
                    //--------------------------MARK------------------------------------

                   
                    
                }, function (e) {
                    //Your error handling here
                }, {
                    enableHighAccuracy: true
                });
               



                //----------------------- Buscador ---------------------------------
                //-------------------------------------------------------------------
                const styleControl = document.getElementById("style-selector-control");
                map.controls[google.maps.ControlPosition.TOP_CENTER].push(styleControl);
                document.getElementById("myboton").addEventListener("click", () => {
                     map.setZoom(14);
                    var busvar =  document.getElementById("mytext").value;
                    var urli = '{{ route('medidor_first', ':code') }}';
                    urli = urli.replace(':code', busvar);
                    $.ajax({
                        url: urli,
                        success: function (response) {
                            var marker = new google.maps.Marker({
                                map,
                                //draggable: true,
                                animation: google.maps.Animation.DROP,
                                position: { lat: parseFloat(response.y), lng: parseFloat(response.x) },
                                label: labels[labelIndex++ % labels.length],
                            });

                            map.setCenter({ lat: parseFloat(response.y), lng: parseFloat(response.x) });
                            map.setZoom(17);

                            const contentString =   'Name: <strong>'+response.consumidor+'</strong> <br />' +
                                                    'Codigo: <strong>'+response.codigo+'</strong> - Categoria: <strong>'+response.categoria+'</strong> <br />'+
                                                    '<hr />'+
                                                    '<a href="#" onclick="calculateAndDisplayRoute('+parseFloat(response.y)+', '+parseFloat(response.x)+')" id="'+response.codigo+'" class="btn btn-sm btn-primary">Crear Ruta</a>';
                            
                            //console.log(directionsRenderer);

                            const infowindow = new google.maps.InfoWindow({
                                content: contentString
                            });

                            infowindow.open(map, marker);

                            marker.addListener("click", function(){
                                marker.setAnimation(google.maps.Animation.BOUNCE);
                            });

                            marker.addListener("click", () => {
                                infowindow.open(map, marker);
                            });
                        }
                    });
                });
                //---------------------------------Buscador----------------------------------
  
            }

            //----------------------- Buscador ---------------------------------
            //------------------------------------------------------------------
            function calculateAndDisplayRoute(lat, lng)
            {
                //console.log(mylat);
                directionsService.route({
                    origin: {lat: mylat, lng: mylng},
                    destination: {lat: lat, lng: lng},
                    travelMode: google.maps.TravelMode.DRIVING },
                    (response, status) => {
                    if (status === "OK") {
                        directionsRenderer.setDirections(response);
                    } else {
                        window.alert("Directions request failed due to " + status);
                    }
                });
            }
            //------------------------------------------------------------------


            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                infoWindow.setPosition(pos);
                infoWindow.setContent(
                    browserHasGeolocation
                    ? "Error: The Geolocation service failed."
                    : "Error: Your browser doesn't support geolocation."
                );
                infoWindow.open(map);
            }



        </script>
    </body>
</html>
