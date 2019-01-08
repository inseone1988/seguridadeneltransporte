<?php
/**
 * Created by PhpStorm.
 * User: ZK-PC
 * Date: 07/01/2019
 * Time: 12:34 PM
 */
?>
<?php
/*include "Sinisters.php";
include "utils/AuthManager.php";

checkUserIsLoggedIn();
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>
        DSC Seguridad en el transporte
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet"/>
    <link href="../node_modules/jquery-datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
    <link href="../css/styles.css" rel="stylesheet"/>
</head>

<body class="">
<div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
      -->
        <div class="logo">
            <a href="#" class="simple-text logo-mini">
                <div class="logo-image-small">
                    <img src="../img/dhl_icon.png">
                </div>
            </a>
            <a href="" class="simple-text logo-normal">
                <?php echo "Laura Nunez";//$_SESSION["auth_username"]; ?>
                <!-- <div class="logo-image-big">
                  <img src="assets/img/logo-big.png">
                </div> -->
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li>
                    <a href="./?function=logout">
                        <i class="nc-icon nc-share-66"></i>
                        <p>Salir</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <a class="navbar-brand" href="#pablo">Seguridad en el transporte</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">

                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Nueva certificacion</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Solicitante</span>
                                        </div>
                                        <input class="form-control" type="text"/>
                                        <div class="input-group-append">
                                            <button class="btn input-group-btn bg-secondary">
                                                <span class="fa fa-ellipsis-h"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Area solicitante</span>
                                        </div>
                                        <input class="form-control" type="text"/>
                                        <div class="input-group-append">
                                            <button class="btn input-group-btn bg-secondary">
                                                <span class="fa fa-ellipsis-h"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card bg-light-gray">
                                        <div class="card-header">
                                            <h6>Informacion de la linea a certificar</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Nombre de contacto</label>
                                                    <input type="text" class="form-control form-control-sm"/>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Telefono de contacto</label>
                                                    <input type="text" class="form-control form-control-sm"/>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Correo de contacto</label>
                                                    <input type="text" class="form-control form-control-sm"/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Razon social</label>
                                                    <input type="text" class="form-control form-control-sm" name=""
                                                           id="">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Nombre comercial</label>
                                                    <input type="text" class="form-control form-control-sm"/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Direccion :
                                                        <small><a href="javascript:showMap()">Ubicar punto en el mapa</a></small>
                                                    </label>
                                                    <textarea class="form-control" rows="5"></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>Cuenta o sector para el que se solicita la
                                                                certificacion : </label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                   name="" id=""/>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Motivo del cambio de razon social :</label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                   name="" id=""/>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">

                            <div class="card-footer">
                                <button class="btn btn-sm" type="button">
                                    <span class="fa fa-save"></span> Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<<!--START MODAL -->
<div id="mapShow" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubicar punto en el mapa</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="map" id="map" style="height: 300px;"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="reset" class="btn btn-secondary">
                    Guardar punto <span class="fa fa-save"></span>
                </button>
            </div>
        </div>
    </div>
</div>
<!--   Core JS Files   -->
<script src="../node_modules/jquery/dist/jquery.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="../js/jquery.autocomplete.js"></script>
<script src="../node_modules/jquery-datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
<script src="../node_modules/moment/moment.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDS6-LjQnrpEYTErc1Y5Yxh4WOPgk_5KXg&callback=initMap" async defer></script>
<script>
    var map;
    var marker;
    var certLocation;
    function initMap() {
        var macrocentro = {lat: 19.629781, lng: -99.193006};
        map = new google.maps.Map(document.getElementById("map"), {
            center: macrocentro,
            zoom: 14
        });

        marker = new google.maps.Marker({
            position: macrocentro,
            map: map
        });

        google.maps.event.addListener(map, 'click', function (event) {
            var point = event.latLng;
            certLocation = point;
            $("#mapspoint").val(point.lat() + ", " + point.lng());
            console.log(point);
            if (marker !== undefined) {
                marker.setMap(null);
            }
            marker = new google.maps.Marker({
                position: event.latLng,
                map: map
            });
        })
    }

    $(document).ready(function(){

    });

    function showMap(){
        $("#mapShow").modal("show");
    }
</script>
</body>

</html>
