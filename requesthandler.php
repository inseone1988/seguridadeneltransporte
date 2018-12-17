<?php
/**
 * Created by PhpStorm.
 * User: ZK-PC
 * Date: 03/12/2018
 * Time: 11:38 AM
 */

require_once "connection.php";

function getSinisterData($sid){
    $db = db();
    return $db->select("sinisters_info", "*",["sinister_id"=>$sid]);
}

function hasError($errordata){
    return $errordata[0] != "00000";
}

function loadSinisterdata($eventid){

}

function sites(){

}

function providers(){

}

function vehicles(){

}

function saveVehicle($data){
    $db = db();
    $result = $db->insert("vehicles",$data);
    if ($db->id() != 0){
        return [
            "success"=>true,
            "vid"=>$db->id()
        ];
    }
}

function saveProvider($data){
    $db = db();
    $result = $db->insert("providers",$data);
    if ($db->id() != 0){
        return [
            "success"=>true,
            "pid"=>$db->id()
        ];
    }
}

function saveTransport($data){
    $db = db();
    $result = $db->insert("providers",$data);
    if ($db->insert() != 0){
        return [
            "success"=>true,
            "pid"=>$db->id()
        ];
    }
}

function personAutoComplete($term){
    $query = sprintf("SELECT idpersons AS data, CONCAT_WS(' ',person_name,person_fname,person_lname) AS value FROM persons WHERE person_name REGEXP '%s' ",$term);
    $db = db();
    $response = [];
    $response["suggestions"] = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    return $response;
}

function vehicleAutocomplete($term){
    $query = sprintf("SELECT v_id AS data, v_tag AS value FROM vehicles WHERE v_tag REGEXP '%s'",$term);
    $db = db();
    $response = [];
    $response["suggestions"] = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    return $response;
}

function sitesAutocomplete($term){
    $query = sprintf("SELECT site_id AS data, site_name AS value FROM sites WHERE site_name REGEXP '%s'",$term);
    $db = db();
    $response = [];
    $response["suggestions"] = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    return $response;
}

function clientAutocomplete($term){
    $query = sprintf("SELECT client_id AS data, client_name AS value FROM clients WHERE client_name REGEXP '%s'",$term);
    $db = db();
    $response = [];
    $response["suggestions"] = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    return $response;
}

function providerAutocomplete($term){
    $query = sprintf("SELECT provider_id AS data, provider_alias AS value FROM providers WHERE provider_alias REGEXP '%s'",$term);
    $db = db();
    $response = [];
    $response["suggestions"] = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    return $response;
}

function updateSinister($data){
    $db = db();
    $result = $db->update("sinisters",$data,["sinister_id"=>$data["sinister_id"]]);
    if (!hasError($db->error())){
        return [
            "success"=>true,
            "last"=>$db->last()
        ];
    }else{
        return [
            "success"=>false,
            "error"=>$db->error()
        ];
    }
}

function saveEvidencePath($sinisterid,$field,$value){
    $db = db();
    $result = $db->update("sinisters",[$field=>$value],["sinister_id"=>$sinisterid]);
    //var_dump($db->error());
    return $result;
}

function uploadFile($file,$sinisterid){
    if (count($file) > 0){
        foreach ($file as $item) {
            $field = key($file);
            $handle = new upload($item);
            if ($handle->uploaded){
                $handle->process(__DIR__ . '/uploads/');
            }
            if ($handle->processed){
                $path = "/seguridadeneltransporte/uploads/" . $handle->file_dst_name;
                saveEvidencePath($sinisterid,$field,$path);
                return [
                    "success"=>true,
                    "path"=>$path
                ];
            }
        }
    }
}

function savePerson($data){
    $db = db();
    $result = $db->insert("persons",$data);
    //var_dump($db->error());
    if ($db->id() != 0){
        return ["success"=>true,"id"=> $db->id()];
    }else{
        return [
            "success"=>false,
            "error"=>$db->error(),
            "last"=>$db->last()
        ];
    }

}

function uploadProfilePhoto($file){
    if (count($file) > 0){
        foreach ($file as $item) {
            $handle = new upload($item);
            if ($handle->uploaded){
                $handle->process(__DIR__ . '/uploads/profilephotos');
            }
            if ($handle->processed){
                $path = "/seguridadeneltransporte/uploads/" . $handle->file_dst_name;
                return ["photopath"=>"/seguridadeneltransporte/uploads/profilephotos/" . $handle->file_dst_name];
            }
        }
    }
}

function saveSite($data){
    $db = db();
    $result = $db->insert("sites",$data);
    if (!hasError($db->error())){
        return [
            "success"=>true,
            "id"=>$db->id()
        ];
    }else{
        return ["success"=>false,"error"=>$db->error()];
    }
}
function saveClient($data){
    $db = db();
    $result = $db->insert("clients",$data);
    if (!hasError($db->error())){
        return [
            "success"=>true,
            "id"=>$db->id()
        ];
    }else{
        return ["success"=>false,"error"=>$db->error()];
    }
}

if (isset($_POST["function"])){
    switch ($_POST["function"]){
        case "loadevent":
            break;
        case "opAutocomplete":
            echo json_encode(personAutoComplete($_POST["query"]));
            break;
        case "vAutocomplete":
            echo json_encode(vehicleAutocomplete($_POST["query"]));
            break;
        case "siteAutocomplete":
            echo json_encode(sitesAutocomplete($_POST["query"]));
            break;
        case "clientAutocomplete":
            echo json_encode(clientAutocomplete($_POST["query"]));
            break;
        case "providerAutocomplete":
            echo json_encode(providerAutocomplete($_POST["query"]));
            break;
        case "updateEvent":
            echo json_encode(updateSinister($_POST["data"]));
            break;
        case "saveSinisterEvidence":
            echo json_encode(uploadFile($_FILES,$_POST["sinisterid"]));
            break;
        case "saveProfilePhoto":
            echo json_encode(uploadProfilePhoto($_FILES));
            break;
        case "newPerson":
            echo json_encode(savePerson($_POST["data"]));
            break;
        case "saveVehicle":
            echo json_encode(saveVehicle($_POST["data"]));
            break;
        case "savetransport":
            echo json_encode(saveProvider($_POST["data"]));
            break;
        case "saveSite":
            echo json_encode(saveSite($_POST["data"]));
            break;
        case "saveClient":
            echo json_encode(saveClient($_POST["data"]));
            break;
    }
}