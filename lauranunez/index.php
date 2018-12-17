<?php
/**
 * Created by PhpStorm.
 * User: Javier Ramirez
 * Date: 17/12/2018
 * Time: 09:36 AM
 */

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="assetsbs3/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assetsbs3/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>Paper Dashboard by Creative Tim</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>


    <!-- Bootstrap core CSS     -->
    <link href="/seguridadeneltransporte/assetsbs3/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Animation library for notifications   -->
    <link href="/seguridadeneltransporte/assetsbs3/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="/seguridadeneltransporte/assetsbs3/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="/seguridadeneltransporte/assetsbs3/css/themify-icons.css" rel="stylesheet">
    <link href="/seguridadeneltransporte/css/styles.css" rel="stylesheet"/>

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="danger">

        <!--
            Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
            Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
        -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    <?php echo "Laura Nuñez"; ?>
                </a>
            </div>

            <ul class="nav">
                <li class="nav-item active">
                    <a class="nav nav-link" href="<?php echo $_SERVER["PHP_SELF"] ?>">
                        <i class="ti-panel"></i>
                        <p>Inicio</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-panel"></i>
                                <p>Stats</p>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-bell"></i>
                                <p class="notification">5</p>
                                <p>Notifications</p>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <i class="ti-settings"></i>
                                <p>Settings</p>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header header-wrapper">
                                <h3 class="">Certificaciones pendientes</h3>
                                <button class="btn btn-sm mb-2" style="margin-bottom: 5px;" onclick="testing()">
                                    <span class="fa fa-plus"></span>
                                </button>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Razon social</th>
                                        <th>Direcccion</th>
                                        <th>Persona de contacto</th>
                                        <th>Numero de contacto</th>
                                        <th>Correo electronico</th>
                                        <th>Sector</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">

            </div>
        </footer>

    </div>
</div>


</body>

<!--   Core JS Files   -->
<script src="/seguridadeneltransporte/assetsbs3/js/jquery.min.js" type="text/javascript"></script>
<script src="/seguridadeneltransporte/assetsbs3/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="/seguridadeneltransporte/assetsbs3/js/bootstrap-checkbox-radio.js"></script>

<!--  Charts Plugin -->
<script src="/seguridadeneltransporte/assetsbs3/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="/seguridadeneltransporte/assetsbs3/js/bootstrap-notify.js"></script>
<script src="/seguridadeneltransporte/node_modules/moment/moment.js"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="/seguridadeneltransporte/assetsbs3/js/paper-dashboard.js"></script>
<script src="/seguridadeneltransporte/utils/formify.js"></script>

<script>
    $(document).ready(function () {
    })

    function testing() {
        var id = moment().format("x")
        var formdata = {
            formattr: {
                "id": id
            },
            onSubmit: function (caller) {
                console.log(caller)
            },
            fields: [
                {
                    colsize: "col-md-12",
                    type: "input",
                    attributes: {"placeholder": "Nombre del solicitante","name":"sample_field"},
                    style: {},
                    class: "form-control-sm",
                    events: {
                        onClick: function () {

                        },
                        onChange: function () {

                        }
                    }
                },
                {
                    colsize: "col-md-12 mt-2",
                    type: "input",
                    attributes: {"placeholder": "Area solicitante","name":"sample_field"},
                    style: {},
                    class: "form-control-sm",
                    events: {
                        onClick: function () {

                        },
                        onChange: function () {

                        }
                    }
                },
                {
                    colsize: "col-md-12 mt-2",
                    type: "input",
                    attributes: {"placeholder": "RazonSocial / Nombre comercial","name":"sample_field"},
                    style: {},
                    class: "form-control-sm",
                    events: {
                        onClick: function () {

                        },
                        onChange: function () {

                        }
                    }
                }, {
                    colsize: "col-md-12 mt-2",
                    type: "textarea",
                    attributes: {"placeholder": "Direccion","name":"sample_field1"},
                    style: {},
                    class: "form-control-sm bg-light",
                    events: {
                        onClick: function () {

                        },
                        onChange: function () {

                        }
                    }
                }, {
                    colsize: "col-md-6 mt-2",
                    type: "input",
                    attributes: {"placeholder": "Persona de contacto","name":"sample_field2"},
                    style: {},
                    class: "form-control-sm bg-light",
                    events: {
                        onClick: function () {

                        },
                        onChange: function () {

                        }
                    }
                }, {
                    colsize: "col-md-6 mt-2",
                    type: "input",
                    attributes: {"placeholder": "Telefono de contacto","name":"sample_field2"},
                    style: {},
                    class: "form-control-sm bg-light",
                    events: {
                        onClick: function () {

                        },
                        onChange: function () {

                        }
                    }
                }, {
                    colsize: "col-md-6 mt-2",
                    type: "input",
                    attributes: {"placeholder": "Correo Electronico","name":"sample_field2"},
                    style: {},
                    class: "form-control-sm bg-light",
                    events: {
                        onClick: function () {

                        },
                        onChange: function () {

                        }
                    }
                }, {
                    colsize: "col-md-6 mt-2",
                    type: "input",
                    attributes: {"placeholder": "Persona de contacto","name":"sample_field2"},
                    style: {},
                    class: "form-control-sm bg-light",
                    events: {
                        onClick: function () {

                        },
                        onChange: function () {

                        }
                    }
                }, {
                    colsize: "col-md-12 mt-2",
                    type: "input",
                    attributes: {"placeholder": "Motivo del cambio de razon social","name":"sample_field2"},
                    style: {},
                    class: "form-control-sm bg-light",
                    events: {
                        onClick: function () {

                        },
                        onChange: function () {

                        }
                    }
                }
            ]
        };
        var modtestop = {};
        modtestop.id = id;
        modtestop.title = "Solicitud de certificacion";
        modtestop.modalbody = formify(formdata);
        modtestop.events = {
            onClick: function (formid) {
                console.log(mapForm($("#"+formid).attr("id")));
            }
        };
        var modal = modalify(modtestop);
        modal.modal("show");
    }
</script>

</html>



