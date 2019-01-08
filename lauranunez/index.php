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
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>Paper Dashboard by Creative Tim</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>


    <!-- Bootstrap core CSS     -->
    <link href="/seguridadeneltransporte/assets/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Animation library for notifications   -->
    <link href="/seguridadeneltransporte/assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="/seguridadeneltransporte/assets/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="/seguridadeneltransporte/assets/css/themify-icons.css" rel="stylesheet">
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


</div>
<!--START MODALS -->
<div id="mmodal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                Hello
                            </span>
                            <input type="text" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="buton" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>
</body>
<!--   Core JS Files   -->
<script src="/seguridadeneltransporte/assets/js/jquery.min.js" type="text/javascript"></script>
<script src="/seguridadeneltransporte/assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="/seguridadeneltransporte/assets/js/bootstrap-checkbox-radio.js"></script>

<!--  Charts Plugin -->
<script src="/seguridadeneltransporte/assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="/seguridadeneltransporte/assets/js/bootstrap-notify.js"></script>
<script src="/seguridadeneltransporte/node_modules/moment/moment.js"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="/seguridadeneltransporte/assets/js/paper-dashboard.js"></script>
<script>
    $(document).ready(function () {
        $("#mmodal").modal("show");
    })


    function saveSolictante(data){
        $.ajax({
            url:"requesthandler.php",
            type : "POST",
            dataType : "JSON",
            data : {
                "function":"",
                "data":data
            },
            success : function(r){
                if (r.success){

                }
            }
        });
    }
</script>

</html>



