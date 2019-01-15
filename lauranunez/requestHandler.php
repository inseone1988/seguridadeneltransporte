<?php
/**
 * Created by PhpStorm.
 * User: Javier Ramirez
 * Date: 14/01/2019
 * Time: 02:22 PM
 */
require $_SERVER["DOCUMENT_ROOT"] . '/seguridadeneltransporte/connection.php';

function saveSchedule(){
    $db = db();
    $result = $db->insert("cert_scheduling",$_POST["data"]);
    if ($db->id() != 0){
        echo json_encode([
            "success"=>true,
            "id"=>$db->id()
        ]);
    }else{
        echo json_encode([
            "success"=>false,
            "error"=>$db->error()
        ]);
    }
}

function updateSchedule(){
    $data = $_POST["data"];
    $db = db();
    $result = $db->update("cert_scheduling",$data,["idcert_scheduling"=>$data["idcert_scheduling"]]);
    if ($result->rowCount() != 0){
        echo json_encode([
            "success"=>true
        ]);
    }else{
        echo json_encode([
            "success" => false,
            "error"=>$db->error()
        ]);
    }
}

function newSchedule(){
    $db = db();
    $now = date("Y-m-d H:i:s");
    $result = $db->insert("cert_scheduling",["cert_request_date"=>$now]);
    if ($db->id() != 0){
        echo json_encode([
            "success"=>true,
            "payload"=>[
                "id"=>$db->id(),
                "date"=>$now
            ]
        ]);
    }else{
        echo json_encode([
            "success"=>false,
            "error"=>$db->error()
        ]);
    }
}

function getPendingCerts(){
    $db = db();
    $result = $db->select("cert_scheduling","*",["cert_request_status"=>0]);
    if (count($result) > 0){
        echo json_encode([
            "success" => true,
            "payload" => $result
        ]);
    }else{
        echo json_encode([
            "success" => false,
            "error" => $db->error()
        ]);
    }
}

if (isset($_POST["function"])){
    switch ($_POST["function"]){
        case "saveSchedule":
            updateSchedule();
            break;
        case "getFolio":
            newSchedule();
            break;
        case "getPendingCerts":
            getPendingCerts();
            break;
    }
}

?>