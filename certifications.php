<?php
include "Sinisters.php";
include "utils/AuthManager.php";

checkUserIsLoggedIn();

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

    <link href="/seguridadeneltransporte/assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/seguridadeneltransporte/assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet"/>
    <link href="/seguridadeneltransporte/node_modules/jquery-datetimepicker/jquery.datetimepicker.css"
          rel="stylesheet"/>
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="/seguridadeneltransporte/assets/demo/demo.css" rel="stylesheet"/>
    <link href="/seguridadeneltransporte/css/styles.css" rel="stylesheet"/>
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
                    <img src="img/dhl_icon.png">
                </div>
            </a>
            <a href="" class="simple-text logo-normal">
                <?php echo $_SESSION["auth_username"]; ?>
                <!-- <div class="logo-image-big">
                  <img src="assets/img/logo-big.png">
                </div> -->
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="active ">
                    <a href="./dashboard.php?page=sinisters&mode=view">
                        <i class="nc-icon nc-bus-front-12"></i>
                        <p>Siniestros</p>
                    </a>
                </li>
                <li>
                    <a href="./dashboard.php?page=certifications">
                        <i class="nc-icon nc-check-2"></i>
                        <p>Certificaciones</p>
                    </a>
                </li>
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
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Certificaciones pendientes</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-wrapper">
                                <table class="table table-sm table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Fecha de solicitud</th>
                                        <th>Nombre del solicitante</th>
                                        <th>Area solicitante</th>
                                        <th>Nombre de contacto</th>
                                        <th>Razon social</th>
                                        <th>Nombre comercial</th>
                                        <th>Ver detalle</th>
                                    </tr>
                                    </thead>
                                    <tbody id="pendingcerts">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Detalles de la linea a certificar</h5>
                            </div>
                            <div class="card-body">
                                <div id="cert-info-wrapper" class="hide">
                                    <h6 class="card-title" id="cert_transp_social_text">Hello <small id="cert_comercial_name_text">Hello</small></h6>
                                    <div class="data-wrapper">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="cert-info-leg">Nombre del solicitante : <span id="cert_solicitante_text">value</span></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="cert-info-leg">Area solicitante : <span id="cert_area_solicitante_text">value</span></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="cert-info-leg">Nombre de contacto</p>
                                                <p id="cert_contact_name_text">Value</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="cert-info-leg">Correo de contacto</p>
                                                <p id="cert_contact_mail_text">Value</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="cert-info-leg">Motivo del cambio de razon social</p>
                                                <p id="cert_rs_change_reason_text">Value</p>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-6 text-center">
                                                <h6>Direccion</h6>
                                                <p id="cert_address_text">Direccion</p>
                                            </div>
                                            <div class="col-md-6 bg-light-gray pt-2 map-wrapper" style="height: 350px;">
                                                <h6>Ubicacion aproximada :</h6>
                                                <div id="mMap" style="height: 300px;"></div>
                                                <div id="nomap" class="nomap hide">No hay ubicacion de mapa</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="no-data-wrapper" class="no-data-wrapper">
                                    <div class="no-data-text">Seleccione linea para ver detalles</div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button id="acceptandcontinue" class="hide btn btn-sm">Aceptar e iniciar proceso <span class="fa fa-thumbs-up"></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--MODALS -->

<!--END MODALS -->
<!--   Core JS Files   -->
<script src="../seguridadeneltransporte/node_modules/jquery/dist/jquery.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="js/jquery.autocomplete.js"></script>
<script src="node_modules/jquery-datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
<script src="utils/utils.js"></script>
<script src="utils/objects.js"></script>
<script src="node_modules/moment/moment.js"></script>
<script src="../seguridadeneltransporte/js/certificaciones.js"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDS6-LjQnrpEYTErc1Y5Yxh4WOPgk_5KXg">
</script>
<!-- Chart JS -->
<script src="assets/js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        getPendingcerts();
    });
</script>
</body>

</html>