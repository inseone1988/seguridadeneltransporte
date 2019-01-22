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
        <!-- End Navbar -->
        <!-- <div class="panel-header panel-header-lg">

    <canvas id="bigDashboardChart"></canvas>


  </div> -->
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card " id="event-select">
                        <div class="card-header ">
                            <?php
                            switch ($_GET["page"]) {
                                case "sinisters":
                                    echo displaycardTitle("tableDisplay");
                                    break;
                                case "certifications":

                                    break;
                            }
                            ?>
                        </div>
                        <div class="card-body ">
                            <?php
                            switch ($_GET["page"]) {
                                case "sinisters":
                                    echo displaySinisterMode();
                                    if (isset($_GET["mode"])) {
                                        if ($_GET["mode"] == "view") {
                                            echo displayPagination();
                                        }
                                    }

                                    break;
                                case "certifications":
                                    displayCertificationsDashboard();
                                    break;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--MODALS -->
<div class="modal" role="dialog" id="mperson">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Alta de persona</h3>
            </div>
            <form id="persondata" class="" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="photo-wrapper"
                                 style="min-height: 150px;background-color: lightgray; -webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;">
                                <img id="profilephoto" class="img-fluid" src="img/default-avatar.png"/>
                                <input type="hidden" name="person_profile_photo_path" id="personPhoto"/>
                                <button type="button" class="btn btn-sm photo-btn" id="photograb">
                                    <span class="fa fa-camera"></span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Nombre :&nbsp; </span>
                                        </div>
                                        <input class="form-control" name="person_name"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Apellildo  Paterno :&nbsp; </span>
                                        </div>
                                        <input class="form-control" name="person_fname"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Apellido Materno :&nbsp; </span>
                                        </div>
                                        <input class="form-control" name="person_lname"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group input-group-sm mt-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Proveedor</span>
                                </div>
                                <input type="text" class="form-control" name="person_providerid" data-provider=""
                                       id="person_provider_id" placeholder="(linea transportista)"/>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary"
                                            onclick="switchmodal('mperson','mproviders')">
                                        <span class="fa fa-ellipsis-h"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Certificacion</span>
                                </div>
                                <input type="" class="form-control" name="person_cert_type" id="name" placeholder=""
                                       aria-label="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm">Descartar</button>
                    <button class="btn btn-sm active" type="button" onclick="savePersonData()">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" role="dialog" id="mveh">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Alta de vehiculo</h3>
            </div>
            <form method="post" id="valta">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Proveedor</span>
                                </div>
                                <input name="v_provider_id" id="v_provider_id" data-id="" type="text"
                                       class="form-control" placeholder="(Linea transportista)"/>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary"
                                            onclick="switchmodal('mveh','mproviders')">
                                        <span class="fa fa-ellipsis-h"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Placa</span>
                                </div>
                                <input name="v_tag" type="text" class="form-control"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Capacidad de carga</span>
                                </div>
                                <select name="v_type" class="form-control"
                                        style="padding-bottom: 0px;padding-top: 3px;">
                                    <option value="Particular">Particular</option>
                                    <option value="> 1 T"> > 1 T</option>
                                    <option value="1.5 T">1.5 T</option>
                                    <option value="3.5 T">3.5 T</option>
                                    <option value="Mudanza">Mudanza</option>
                                    <option value="Rabon">Rabon</option>
                                    <option value="Thorton">Thorton</option>
                                    <option value="Tracto">Tracto</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="mproviders" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Alta transporte</h3>
            </div>
            <form id="talta">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Razon social : &nbsp;</span>
                                </div>
                                <input name="provider_social" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">N. Comercial : &nbsp;</span>
                                </div>
                                <input name="provider_alias" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">RFC : &nbsp;</span>
                                </div>
                                <input name="provider_rfc" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="msites" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelTitleId">Nuevo site</h4>
            </div>
            <form id="salta">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Nombre : &nbsp;</span>
                                </div>
                                <input name="site_name" type="text" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Tipo : &nbsp;</span>
                                </div>
                                <select name="locale" class="form-control"
                                        style="padding-top: 3px; padding-bottom: 0px;">
                                    <option value="Local">Local</option>
                                    <option value="Foraneo">Foraneo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="mclients" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelTitleId">Alta de cliente</h4>
            </div>
            <form id="calta">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        Razon Social
                                    </span>
                                    </div>
                                    <input class="form-control" type="text" name="client_social">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Nombre :</span>
                                    </div>
                                    <input type="text" class="form-control" name="client_name"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Alias :</span>
                                    </div>
                                    <input type="text" class="form-control" name="client_alias"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Descartar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--END MODALS -->
<!--   Core JS Files   -->
<script src="/seguridadeneltransporte/node_modules/jquery/dist/jquery.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="js/jquery.autocomplete.js"></script>
<script src="node_modules/jquery-datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
<script src="utils/utils.js"></script>
<script src="utils/objects.js"></script>
<script src="node_modules/moment/moment.js"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDS6-LjQnrpEYTErc1Y5Yxh4WOPgk_5KXg&callback=initMap">
</script>
<!-- Chart JS -->
<script src="assets/js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="js/chartsample.js"></script>
<script>
    var map;
    var marker;
    var infowindow;
    var messagewindow;
    var persons;
    var pendingmodal;
    var selectedsiteid;
    var isvalidevent = false;
    var vehicleid;
    var siteid;
    var clientid;
    var dtpoptions = {
        format: 'Y-m-d H:i:s'
    };
    $(document).ready(function () {
        pAutocomplete();
        vAutocomplete();
        siteAutocomplete();
        clientAutocomplete();

        <?php if (isset($_GET["page"])) {
        if ($_GET["page"] === "certifications") {
            echo "
                chartsample1();
                chartsample2();
                ";
        }
    } ?>
        providerAutocomplete("vautocpmplete", function (suggestion) {
            $("#person_provider_id").data("provider", suggestion.data);
        });
        providerAutocomplete("v_provider_id", function (suggestion) {
            $("#v_provider_id").data("vehicleid", suggestion.data);
        });
        providerAutocomplete("person_provider_id", function (suggestion) {
            $("#person_provider_id").data("provider", suggestion.data);
        });
        $("#eventdatetime").datetimepicker(dtpoptions);
        $("#siteleavedatetime").datetimepicker(dtpoptions);
        <?php
        if (isset($_GET["mode"])) {
            if ($_GET["mode"] == "edit") {
                $lsid = isset($_GET["sid"]) ? ltrim($_GET["sid"], '0') : "$('#eventid').data('eventid');";
                echo "sinister.sinister_id = " . $lsid . "; \n";
            }
            if ($_GET["mode"] === "edit") {
            }
        }

        ?>

        $(".custom-file-input").on("change", function (event) {
            event.stopPropagation();
            event.preventDefault();
            var input = $(this).get(0);
            var name = $(this).attr("name");
            var file = input.files;
            var data = new FormData($(document.createElement("form")));
            data.append("function", "saveSinisterEvidence");
            data.append("sinisterid", sinister.sinister_id);
            data.append(name, file[0]);
            $.ajax({
                url: "requesthandler.php",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                data: data,
                success: function (r) {
                    $("label[for=" + name + "]").text("Archivo subido con exito!!!").addClass("text-success");
                }
            })
        });

        $("#persondata").on("submit", function (event) {
            event.stopPropagation();
            event.preventDefault();
            if (isvalidevent) {
                var mdata = mapForm("persondata");
                mdata.person_providerid = $("#person_provider_id").data("provider");
                $.ajax({
                    url: "requesthandler.php",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        "function": "newPerson",
                        "data": mdata
                    },
                    success: function (r) {
                        if (r.success) {
                            alert("Guardado correctamente");
                            $(".modal").modal("hide");
                            isvalidevent = false;
                        }
                    }
                });
            }
        })
    });

    function savePersonData() {
        isvalidevent = true;
        $("#persondata").trigger("submit");
    }

    function openSinisterView(button) {
        var sinister = button.data("sinister");
        var url = "sinister_view.php?sid=" + sinister;
        window.open(url, "_blank");
    }

    function editSinister(button) {
        var sinisterid = button.data("sinister");
        var url = <?php echo "'" . $_SERVER["PHP_SELF"] . "?page=sinisters&sid='";?> +sinisterid + '&mode=edit';
        window.open(url, "_self");
    }

    function initMap() {
        var coords = $("#coords").data("coords");
        var macrocentro = {lat: 19.629781, lng: -99.193006};
        var rcoords = (coords === "" ? macrocentro : coords)
        map = new google.maps.Map(document.getElementById('map'), {
            center: rcoords,
            zoom: 15
        });

        marker = new google.maps.Marker({
            position: rcoords,
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
            if (marker !== undefined) {
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

    function pAutocomplete() {
        $("#pautocomplete").autocomplete({
            serviceUrl: 'requesthandler.php',
            params: {"function": "opAutocomplete"},
            minChars: 3,
            type: "POST",
            onSelect: function (suggestion) {
                sinister.sinister_person_id = suggestion.data;
            }
        });
    }

    function vAutocomplete() {
        $("#vautocomplete").autocomplete({
            serviceUrl: 'requesthandler.php',
            params: {"function": "vAutocomplete"},
            minChars: 3,
            type: "POST",
            onSelect: function (suggestion) {
                sinister.sinister_v_id = suggestion.data;
            }
        });
    }

    function siteAutocomplete() {
        $("#sautocomplete").autocomplete({
            serviceUrl: 'requesthandler.php',
            params: {"function": "siteAutocomplete"},
            minChars: 3,
            type: "POST",
            onSearchStart: function (params) {
                $("#cautocomplete").attr("disabled", true);
            },
            onSearchComplete: function (query, suggestions) {
                $("#cautocomplete").attr("disabled", false);
            },
            onSelect: function (suggestion) {
                sinister.sinister_site_id = suggestion.data;
            }
        });
    }

    function clientAutocomplete() {
        $("#cautocomplete").autocomplete({
            serviceUrl: 'requesthandler.php',
            params: {"function": "clientAutocomplete"},
            minChars: 3,
            type: "POST",
            onSelect: function (suggestion) {
                sinister.sinister_client_id = suggestion.data;
            }
        });
    }

    function providerAutocomplete(field, callback) {
        $("#" + field).autocomplete({
            serviceUrl: 'requesthandler.php',
            params: {"function": "providerAutocomplete"},
            minChars: 3,
            type: "POST",
            onSelect: function (suggestion) {
                callback(suggestion);
            }
        });
    }

    function openmmodal(modal) {
        pendingmodal = undefined;
        $("#" + modal).modal("show");
    }

    function switchmodal(modalpending, modaldest) {
        pendingmodal = modalpending;
        $(".modal").modal("hide");
        $("#" + modaldest).modal("show");
        $("#" + modaldest).on("hidden.bs.modal", function (e) {
            if (pendingmodal !== undefined) {
                switchmodal(undefined, pendingmodal);
            }
        });
    }

    function saveSinister() {
        var formdata = mapForm("sinisterdata");
        formdata.sinister_event_last_saved = moment().format("YYYY-MM-DD HH:mm:ss");
        $.each(formdata, function (index, value) {
            sinister[index] = value;
        })
        var options = {
            data: {
                "function": "updateEvent",
                "data": sinister
            },
            rCallback: function (r) {
                $("#lastsaved").text("Guardado a las : " + formdata.sinister_event_last_saved);
                console.log(r);
            }
        };
        ajaxCall(options);
        console.log(sinister);
    }

    function grabPhoto() {
        var input = $(document.createElement("input")).attr("type", "file").on("change", function (event) {
            event.stopPropagation();
            var file = $(this).prop("files");
            var data = new FormData($(document.createElement("form")));
            data.append("function", "saveProfilePhoto");
            data.append(file[0].name, file[0]);
            savePhoto(data);
        });
        input.trigger("click");
    }

    function savePhoto(data) {
        $.ajax({
            url: "requesthandler.php",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            data: data,
            success: function (r) {
                $("#personPhoto").val(r.photopath);
                $("#profilephoto").attr("src", r.photopath);
            }
        });
    }

    $("#photograb").on("click", function (event) {
        grabPhoto();
    })

    function newEvent() {
        window.open("dashboard.php?page=sinisters&mode=edit&newevent=true", "_self");
    }

    $("#talta").on("submit", function (event) {
        event.preventDefault();
        var data = mapForm("talta");
        data.provider_created = moment().format("YYYY-MM-DD HH:mm:ss");
        saveTransport(data, function (id) {
            sinister.v_provider_id = id;
            $("#mproviders").modal("hide");
        })
    });

    function saveTransport(data, callback) {
        $.ajax({
            url: "requesthandler.php",
            type: "POST",
            dataType: "JSON",
            data: {
                "function": "savetransport",
                "data": data
            },
            success: function (r) {
                if (r.success) {
                    callback(r.id);
                    //$("#v_provider_id").val(data.provider_alias);
                    //sinister.v_provider_id = r.id;
                }
            }
        });
    }

    $("#valta").on("submit", function (event) {
        event.stopPropagation();
        event.preventDefault();
        var data = mapForm("valta");
        data.v_provider_id = $("#v_provider_id").data("vehicleid")
        saveVehicle(data);
    });

    function saveVehicle(data) {
        $.ajax({
            url: "requesthandler.php",
            type: "POST",
            dataType: "JSON",
            data: {
                "function": "saveVehicle",
                "data": data
            },
            success: function (r) {
                if (r.success) {
                    sinister.sinister_v_id = r.vid;
                    $("#vautocomplete").val(data.v_tag);
                    $("#valta").trigger("reset");
                    $(".modal").modal("hide");
                }
            }

        });
    }

    $("#salta").on("submit", function (event) {
        event.preventDefault();
        var data = mapForm("salta");
        saveSite(data);
    });

    function saveSite(data) {
        $.ajax({
            url: "requesthandler.php",
            type: "POST",
            dataType: "JSON",
            data: {
                "function": "saveSite",
                "data": data
            },
            success: function (r) {
                if ((r.success)) {
                    alert("Site guardado");
                    $(".modal").modal("hide");
                }
            }
        });
    }

    $("#calta").on("submit", function (event) {
        event.preventDefault();
        var data = mapForm("calta");
        saveClient(data);
    });

    function saveClient(data) {
        $.ajax({
            url: "requesthandler.php",
            type: "POST",
            dataType: "JSON",
            data: {
                "function": "saveClient",
                "data": data
            },
            success: function (r) {
                if (r.success) {
                    alert("Cliente guardado");
                    $(".modal").modal("hide");
                }
            }
        });
    }

</script>
</body>

</html>