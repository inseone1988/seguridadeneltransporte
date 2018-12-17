//**Bootstrap 4 based forms from data
//
//
// **//

function formify(options) {
    //Wrapper
    var wrapper = $(document.createElement("div")).addClass("row").css({"padding-left":20,"padding-right":20});
    var form = $(document.createElement("form")).attr(options.formattr).on("submit", function (event) {
        event.preventDefault();
        if (options.onSubmit !== undefined) {
            options.onSubmit(this);
        }
    });

    for (var i = 0; i < options.fields.length; i++) {
        var field = options.fields[i];
        var col = $(document.createElement("div")).addClass(field.colsize !== undefined ? field.colsize : "col");
        var input = defineInput(field.type);
        input.attr(field.attributes);
        input.css(field.style);
        input.addClass(field.class);
        input.on("click",field.events.onClick);
        input.on("change",field.events.onChange);
        col.append(input);
        wrapper.append(col);
    }
    return form.append(wrapper);
}

function defineInput(type) {
    switch (type) {
        case "input":
            return $(document.createElement("input")).attr("type","text").addClass("form-control");
        case "select":
            return $(document.createElement("select")).addClass("form-control");
        case "radio":
            return $(document.createElement("input")).attr("type", "radio").addClass("form-control");
        case "checkbox":
            return $(document.createElement("input")).attr("type", "checkbox").addClass("form-control");
        case "textarea":
            return $(document.createElement("textarea")).attr("rows",3).addClass("form-control");
        case "switch":
            break;
    }
}

function modalify(options) {
    var modalcontainer = $(document.createElement("div")).addClass("modal fade").attr({
        "tabindex": -1,
        "role": "dialog"
    });
    var dialog = $(document.createElement("div")).addClass("modal-dialog").attr("role", "document");
    var modalcontent = $(document.createElement("div")).addClass("modal-content");
    var modalheader = $(document.createElement("div")).addClass("modal-header");
    var button = $(document.createElement("button")).addClass("close").attr("data-dismiss","modal").append($(document.createElement("span")).html("&times;"));
    modalheader.append(button);
    var modalheadertitle = $(document.createElement("h4")).addClass("modal-title").html(options.title);
    modalheader.append(modalheadertitle);
    var modalbody = $(document.createElement("div")).addClass("modal-body").append(options.modalbody);
    var modalfooter = $(document.createElement("div")).addClass("modal-footer")
        .append($(document.createElement("button")).addClass("btn btn-default").data("dismiss", "modal").text("Guardar").on("click", function () {
            options.events.onClick(options.id)
        }));
    modalcontent.append(modalheader).append(modalbody).append(modalfooter)
    dialog.append(modalcontent);
    var mmodal = modalcontainer.append(dialog);
    $("body").append(mmodal);
    return mmodal;

}

function mapForm(form){
    var values = $("#"+form).serializeArray();
    var mapped = {};
    $.each(values,function(index,value){
        mapped[value.name] = value.value;
    });
    return mapped;
}