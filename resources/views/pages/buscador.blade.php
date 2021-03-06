<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>{{ setting('site.title') }}</title>
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <link href="{{ asset('vendor/mdb/css/bootstrap.min.css') }}" rel="stylesheet">
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
        #overview {
            position: absolute;
            left: 5px;
            height: 100px;
            width: 100px;
            bottom: 5px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }
        </style>
        @laravelPWA
    </head>
    <body>
        
        <div id="style-selector-control" class="pt-4">
            <div class="md-form input-group">
                <input id="mytext" type="text" class="form-control" placeholder="Ingresa tu Busqueda" aria-label="Ingresa tu Busqueda" aria-describedby="MaterialButton-addon2">
                <div class="input-group-append">
                    <button class="btn btn-md btn-primary" type="button" id="myboton">Buscar</button>
                </div>
            </div>
        </div>

        <div id="map"></div>
        <div id="overview"></div>

        <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header text-center">
                    
                    <h5 class="modal-title w-100 font-weight-bold">Envia tu Observacion, Al area Tecnica (GIS)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <form id="myform" class="form" action="{{ route('save_obervation') }}" method="post">
                            {{ csrf_field() }}  
                            <div class="form-group">
                                <label for="">Busqueda</label>
                                <input type="text" name="search" id="search" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Mensaje</label>    
                                <textarea name="message" id="message" placeholder="Write something to us" class="form-control"> </textarea>
                            </div>
                            <input type="text" name="x" id="x" class="form-control" hidden>
                            <input type="text" name="y" id="y" class="form-control" hidden>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                </div>
            </div>
        </div>

          <!--  JQuery  --> 
  <!--  Bootstrap tooltips  -->
    <script type="text/javascript" src="{{ asset('vendor/mdb/js/jquery-3.4.1.min.js') }}"></script>
  {{--  <script type="text/javascript" src="{{ asset('vendor/mdb/popper.min.js') }}"></script>  --}}
  <!--  Bootstrap core JavaScript  -->
    <script type="text/javascript" src="{{ asset('vendor/mdb/js/bootstrap.min.js') }}"></script> 
  <!--  MDB core JavaScript  -->
  {{--  <script type="text/javascript" src="{{ asset('vendor/mdb/js/mdb.min.js') }}"></script>  --}}

        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnHV6QtGETar9olguruwVjjcDAFhrV-sg&callback=initMap&libraries=&v=weekly" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/annyang/2.6.0/annyang.min.js"></script>

        <script>
            let map, infoWindow, marker, mylat, mylng, overview;
            let labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            let labelIndex = 0;
            let directionsRenderer, directionsService;
            const OVERVIEW_DIFFERENCE = 5;
            const OVERVIEW_MIN_ZOOM = 3;
            const OVERVIEW_MAX_ZOOM = 12;
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

                overview = new google.maps.Map(document.getElementById("overview"), {
                    center: { lat: -34.397, lng: 150.644 },
                    zoom: 14,
                    disableDefaultUI: true,
                    gestureHandling: "none",
                    zoomControl: false
                });
                
                function clamp(num, min, max) {
                    return Math.min(Math.max(num, min), max);
                }
                map.addListener("bounds_changed", () => {
                    overview.setCenter(map.getCenter());
                    overview.setZoom(
                    clamp(
                        map.getZoom() - OVERVIEW_DIFFERENCE,
                        OVERVIEW_MIN_ZOOM,
                        OVERVIEW_MAX_ZOOM
                    )
                    );
                });
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
                    var image = {
                        url: "{{ Voyager::Image(Auth::user()->avatar) }}", // url
                        scaledSize: new google.maps.Size(40, 40), // scaled size
                        origin: new google.maps.Point(0,0), // origin
                        anchor: new google.maps.Point(0, 0) // anchor
                    };
                    marker = new google.maps.Marker({
                        map,
                        draggable: true,
                        icon: image,
                        animation: google.maps.Animation.DROP,
                        position: { lat: position.coords.latitude, lng: position.coords.longitude },
                        label: labels[labelIndex++ % labels.length],
                    });

                    google.maps.event.addListener(marker, "dragend", function(event) { 
                        mylat = event.latLng.lat(); 
                        mylng = event.latLng.lng(); 
                    }); 

                    infowindow.open(map, marker);

                    marker.addListener("click", function(){
                        marker.setAnimation(google.maps.Animation.BOUNCE);
                    });

                    setTimeout(function () { infowindow.close(); }, 9000);

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
                    global_infowindow=null;
                    global_search=null;
                    map.setZoom(14);
                    var busvar =  document.getElementById("mytext").value;
                    var urli = '{{ route('search_first', ':code') }}';
                    urli = urli.replace(':code', busvar);
                    $.ajax({
                        url: urli,
                        success: function (response) {
                            if(response.error)
                            {
                                message('error', response.error);
                                
                            }else{
                                var marker = new google.maps.Marker({
                                map,
                                //draggable: true,
                                animation: google.maps.Animation.DROP,
                                position: { lat: parseFloat(response.find.y), lng: parseFloat(response.find.x) },
                                label: labels[labelIndex++ % labels.length],
                                });
                                                          

                                map.setCenter({ lat: parseFloat(response.find.y), lng: parseFloat(response.find.x) });
                                map.setZoom(17);
                                var contentString;
                                switch (response.table) {
                                    case 'Medidores':
                                        contentString = 'Name: <strong>'+response.find.consumidor+'</strong> <br />' +
                                                        'Direccion: <strong>'+response.find.direccion+'</strong> <br />' +
                                                        'Codigo: <strong>'+response.find.codigo+'</strong> - Categoria: <strong>'+response.find.categoria+'</strong> - Trafo: <strong>'+response.find.cod_centro+'</strong>'+
                                                        '<hr />'+
                                                        '<a href="#" onclick="calculateAndDisplayRoute('+parseFloat(response.find.y)+', '+parseFloat(response.find.x)+')" id="'+response.find.codigo+'" class="btn btn-sm btn-primary">Ruta?</a>'+
                                                        '<a href="#" data-toggle="modal" data-target="#modalLoginForm" class="btn btn-sm btn-success">Observar?</a>';
                                        global_search=response.search;
                                        message('info', response.search +' - encontrado en '+response.table);
                                        break;
                                    case 'Transformadores':
                                            contentString = 'Codigo: <strong>'+response.find.codigo+'</strong> <br />'+
                                                            'Direccion: <strong>'+response.find.direccion+'</strong> <br />'+
                                                            '<hr />'+
                                                            '<a href="#" onclick="calculateAndDisplayRoute('+parseFloat(response.find.y)+', '+parseFloat(response.find.x)+')" id="'+response.find.codigo+'" class="btn btn-md btn-primary">Ruta?</a>'+
                                                            '<a href="#" data-toggle="modal" data-target="#modalLoginForm" class="btn btn-md btn-success">Observar?</a>';
                                                            
                                            global_search=response.search;
                                            message('info', response.search +' - encontrado en '+response.table);
                                        break;
                                    case 'Protecciones':
                                        contentString = 'Codigo: <strong>'+response.find.codigo+'</strong> <br />'+
                                                        'Codigo Superior: <strong>'+response.find.cod_superi+'</strong> <br />'+
                                                        '<hr />'+
                                                        '<a href="#" onclick="calculateAndDisplayRoute('+parseFloat(response.find.y)+', '+parseFloat(response.find.x)+')" id="'+response.find.codigo+'" class="btn btn-sm btn-primary">Ruta?</a>'+
                                                        '<a href="#" data-toggle="modal" data-target="#modalLoginForm" class="btn btn-sm btn-success">Observar?</a>';
                                                        
                                        global_search=response.search;
                                        message('info', response.search +' - encontrado en '+response.table);
                                    break;
                                    default:
                                        break;
                                }

                                global_infowindow = new google.maps.InfoWindow({
                                    content: contentString
                                });
                                
                                global_infowindow.open(map, marker);

                                marker.addListener("click", function(){
                                    marker.setAnimation(google.maps.Animation.BOUNCE);
                                });

                                setTimeout(function () { global_infowindow.close(); }, 9000);

                                marker.addListener("click", () => {
                                    global_infowindow.open(map, marker);
                                });
                            }
                            
                        }
                    });
                });
                //---------------------------------Buscador----------------------------------
  
            }

            //----------------------- enrutador ---------------------------------
            //------------------------------------------------------------------
            function calculateAndDisplayRoute(lat, lng)
            {
                message('info', 'Ruta creada para: '+global_search);
                setTimeout(function () { global_infowindow.close(); }, 9000);
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

            //---------------------------------Mensajes -------
            function message(type, message)
            {
                const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 9000,
                timerProgressBar: true,
                onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                });
                Toast.fire({
                icon: type,
                title: message
                });
            }

            $("#modalLoginForm").on('show.bs.modal', function(){
                console.log(global_search);
                $('#search').val(global_search);
                $('#x').val(mylat);
                $('#y').val(mylng);
                // message('info', '');
            });
            $("#myform").submit(function(e) {

                e.preventDefault(); // avoid to execute the actual submit of the form.
                var form = $(this);
                var url = form.attr('action');
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(response)
                    {
                        console.log(response);
                        message('info', 'Mensaje Enviado #'+response.data.id);
                        $('#modalLoginForm').modal('hide');

                    }, error: function(e){
                        console.log(e);
                    }
                    });
                });

            if (annyang) {
                        // Let's define a command.
                const commands = {
                    'alejar': () => { 
                            mizoom = map.getZoom();
                            console.log('alejando el mapa, con: '+mizoom); 
                            map.setZoom(mizoom - 2);
                            console.log('alejando el mapa, con: '+mizoom); 
                        },
                    'acercar': () => { 
                            mizoom = map.getZoom();
                            console.log('acercando el mapa, con: '+mizoom); 
                            map.setZoom(mizoom + 2);
                            console.log('acercanado el mapa, con: '+mizoom); 
                        },
                    // 'buscar *search': searchs,
                };
                var searchs = function(search) {
                    console.log(search);
                 }

                // Add our commands to annyang
                annyang.addCommands(commands);
                annyang.setLanguage('es-BO');
                // Start listening.
                annyang.debug();
                annyang.start();
		    }
        </script>
    </body>
</html>
