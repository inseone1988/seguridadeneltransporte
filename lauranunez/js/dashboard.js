var pendingCertifications;
function getPendingCertifications(callback){
    $.ajax({
        url : "requesthandler.php",
        type : "POST",
        dataType : "JSON",
        data : {
            "function" : "getPendingCerts"
        },
        success : function(r){
            if (r.success) {
                pendingCertifications = r.payload;
                callback();
            }
        }
    });
}

function displayPendingCerts(){
    for (let i = 0; i < pendingCertifications.length; i++) {
        var current = pendingCertifications[i];
        var status = current.cert_request_status === 0 ? "No asignado" : "Asignado";
        var row = "<tr><td>"+current.cert_request_date+"</td><td>"+current.cert_comercial_name+"</td><td>"+current.cert_address+"</td><td>"+status+"</td><td>cell</td></tr>";
        $("#pending-certifications").append(row);
    }

}