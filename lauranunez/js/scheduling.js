var autosave;

var cert = {
    autoSave : false,
    lastSaved : "",
    data: {
        idcert_scheduling : 0,
        cert_solicitante : "",
        cert_area_solicitante : "",
        cert_contact_name : "",
        cert_contact_phone : "",
        cert_contact_mail : "",
        cert_transp_social : "",
        cert_comercial_name : "",
        cert_acc_sector : "",
        cert_rs_change_reason : "",
        cert_address : "",
        cert_request_date : "",
        cert_request_schedule : "",
        cert_request_assigned_to : "",
        cert_coords : ""
    },
    save : function(){
        getValues();
        if (this.data.idcert_scheduling === 0) {
            this.getFolio(function(){
                $.ajax({
                    url : "requesthandler.php",
                    type : "POST",
                    dataType : "JSON",
                    data : {
                        "function":"saveSchedule",
                        "data" : cert.data
                    },
                    success : function(r){
                        if (r.success) {
                            alert("Saved succesfully !!!");
                        }
                    }
                });
            });
        }else{
            $.ajax({
                url : "requesthandler.php",
                type : "POST",
                dataType : "JSON",
                data : {
                    "function":"saveSchedule",
                    "data" : cert.data
                },
                success : function(r){
                    if (r.success) {
                        alert("Saved succesfully !!!");
                    }
                }
            });
        }
    },
    getFolio : function(callback){
        $.ajax({
            url : "requesthandler.php",
            type : "POST",
            dataType : "JSON",
            data : {
                "function" : "getFolio"
            },
            success : function(r){
                if (r.success){
                    cert.data.idcert_scheduling = r.payload.id;
                    cert.data.cert_request_date = r.payload.date;
                    callback();
                }
            }
        });
    }
};

function autoSaveScheduling(){
    autosave = setInterval(function () {
        getValues();
        cert.save();
    },10000);
    //300000
}

function stopSaveSchedule(){
    clearInterval(autosave);
}

function getValues(){
    var fields = $(".cert-value");
    for (let i = 0; i < fields.length; i++) {
        var current = fields.eq(i);
        var index = current.data("field");
        var value = current.val();
        cert.data[index] = value;
    }
    console.log(cert.data);
}