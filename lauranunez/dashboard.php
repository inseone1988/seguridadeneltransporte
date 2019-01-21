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
    <link href="../node_modules/@fortawesome/fontawesome-free/css/all.css" rel="stylesheet">
    <!-- CSS Files -->

    <link href="/seguridadeneltransporte/assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/seguridadeneltransporte/assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet"/>
    <link href="/seguridadeneltransporte/node_modules/jquery-datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
    <!-- CSS Just for demo purpose, don't include it in your project -->
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
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Ceertificaciones pendientes</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="scheduling.php?mode=new" class="btn btn-sm" type="button"><span CLASS="fa fa-plus"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-sm table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Fecha solicitud</th>
                                            <th>Transporte</th>
                                            <th>Direccion</th>
                                            <th>Status</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody id="pending-certifications">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL -->
<div id="asign-cert" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Asignacion de certificacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-8 offset-2">
                <label for="cert-request_assigned_to">Asignar a : </label>
                <select name="cert_request_assigned_to" id="cert_request_assigned_to" class="form-control">
                </select>
            </div>
        </div>
          <div class="row mt-2">
              <div class="col-md-8 offset-2">
                  <label for="cert_request_schedule">Fecha de certificacion : </label>
                  <input name="cert_request_schedule" id="cert_request_schedule" class="form-control form-control-sm" />
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="saveScheduling()">Guardar <span class="fa fa-save"></span></button>
      </div>
    </div>
  </div>
</div>
<!-- MODAL END -->
<!--   Core JS Files   -->
<script src="/seguridadeneltransporte/node_modules/jquery/dist/jquery.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="../js/jquery.autocomplete.js"></script>
<script src="../node_modules/jquery-datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
<script src="../node_modules/moment/moment.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
<script src="js/dashboard.js"></script>
<script>
    $(document).ready(function () {
        initdateTiemPicker();
        getPendingCertifications(function () {
            displayPendingCerts();
        })
    })
</script>
</body>

</html>