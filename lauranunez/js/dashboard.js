var pendingCertifications;
var asigningCert;

function getPendingCertifications(callback) {
    getUsernames();
    $.ajax({
        url: "requesthandler.php",
        type: "POST",
        dataType: "JSON",
        data: {
            "function": "getPendingCerts"
        },
        success: function (r) {
            if (r.success) {
                pendingCertifications = r.payload;
                callback();
            }
        }
    });
}

function displayPendingCerts() {
    if (pendingCertifications.length > 0) {
        for (let i = 0; i < pendingCertifications.length; i++) {
            var current = pendingCertifications[i];
            var status = Number(current.cert_request_status) === 0 ? "No asignado" : "Asignado";
            var row = "<tr><td>" + current.cert_request_date + "</td><td>" + current.cert_comercial_name + "</td><td>" + current.cert_address + "</td><td onclick='showCertAssgModal("+current.idcert_scheduling+")'>" + current.cert_request_status_desc + "</td><td><div class='btn-group' role='group'><button title='Borrar solicitud' class='btn btn-sm btn-secondary'><span class='fa fa-trash'></span></button></div></td></tr>";
            $("#pending-certifications").append(row);
        }
    } else {

    }


}

function showCertAssgModal(edit) {
    asigningCert = edit;
    $("#asign-cert").modal("show");
}

function getUsernames() {
    $.ajax({
        url: "requesthandler.php",
        type: "POST",
        dataType: "JSON",
        data: {
            "function": "getUsernames"
        },
        success: function (r) {
            if (r.success) {
                mapUsernames(r.payload);
            }

        }
    });
}

function mapUsernames(usernames) {
    for (let i = 0; i < usernames.length; i++) {
        var option = "<option value='" + usernames[i].username + "'>" + usernames[i].username + "</option>";
        $("#cert_request_assigned_to").append(option);
    }
    return true;
}

function initdateTiemPicker(){
    $("#cert_request_schedule").datetimepicker({
        format : "Y-m-d H:i:s"
    });
}

function getSchedValues(){
    var assTo = $("#cert_request_assigned_to").val();
    var dateAssigned = $("#cert_request_schedule").val();
    if (assTo != "" && dateAssigned != ""){
        return {
            idcert_scheduling : asigningCert,
            cert_request_assigned_to : assTo,
            cert_request_schedule: dateAssigned,
            cert_request_status_desc : "Asignado"
        };
    } else {
        alert("Se deben capturar los dos campos");
    }
}

function saveScheduling(){
    var data = getSchedValues();
    $.ajax({
        url : "requestHandler.php",
        type : "POST",
        dataType : "JSON",
        data : {
            "function":"saveSchedule",
            "data":data
        },
        success : function(r){
            if (r.success){
                window.location.reload();
            }
        }
    });
}