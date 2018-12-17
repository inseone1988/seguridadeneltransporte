function ajaxCall(options){
  $.ajax({
      url: options.url != null ? options.url : "requesthandler.php",
      type : "POST",
      dataType : "JSON",
      data : options.data,
      success : options.rCallback()
  });
}

function mapForm(form){
    var values = $("#"+form).serializeArray();
    var mapped = {};
    $.each(values,function(index,value){
        mapped[value.name] = value.value;
    });
    return mapped;
}