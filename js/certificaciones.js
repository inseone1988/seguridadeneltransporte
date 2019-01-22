
var pendingcerts;
var selected;
var map;
var marker;
function getPendingcerts(){
    $.ajax({
        url : "requesthandler.php",
        type : "POST",
        dataType : "JSON",
        data : {
            "function":"getPendingCerts"
        },
        success : function(r){
            if (r.success){
                pendingCerts = r.payload;
                mapPendingCerts()
            }
        }
    });
}

function mapPendingCerts(){
    for (let i = 0; i < pendingCerts.length; i++) {
        var row = "<tr>" +
            "<td>"+pendingCerts[i].cert_request_date+"</td>" +
            "<td>"+pendingCerts[i].cert_solicitante+"</td>" +
            "<td>"+pendingCerts[i].cert_area_solicitante+"</td>" +
            "<td>"+pendingCerts[i].cert_contact_name+"</td>" +
            "<td>"+pendingCerts[i].cert_transp_social+"</td>" +
            "<td>"+pendingCerts[i].cert_comercial_name+"</td>" +
            "<td><a href='#cert-info-wrapper' onclick='displayCertDetails("+i+")' class='btn btn-sm btn-primary'>Ver detalle <span class='fa fa-eye'></span></a></td>";
        $("#pendingcerts").append(row);
    }
    //maybe load datatables
}

function initMap() {
    var coords = $("#coords").data("coords");
    var macrocentro = {lat: 19.629781, lng: -99.193006};
    var rcoords = (coords === "" ? macrocentro : coords);
    var crdstmp = pendingCerts[selected].cert_coords.split(",");
    var nCoords = {lat: Number(crdstmp[0]),lng:Number(crdstmp[1])};
    map = new google.maps.Map(document.getElementById('mMap'), {
        center: nCoords,
        zoom: 15
    });

    marker = new google.maps.Marker({
        position: nCoords,
        map: map
    });

    google.maps.event.addListener(map, 'click', function (event) {
        var point = event.latLng;
        $("#mapspoint").val(point.lat() + ", " + point.lng());
        console.log(point);
        if (marker !== undefined) {
            marker.setMap(null);
        }
        marker = new google.maps.Marker({
            position: event.latLng,
            map: map
        });

        google.maps.event.addListener(marker, 'click', function () {
            infowindow.open(map, marker);
        });

    });
}

function displayCertDetails(index){
    $("#cert-info-wrapper").removeClass("hide");
    document.getElementById("cert-info-wrapper").focus();
    $("#no-data-wrapper").addClass("hide");
    $("#acceptandcontinue").removeClass("hide");
    selected = index;
    var current = pendingCerts[selected];
    $.each(current,function(index,value){
        $("#"+index+"_text").text(value);
    });
    if (current.cert_coords !== "") {
        $("#nomap").addClass("hide");
        $("#mMap").removeClass("hide");
        initMap();
    }else{
        $("#nomap").removeClass("hide");
        $("#mMap").addClass("hide");
    }
}