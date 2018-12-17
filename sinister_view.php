<?php
/**
 * Created by PhpStorm.
 * User: Javier Ramirez
 * Date: 04/12/2018
 * Time: 03:14 PM
 */
include "Sinisters.php";
if (isset($_GET["sid"])){
    $data = getSinisterData($_GET["sid"]);
    $sinisterdata = $data[0];
    $sinarrmappoint = explode(",",$sinisterdata["sinister_map_point"]);
    $lat = $sinarrmappoint[0];
    $long = $sinarrmappoint[1];
    $coords = "{\"lat\" : $lat, \"lng\" : $long}";
    if ($sinisterdata["files"] != ""){
        $files = explode(",",$sinisterdata["files"]);
    }else{
        $files = [];
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        DSC Seguridad en el transporte
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen,print"/>
    <link href="assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet"/>
</head>
<body class="bg-secondary">
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-8 offset-md-2">
            <div class="card bg-light">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>
                                <img class="img-fluid" src="img/DHL_Logo.svg">
                                <?php if (!isset($sinisterdata)){
                                    echo "<h2>Failed to load data</h2>";
                                }else{
                                    echo "<h3>Reporte de siniestro</h3>";
                                } ?>
                            </h2>
                        </div>
                        <div class="col-md-6 d-flex align-content-end">
                            <h6 class="text-danger">Folio : <?php echo $sinisterdata["sinister_id"]?></h6>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="profile-photo">
                                <img src="<?php echo $sinisterdata["person_photo"] != "" ? $sinisterdata["person_photo"] : '/seguridadeneltransporte/img/user1.svg'; ?>" class="img-fluid" style="max-height: 188px; max-width: 188px">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <p class="font-weight-bold">Datos del operador</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <!--TODO:Add values-->
                                                <div class="col-md-12 s-value">
                                                    <strong>Operador</strong> :
                                                    <?php echo $sinisterdata["person_name"] . " " . $sinisterdata["person_fname"] . " " . $sinisterdata["person_lname"];?>
                                                </div>
                                                <div class="col-md-12 s-value">
                                                    <strong>Linea</strong> :
                                                    <?php echo $sinisterdata["provider_name"]?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <p class="font-weight-bold">Datos de la unidad</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 s-value">
                                                    <strong class="font-weight-bold">Placas</strong> :
                                                    <?php echo $sinisterdata["v_tag"];?>
                                                </div>
                                                <div class="col-md-12 s-value">
                                                    <strong class="font-weight-bold">Tipo de unidad</strong>:
                                                    <?php echo formatString($sinisterdata["v_type"]);?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <p class="font-weight-bold">Datos del siniestro</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-12 s-value">
                                                            <strong>Site de origen</strong>:
                                                            <?php echo $sinisterdata["site_alias"]; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-12 s-value">
                                                            <strong>Cuenta</strong>:
                                                            <?php echo formatString($sinisterdata["client_alias"]);?>
                                                        </div>
                                                        <div class="col-md-12 s-value">
                                                            <strong>Monto</strong>:
                                                            <?php echo formatString($sinisterdata["sinister_ammount"]);?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <p class="font-weight-bold">Narrativa de los hechos</p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 s-value">
                                            <strong>Abstract</strong>:
                                            <?php echo $sinisterdata["sinister_op_exp"]?>
                                        </div>
                                        <div class="col-md-12 s-value">
                                            <strong>Operardor</strong>:
                                            <?php echo $sinisterdata["sinister_op_exp"]?>

                                        </div>
                                        <div class="col-md-12 s-value">
                                            <strong>Ayudante(s)</strong>:
                                            <?php echo $sinisterdata["sinister_ay_exp"]?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer"></div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <p class="font-weight-bold">Archivos</p>
                                </div>
                                <div class="card-body">
                                    <?php
                                        if (count($files) > 0){
                                            for ($i = 0; $i < count($files);$i++){
                                                $mfile = formatString($files[$i]);
                                                echo "<a href='$mfile' target='_blank'>$mfile</a>";
                                            }
                                        }
                                    ?>
                                </div>
                                <div class="card-footer"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <p class="font-weight-bold">Ubicacion del evento</p>
                                </div>
                                <div class="card-body">
                                    <input type='hidden' id='coords' data-coords='<?php echo $coords; ?>' />
                                    <div class="map" id="map"></div>
                                </div>
                                <div class="card-footer"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer align-content-center">

                </div>
            </div>
        </div>
    </div>
</div>

<!--   Core JS Files   -->
<script src="assets/js/core/jquery.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!-- Chart JS -->
<script src="assets/js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDS6-LjQnrpEYTErc1Y5Yxh4WOPgk_5KXg">
</script>
<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script>
    var map;
    var marker;
    $(document).ready(function() {
        initMap();
    });

    function initMap() {
        var coords = $("#coords").data("coords");
        var macrocentro = {lat: 19.629781, lng: -99.193006};
        map = new google.maps.Map(document.getElementById('map'), {
            center: coords == "" ? macrocentro : coords,
            zoom: 15
        });

        marker = new google.maps.Marker({
            position: coords,
            map: map
        });

        infowindow = new google.maps.InfoWindow({
            content: document.getElementById('form')
        });

        messagewindow = new google.maps.InfoWindow({
            content: "Lugar del incidente"
        });

        google.maps.event.addListener(map, 'click', function (event) {
            var point = event.latLng;
            $("#mapspoint").val(point.lat() + ", " + point.lng());
            console.log(point);
            if (marker !== undefined){
                marker.setMap(null);
            }
            marker = new google.maps.Marker({
                position: event.latLng,
                map: map
            });

            google.maps.event.addListener(marker, 'click', function () {
                infowindow.open(map, marker);
            });

        });
    }

    function openSinisterView(){

    }
</script>
</body>

</html>
