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
                global_search=null;
                map.controls[google.maps.ControlPosition.TOP_CENTER].push(styleControl);
                document.getElementById("myboton").addEventListener("click", () => {
                    map.setZoom(14);
                    var busvar =  document.getElementById("mytext").value;
                    var urli = '{{ route('search_first', ':code') }}';
                    urli = urli.replace(':code', busvar);
                    console.log(urli);
                    $.ajax({
                        url: urli,
                        success: function (response) {
                            if(response.error)
                            {
                                // console.log(response);
                                message('error', response.error);
                                
                            }else{
                                console.log(response);
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
                                                        '<a href="#" onclick="calculateAndDisplayRoute('+parseFloat(response.find.y)+', '+parseFloat(response.find.x)+')" id="'+response.find.codigo+'" class="btn btn-sm btn-primary">Crear Ruta</a>'+
                                                        '<a href="#" data-toggle="modal" data-target="#modalLoginForm" class="btn btn-sm btn-success">Quieres Observar ?</a>';
                                        global_search=response.search;
                                        message('info', response.search +' - encontrado en '+response.table);
                                        break;
                                    case 'Transformadores':
                                            contentString = 'Codigo: <strong>'+response.find.codigo+'</strong> <br />'+
                                                            'Direccion: <strong>'+response.find.direccion+'</strong> <br />'+
                                                            '<hr />'+
                                                            '<a href="#" onclick="calculateAndDisplayRoute('+parseFloat(response.find.y)+', '+parseFloat(response.find.x)+')" id="'+response.find.codigo+'" class="btn btn-sm btn-primary">Crear Ruta</a>'+
                                                            '<a href="#" data-toggle="modal" data-target="#modalLoginForm" class="btn btn-sm btn-success">Quieres Observar ?</a>';
                                                            
                                            global_search=response.search;
                                            message('info', response.search +' - encontrado en '+response.table);
                                        break;
                                    case 'Protecciones':
                                        contentString = 'Codigo: <strong>'+response.find.codigo+'</strong> <br />'+
                                                        'Codigo Superior: <strong>'+response.find.cod_superi+'</strong> <br />'+
                                                        '<hr />'+
                                                        '<a href="#" onclick="calculateAndDisplayRoute('+parseFloat(response.find.y)+', '+parseFloat(response.find.x)+')" id="'+response.find.codigo+'" class="btn btn-sm btn-primary">Crear Ruta</a>'+
                                                        '<a href="#" data-toggle="modal" data-target="#modalLoginForm" class="btn btn-sm btn-success">Quieres Observar ?</a>';
                                                        
                                        global_search=response.search;
                                        message('info', response.search +' - encontrado en '+response.table);
                                    break;
                                    default:
                                        break;
                                }

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

                
        </script>
    </body>
</html>
