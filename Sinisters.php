<?php
/**
 * Created by PhpStorm.
 * User: Javier Ramirez
 * Date: 04/12/2018
 * Time: 11:17 AM
 */

date_default_timezone_set('America/Mexico_City');

include_once "connection.php";

function displaycardTitle($type)
{
    switch ($_GET["mode"]) {
        case "view":
            return "<h5 class='card-title'>Eventos de siniestro</h5>
                  <p class='card-category'>Ultimos eventos agregados</p> <br>
                  <button class='btn btn-sm' onclick='newEvent()'>Nuevo evento <span class='fa fa-plus'></span></button>
                  ";
            break;
        case "edit":
            return "<h5 class='card-title'>Editar evento de siniestro</h5>
                  <p class='card-category'></p>";
            break;
        case "new":
            return "<h5 class='card-title'>Nuevo evento de siniestro</h5>
                  <p class='card-category'></p>";
            break;

    }
}

function getSinisterData($sid)
{
    $db = db();
    return $db->select("sinisters_info", "*", ["sinister_id" => $sid]);
}

function displaySinisterMode()
{
    $mode = $_GET["mode"];
    switch ($mode) {
        case "view":
            return displaySinisterTable();
            break;
        case "edit":
            return displayEditSinister();
            return;
        case "new":

            break;
    }
}

function displaySinisterEdit()
{

}

function displaySinisterTable()
{
    $db = db();
    if (isset($_GET["pageno"])){
        $page = $_GET["pageno"];
    }else{
        $page = 1;
    }
    if ($page === 1){
        $limit = 0;
    }else{
        $limit = (($page - 1) * 10);
    }
    $query = sprintf("SELECT * FROM `sinisters_info` ORDER BY `sinister_datetime` DESC LIMIT $limit,10");
    $data = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    $rows = formatTable($data);
    $table = "<table class='table table-striped table-bordered table-sm'>
                                <thead style='font-size: 0.8rem;'>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Linea</th>
                                        <th>Site</th>
                                        <th>Cuenta</th>
                                        <th>Tipo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>";
    return $table . $rows;
}

function pendingCertificationsTotal(){
    $db = db();
    $query = "SELECT COUNT(cert_request_status) AS count FROM cert_scheduling WHERE cert_request_status = 0";
    $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]["count"];
}

