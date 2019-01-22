<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/seguridadeneltransporte/connection.php";

    use \Delight\Auth\Auth;

    function auth(){
        global $pdo;
        return new Auth($pdo);
    }

    function checkUserIsLoggedIn(){
        startSession();
        if (!userIsLoggedIn()){
            redirectToLoginPage();
        }
    }

    function startSession(){
        if (!sessionCheck()){
            session_start();
        }
    }

    function redirectToLoginPage(){
        $referer = $_SERVER["PHP_SELF"];
        if (!userIsLoggedIn()){
            $url = '/seguridadeneltransporte?referer=' . $referer . "&redirect=true";
            header('Location:' . $url);
        }
    }

    function redirectToReferer(){
        $ref = $_GET["referer"];
        header("Location:/seguridadeneltransporte" . $ref);
    }

    function redirectToDashboard(){
        switch ($_SESSION["auth_username"]){
            case "Laura Nuñez":
                header("Location:/seguridadeneltransporte/lauranunez");
                break;
            default :
                header("Location:/seguridadeneltransporte/dashboard.php?page=sinisters&mode=view");
                break;
        }
    }

    function userIsLoggedIn(){
        return $_SESSION["auth_logged_in"];
    }

    function logout(){
        $auth = auth();
        try{
            $auth->logOut();
        }catch(\Delight\Auth\NotLoggedInException $e){
            echo $e->getMessage();
        }
    }

    function sessionCheck(){
        return isset($_SESSION);
    }

    function createUser($mail,$user,$password){
        try{
            $aut = auth();
            $response = [];
            $userid = $aut->register($mail,$password,$user);
            $response["userid"] = $userid;
            return $response;
        }
        catch(\Delight\Auth\InvalidEmailException $e){
            echo $e->getMessage();
        }
        catch (\Delight\Auth\InvalidPasswordException $e){
            echo $e->getMessage();
        }
        catch(\Delight\Auth\UserAlreadyExistsException $e ){
            echo $e->getMessage();
        }
        catch (\Delight\Auth\TooManyRequestsException $e){
            echo $e->getMessage();
        }
    }

    function login($mail,$password,$callback){
        try{
            $auth = auth();
            $auth->loginWithUsername($mail,$password);
            if ($callback != null){
                $callback();
            }
        }
        catch(\Delight\Auth\InvalidEmailException $e){
            echo $e->getMessage();
        }
        catch (\Delight\Auth\InvalidPasswordException $e){
            echo $e->getMessage();
        }
        catch(\Delight\Auth\UserAlreadyExistsException $e ){
            echo $e->getMessage();
        }
        catch (\Delight\Auth\TooManyRequestsException $e){
            echo $e->getMessage();
        }
    }

    if (isset($_POST["function"])){
        switch ($_POST["function"]){
            case "newUser":
                    echo json_encode(createUser($_POST["mail"],$_POST["user"],$_POST["password"]));
                break;
            case "login":
                //echo json_encode(login($_POST["mail"],$_POST["password"]));
                break;
        }
    }
?>