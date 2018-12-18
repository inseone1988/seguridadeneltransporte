function modalSolPerson() {
    var id = moment().format("x");
    var form = {
        formattr: {
            "id": id
        },
        fields: [
            {
                isAutocomplete: false,
                colsize: "col-md-4",
                type: "input",
                attributes: {"placeholder": "Nombre", "name": "person_name"},
                style: {},
                class: "form-control-sm",
                events: {
                    onClick: function () {

                    },
                    onChange: function () {

                    }
                }
            },
            {
                isAutocomplete: false,
                colsize: "col-md-4",
                type: "input",
                attributes: {"placeholder": "Apellido paterno", "name": "person_fname"},
                style: {},
                class: "form-control-sm",
                events: {
                    onClick: function () {

                    },
                    onChange: function () {

                    }
                }
            },
            {
                isAutocomplete: false,
                colsize: "col-md-4",
                type: "input",
                attributes: {"placeholder": "Apellido Materno", "name": "person_lname"},
                style: {},
                class: "form-control-sm",
                events: {
                    onClick: function () {

                    },
                    onChange: function () {

                    }
                }
            },
            {
                isAutocomplete: false,
                colsize: "col-md-12 mt-2",
                type: "input",
                attributes: {"placeholder": "Area solicitante", "name": "cert_applicant_area"},
                style: {},
                class: "form-control-sm",
                events: {
                    onClick: function () {

                    },
                    onChange: function () {

                    }
                }
            }
        ],
        onSubmit: function (caller) {
            console.log(caller);
        }
    };
    var modalPerson = {
        title: "Datos del solicitante",
        modalbody: formify(form),
        events: {
            onClick: function () {
                var data = mapForm(id);
                data.cert_request_date = moment(id).format("YYYY-MM-DD HH:mm:ss");
                console.log(data);
            }
        },
        positiveText: "Siguiente"

    }
    var modal = modalify(modalPerson);
    modal.modal("show");
}

function modalTransport(){
    var form = {
        formattr: {},
        fields: [],
        onSubmit : function(){};
    };
    var modalTransport = {
        title : "Datos de la linea",

    }
    var modal = modalify()
}