function displayCertificationsDashboard(){
    $total = pendingCertificationsTotal();
    echo sprintf("<div class=\"row\">
                                <div class=\"col-md-12\">
                                    <div class=\"row\">
                                        <div class=\"col-md-4\">
                                            <div class=\"card\">
                                                <div class=\"card-header\">
                                                    <h6>Indicador del mes</h6>
                                                </div>
                                                <div class=\"card-body\">
                                                    <canvas id=\"samplechart\" height=\"250px;\"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=\"col-md-8\">
                                            <div class=\"card\">
                                                <div class=\"card-header\">
                                                    <h6>Certificaciones 2018</h6>
                                                </div>
                                                <div class=\"card-body\">
                                                    <div class=\"chart-wrapper\">
                                                        <canvas id=\"sample2\" height=\"250px;\"></canvas>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=\"row\">
                                <div class=\"col-md-12\">
                                    <div class=\"row\">
                                        <div class=\"col-md-4\">
                                            <div class=\"card bg-light\" style=\"min-height: 200px;\">
                                                <div class=\"card-header\">
                                                    <h3 style=\"margin-bottom: 0px;\">Certificaciones</h3>
                                                    <p style=\"margin-bottom: 0px;\">Realizadas</p>
                                                </div>
                                                <div class=\"card-body\">
                                                    <div id='cert-done-count' class=\"cert-count\">
                                                        0
                                                    </div>
                                                </div>
                                                <div class=\"card-footer\">

                                                </div>
                                            </div>
                                        </div>
                                        <div class=\"col-md-4\">
                                            <div class=\"row\">
                                                <div class=\"col-md-6\">
                                                    <div class=\"row\">
                                                        <div class=\"col-md-12\">
                                                            <div class=\"card bg-light\">
                                                                <div class=\"card-header card-header-centered\">
                                                                    <h6>Aprobados</h6>
                                                                </div>
                                                                <div class=\"card-body\">
                                                                    <div id='cert-approved' class=\"card-counter-sm\">
                                                                        0
                                                                    </div>
                                                                </div>
                                                                <div class=\"card-footer\"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=\"row\">
                                                        <div class=\"col-md-12\">
                                                            <div class=\"card bg-light\">
                                                                <div class=\"card-header card-header-centered\">
                                                                    <h6>Rechazados</h6>
                                                                </div>
                                                                <div class=\"card-body\">
                                                                    <div id='cert-rejected-count' class=\"card-counter-sm\">
                                                                        0
                                                                    </div>
                                                                </div>
                                                                <div class=\"card-footer\"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=\"col-md-6\">
                                                    <div class=\"row\">
                                                        <div class=\"col-md-12\">
                                                            <div class=\"card bg-light\">
                                                                <div class=\"card-header card-header-centered\">
                                                                    <h6>Declinados</h6>
                                                                </div>
                                                                <div class=\"card-body\">
                                                                    <div id='cert-declined-count' class=\"card-counter-sm\">
                                                                        0
                                                                    </div>
                                                                </div>
                                                                <div class=\"card-footer\"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=\"col-md-4\">
                                            <div class=\"card bg-light\" style=\"min-height: 200px;\">
                                                <div class=\"card-header\">
                                                    <h3 style=\"margin-bottom: 0px;\">Certificaciones</h3>
                                                    <p style=\"margin-bottom: 0px;\">Pendientes por realizar</p>
                                                </div>
                                                <div class=\"card-body\">
                                                    <div class=\"cert-count-pending\" id='pending_certs'>
                                                        %s
                                                        <a href='certifications.php' class='cert-link'>Ver certificaciones pendientes <span class='fa fa-external-link-alt'></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>",$total);
}

function newEvent()
{
    $db = db();
    $result = $db->insert("sinisters", ["sinister_event_capture_timestamp" => date("Y-m-d H:i:s")]);
    return $db->id();
}


function displayEditSinister()
{
    if (isset($_GET["newevent"])) {
        $sid = newEvent();
    } else {
        $sid = $_GET["sid"];
    }
    $data = getSinisterData($sid);

    $name = join(" ", [$data[0]["person_name"], $data[0]["person_fname"], $data[0]["person_lname"]]);
    $sinplaca = $data[0]["v_tag"];
    $sinfevento = $data[0]["sinister_datetime"];
    $sinleavdatetime = $data[0]["sinister_trleave_datetime"];
    $sinmsite = $data[0]["site_alias"];
    $sinmcliente = $data[0]["client_alias"];
    $sinmoperandi = $data[0]["sinister_moperandi"];
    $sinmonto = $data[0]["sinister_ammount"];
    $sinsgps = $data[0]["sinister_gps_system"];
    $sinmappoint = $data[0]["sinister_map_point"];
    $sinarrmappoint = explode(",", $data[0]["sinister_map_point"]);
    $sinexpop = $data[0]["sinister_op_exp"];
    $sinexpay = $data[0]["sinister_ay_exp"];
    if ($sinmappoint === "" || $sinmappoint === null) {
        $coords = "";
    } else {
        $lat = $sinarrmappoint[0];
        $long = $sinarrmappoint[1];
        $coords = "{\"lat\" : $lat, \"lng\" : $long}";
    }

    return "<div class='tab-wrapper'>
                                <div class='row'>
                                <input type='hidden' id='eventid' data-eventid='$sid' />
                                <input type='hidden' id='coords' data-coords='$coords' />
                                    <div class='col-md-12 d-flex justify-content-end'>
                                        <div class='lastsaved mr-2 text-danger' id='lastsaved'></div>
                                        <button class='btn btn-sm' onclick=\"saveSinister()\">Guardar datos</button>
                                        <button class='btn btn-sm ml-3'>Generar reporte preliminar</button>
                                    </div>
                                </div>
                                <ul class='nav nav-tabs' id='sinister-edit' role='tablist'>
                                    <li class='nav-item'>
                                        <a class='nav-link active' id='home-tab' data-toggle='tab' href='#persons'
                                           role='tab'>Personas</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link' id='tab-1' data-toggle='tab' href='#vehicles' role='tab'>Vehiculos</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link' id='tab-1' data-toggle='tab' href='#evento' role='tab'>Evento</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link' id='tab-1' data-toggle='tab' href='#archivos' role='tab'>Archivos</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link' id='tab-1' data-toggle='tab' href='#observaciones'
                                           role='tab'>Observaciones</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link' id='tab-1' data-toggle='tab' href='#logicsinfo'
                                           role='tab'>Logics</a>
                                    </li>
                                </ul>
                                <form id='sinisterdata' enctype='multipart/form-data' method='post'>
                                <div class='tab-content'>
                                    <div class='tab-pane active' id='persons' role='tab-panel'>
                                        <div class='row'>
                                            <div class='col-md-6'>
                                                <div class='input-group input-group-sm mt-3'>
                                                    <div class='input-group-prepend'>
                                                        <span class='input-group-text' id=''>Operador</span>
                                                    </div>
                                                    <input id='pautocomplete' class='form-control form-control-sm' type='text' value='$name'/>
                                                    <div class='input input-group-append'>
                                                        <button class='btn btn-outline-secondary' type='button' onclick=\"openmmodal('mperson')\">
                                                            <span class='fa fa-ellipsis-h'></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-md-6'></div>
                                        </div>
                                    </div>
                                    <div class='tab-pane' id='vehicles' role='tab-panel'>
                                        <div class='row'>
                                            <div class='col-md-6'>
                                                <div class='input-group input-group-sm mt-3'>
                                                    <div class='input-group-prepend'>
                                                        <span class='input-group-text'>Placas del vehiculo</span>
                                                    </div>
                                                    <input id='vautocomplete' type='text' data-vid='' class='form-control form-control-sm' value='$sinplaca'/>
                                                    <div class='input-group-append'>
                                                        <button type='button' class='btn btn-outline-secondary' onclick=\"openmmodal('mveh')\">
                                                            <span class='fa fa-ellipsis-h'></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='tab-pane' id='evento' role='tab-panel'>
                                        <div class='row mt-3'>
                                            <div class='col-md-12'>
                                                <div class='row'>
                                                    <div class='col-md-3'>
                                                        <input id='eventdatetime' class='form-control form-control-sm'
                                                               placeholder='Fecha y hora del evento' value='$sinfevento' name='sinister_datetime' />
                                                    </div>
                                                    <div class='col-md-3'>
                                                        <input id='siteleavedatetime' class='form-control form-control-sm'
                                                               placeholder='Salida del site' value='$sinleavdatetime' name='sinister_trleave_datetime'/>
                                                    </div>
                                                    <div class='col'>
                                                        <div class='switch'>
                                                            <input class='cmn-toggle cmn-toggle-round-flat'
                                                                   type='checkbox'>
                                                            <label for='sample'></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-md-12'>
                                                <div class='row'>
                                                    <div class='col'>
                                                        <div class='input-group input-group-sm'>
                                                            <input id='sautocomplete' type='text' placeholder='Site de origen'
                                                                   class='form-control' value='$sinmsite'/>
                                                            <div class='input-group-append'>
                                                                <button type='button'
                                                                        class='btn btn-sm btn-outline-secondary'
                                                                        style='margin: 0px;' onclick=\"openmmodal('msites')\">
                                                                    <span class='fa fa-ellipsis-h'></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='col'>
                                                        <div class='input-group input-group-sm'>
                                                            <input id='cautocomplete' type='text' placeholder='Cliente de origen'
                                                                   class='form-control' value='$sinmcliente' disabled/>
                                                            <div class='input-group-append'>
                                                                <button type='button'
                                                                        class='btn btn-sm btn-outline-secondary'
                                                                        style='margin: 0px;' onclick=\"openmmodal('mclients')\">
                                                                    <span class='fa fa-ellipsis-h'></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='col'>
                                                        <div class='input-group input-group-sm'>
                                                            <div class='input-group-prepend'>
                                                                <span class='input-group-text'>
                                                                    Modus operandi
                                                                </span>
                                                            </div>
                                                            <select class='form-control'
                                                                    style='padding-top: 3px;padding-bottom: 0px' name='sinister_moperandi'>
                                                                <option>Amago</option>
                                                                <option>Reten</option>
                                                                <option>Corte de circulacion</option>
                                                                <option>Unidad detenida</option>
                                                                <option>Unidad con cliente</option>
                                                                <option>Perdida de señal</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-md-12'>
                                                <div class='row'>
                                                    <div class='col'>
                                                        <div class='input-group input-group-sm'>
                                                            <div class='input-group-prepend'>
                                                                <span class='input-group-text'>Tipo de evento</span>
                                                            </div>
                                                            <select class='form-control'
                                                                    style='padding-top: 3px;padding-bottom: 0px;' name='sinister_kind'>
                                                                <option value='HJ'>Robo total</option>
                                                                <option value='HJR'>Robo frustrado</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class='col'>
                                                        <div class='input-group input-group-sm'>
                                                            <div class='input-group-prepend'>
                                                                <span class='input-group-text'> Monto $</span>
                                                            </div>
                                                            <input type='text' class='form-control' value='$sinmonto' name='sinister_ammount'>
                                                        </div>
                                                    </div>
                                                    <div class='col'>
                                                        <div class='input-group input-group-sm'>
                                                            <div class='input-group-prepend'>
                                                                <span class='input-group-text'>Sistema GPS</span>
                                                            </div>
                                                            <input type='text' class='form-control' value='$sinsgps' name='sinister_gps_system'>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-md-12'>
                                                <div class='row'>
                                                    <div class='col-md-12'>
                                                        <div class='input-group input-group-sm'>
                                                            <div class='input-group-prepend'>
                                                                <span class='input-group-text'>Coordenadas del evento : </span>
                                                            </div>
                                                            <input id='mapspoint' type='text' class='form-control' value='$sinmappoint' name='sinister_map_point'/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-md-12'>
                                                <div class='row'>
                                                    <div id='map' class='col-md-12' style='height: 500px;'>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='tab-pane' id='archivos' role='tab-panel'>
                                        <div class='row'>
                                            <div class='col-md-6 mt-2'>
                                                <div class='input-group input-group-sm'>
                                                    <div class='input-group-prepend'>
                                                        <span class='input-group-text'>Reporte callcenter </span>
                                                    </div>
                                                    <div class='custom-file'>
                                                        <input id='sinister_call_report' name='sinister_call_report' type='file' class='custom-file-input' />
                                                        <label for='sinister_call_report' class='custom-file-label'>Cargar archivo</label>
                                                    </div>
                                                </div>
                                                <div class='input-group input-group-sm'>
                                                    <div class='input-group-prepend'>
                                                        <span class='input-group-text'>Reporte preliminar </span>
                                                    </div>
                                                    <div class='custom-file'>
                                                        <input id='sinister_pre_report' name='sinister_pre_report' type='file' class='custom-file-input' />
                                                        <label for='sinister_pre_report' class='custom-file-label'>Cargar archivo</label>
                                                    </div>
                                                </div>
                                                <div class='input-group input-group-sm'>
                                                    <div class='input-group-prepend'>
                                                        <span class='input-group-text'>Reporte entrevista </span>
                                                    </div>
                                                    <div class='custom-file'>
                                                        <input id='sinister_interv_report_id' type='file' name='sinister_interv_report_id' class='custom-file-input' />
                                                        <label for='sinister_interv_report_id' class='custom-file-label'>Cargar archivo</label>
                                                    </div>
                                                </div>
                                                <div class='input-group input-group-sm'>
                                                    <div class='input-group-prepend'>
                                                        <span class='input-group-text'>Entrevista profunda </span>
                                                    </div>
                                                    <div class='custom-file'>
                                                        <input id='sinister_deep_interv' type='file' name='sinister_deep_interv' class='custom-file-input' />
                                                        <label for='sinister_deep_interv' class='custom-file-label'>Cargar archivo</label>
                                                    </div>
                                                </div>
                                                <div class='input-group input-group-sm'>
                                                    <div class='input-group-prepend'>
                                                        <span class='input-group-text'>Bol report </span>
                                                    </div>
                                                    <div class='custom-file'>
                                                        <input id='sinister_bol_report' type='file' name='sinister_bol_report' class='custom-file-input' />
                                                        <label for='sinister_bol_report' class='custom-file-label'>Cargar archivo</label>
                                                    </div>
                                                </div>
                                                <div class='input-group input-group-sm'>
                                                    <div class='input-group-prepend'>
                                                        <span class='input-group-text'>Check list </span>
                                                    </div>
                                                    <div class='custom-file'>
                                                        <input id='sinister_check_list' type='file' name='sinister_check_list' class='custom-file-input' />
                                                        <label for='sinister_check_list' class='custom-file-label'>Cargar archivo</label>
                                                    </div>
                                                </div>
                                                <div class='input-group input-group-sm'>
                                                    <div class='input-group-prepend'>
                                                        <span class='input-group-text'>Papeleta de salida </span>
                                                    </div>
                                                    <div class='custom-file'>
                                                        <input id='sinister_exit_pass' type='file' name='sinister_exit_pass' class='custom-file-input' />
                                                        <label for='sinister_exit_pass' class='custom-file-label'>Cargar archivo</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-md-6'>

                                                <div class='input-group input-group-sm'>
                                                    <div class='input-group-prepend'>
                                                        <span class='input-group-text'>Facturas </span>
                                                    </div>
                                                    <div class='custom-file'>
                                                        <input id='sinister_bills' type='file' name='sinister_bills' class='custom-file-input' />
                                                        <label for='sinister_bills' class='custom-file-label'>Cargar archivo</label>
                                                    </div>
                                                </div>
                                                <div class='input-group input-group-sm'>
                                                    <div class='input-group-prepend'>
                                                        <span class='input-group-text'>Poleo </span>
                                                    </div>
                                                    <div class='custom-file'>
                                                        <input id='sinister_poleo' type='file' name='sinister_poleo' class='custom-file-input' />
                                                        <label for='sinister_poleo' class='custom-file-label'>Cargar archivo</label>
                                                    </div>
                                                </div>
                                                <div class='input-group input-group-sm'>
                                                    <div class='input-group-prepend'>
                                                        <span class='input-group-text'>Acta MP </span>
                                                    </div>
                                                    <div class='custom-file'>
                                                        <input id='sinister_mp_act' type='file' name='sinister_mp_act' class='custom-file-input' />
                                                        <label for='sinister_mp_act' class='custom-file-label'>Cargar archivo</label>
                                                    </div>
                                                </div>
                                                <div class='input-group input-group-sm'>
                                                    <div class='input-group-prepend'>
                                                        <span class='input-group-text'>Cert. del operador </span>
                                                    </div>
                                                    <div class='custom-file'>
                                                        <input id='sinister_person_cert_card' type='file' name='sinister_person_cert_card' class='custom-file-input' />
                                                        <label for='sinister_person_cert_card' class='custom-file-label'>Cargar archivo</label>
                                                    </div>
                                                </div>
                                                <div class='input-group input-group-sm'>
                                                    <div class='input-group-prepend'>
                                                        <span class='input-group-text'>Cert Ayudante </span>
                                                    </div>
                                                    <div class='custom-file'>
                                                        <input id='sinister_helper_certid' type='file' name='sinister_helper_certid' class='custom-file-input' />
                                                        <label for='sinister_helper_certid' class='custom-file-label'>Cargar archivo</label>
                                                    </div>
                                                </div>
                                                <div class='input-group input-group-sm'>
                                                    <div class='input-group-prepend'>
                                                        <span class='input-group-text'>Rep. entrevista ayudante </span>
                                                    </div>
                                                    <div class='custom-file'>
                                                        <input id='sinister_helper_pre_report' type='file' name='sinister_helper_pre_report' class='custom-file-input' />
                                                        <label for='sinister_helper_pre_report' class='custom-file-label'>Cargar archivo</label>
                                                    </div>
                                                </div>
                                                <div class='input-group input-group-sm'>
                                                    <div class='input-group-prepend'>
                                                        <span class='input-group-text'>Ent. profunda ayudante</span>
                                                    </div>
                                                    <div class='custom-file'>
                                                        <input id='sinister_helper_deep_report' type='file' name='sinister_helper_deep_report' class='custom-file-input' />
                                                        <label for='sinister_helper_deep_report' class='custom-file-label'>Cargar archivo</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='tab-pane' id='observaciones' role='tab-panel'>
                                        <div class='row'>
                                            <div class='col-md-6'>
                                                <div class='input-group mt-3'>
                                                    <div class='input-group-prepend'>
                                                        <span class='input-group-text'>
                                                            Exp. Operador
                                                        </span>
                                                    </div>
                                                    <textarea class='form-control' name='sinister_op_exp'>$sinexpop</textarea>
                                                </div>
                                            </div>
                                            <div class='col-md-6'>
                                                <div class='input-group mt-3'>
                                                    <div class='input-group-prepend'>
                                                        <span class='input-group-text'>
                                                            Exp. Ayudante
                                                        </span>
                                                    </div>
                                                    <textarea class='form-control' name='sinister_ay_exp'>$sinexpay</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='tab-pane' id='logicsinfo' role='tab-panel'>
                                        <div class='row'>
                                            <div class='col-md-6'>
                                                <div class='input-group input-group-sm'>
                                                    <div class='input-group-prepend'>
                                                        <span class='input-group-text'>Logics incident</span>
                                                    </div>
                                                    <input type='text' class='form-control' name='sinister_logics_incident' />
                                                </div>
                                            </div>
                                            <div class='col-md-6'>
                                                <div class='input-group input-group-sm'>
                                                    <div class='input-group-prepend'>
                                                        <span class='input-group-text'>Logics incident</span>
                                                    </div>
                                                    <input type='text' class='form-control' name='sinister_logics_subincident' />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>";
}

function formatTable($data)
{
    $rows = "";
    for ($i = 0; $i < count($data); $i++) {
        $rows .= sprintf("<tr>
                     <td>%s</td>
                     <td>%s</td>
                     <td>%s</td>
                     <td>%s</td>
                     <td>%s</td>
                     <td>
                         <div class='btn-group' role='group'>
                             <button class='btn btn-secondary btn-sm' data-sinister='%s' onclick=\"editSinister($(this))\"><span class='fa fa-edit'></span></button>
                             <button class='btn btn-secondary btn-sm' data-sinister='%s' onclick=\"openSinisterView($(this))\"><span class='fa fa-external-link'></span></button>
                         </div>
                     </td>
                 </tr>", formatString($data[$i]["sinister_datetime"]), formatString($data[$i]["provider_name"]), formatString($data[$i]["site_alias"]), formatString($data[$i]["client_alias"]), formatString($data[$i]["sinister_kind"]), $data[$i]["sinister_id"], $data[$i]["sinister_id"]);
    }
    return $rows;

}

function displayPagination()
{
    $db = db();
    $count = $db->count("sinisters");
    $pagination = "<nav>
                      <ul class='pagination'>";
    $pages = ($count / 10);
    $pages = ceil($pages);
    for ($i = 0; $i < $pages; $i++){
        $page = $i + 1;
        $pagination .= "<li class='page-item'><a class='page-link' href='dashboard.php?page=sinisters&mode=view&pageno=$page'>$page</a></li>";
    }
    return $pagination;
}

function formatString($value)
{
    return $value != "" ? $value : "N/A";
}

?>