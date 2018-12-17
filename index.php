<?php
 require_once "utils/AuthManager.php";

if (isset($_POST["function"])){
    switch ($_POST["function"]){
        case "login":
            login($_POST["user"],$_POST["password"],function(){
                if (userIsLoggedIn()){
                    if (isset($_GET["referer"])){
                        redirectToReferer();
                    }else{
                        redirectToDashboard();
                    }
                }
            });
            break;
    }
}

if (isset($_GET["function"])){
    switch ($_GET["function"]){
        case "logout":
            logout();
            break;
        case "createUser":
            createUser($_GET["mail"],$_GET["user"],$_GET["password"]);
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Seguridad en el transporte</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/coming-soon.min.css" rel="stylesheet">

</head>

<body>

<div class="overlay"></div>
<video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
    <source src="mp4/bg.mp4" type="video/mp4">
</video>

<div class="masthead">
    <div class="masthead-bg"></div>
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-12 my-auto">
                <div class="img-wrapper">
                    <img class="img-fluid" src="img/st_logo_complete.svg" />
                </div>
                <div class="masthead-content text-dsc py-5 py-md-0">
                    <h6 class="mb-3">Seguridad en el transporte</h6>
                    <p class="mb-2">Seguridad en transporte DHL<br>
                        Shielding aasets delivering solutions!</p>
                    <form id="loginform" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                        <input type="hidden" name="function" value="login">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Usuario :</span>
                        </div>
                        <input name="user" type="text" class="form-control" aria-describedby="basic-addon">
                    </div>
                    <div class="input-group input-group-sm mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Contraseña :</span>
                        </div>
                        <input name="password" type="password" class="form-control" aria-describedby="basic-addon">
                    </div>
                    <div class="btn-wrapper mt-2" style="float: right;">
                        <button type="submit" class="btn btn-primary bg-dsc text-dsc">Ingresar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--
<div class="social-icons">
  <ul class="list-unstyled text-center mb-0">
    <li class="list-unstyled-item">
      <a href="#">
        <i class="fab fa-twitter"></i>
      </a>
    </li>
    <li class="list-unstyled-item">
      <a href="#">
        <i class="fab fa-facebook-f"></i>
      </a>
    </li>
    <li class="list-unstyled-item">
      <a href="#">
        <i class="fab fa-instagram"></i>
      </a>
    </li>
  </ul>
</div>-->

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Custom scripts for this template -->
<script src="js/coming-soon.min.js"></script>
<script>
</script>
</body>

</html>
