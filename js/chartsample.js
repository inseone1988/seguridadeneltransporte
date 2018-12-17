var mchart;
function chartsample1(){
    var ctx = document.getElementById("samplechart");
    ctx.height = 250;
    var options = {};
    var data = {};
    options.type = 'pie';
    data.labels = ["Aprobados","Rechazados","Declinados","pendientes"];
    data.datasets = [{
        labels:"Certificationes",
        data:[825,21,9,20],
        backgroundColor:['#A1E44D','#FF5154','#EFCA08','#4392F1']
    }];
    options.data = data;
    options.options = {};
    //options.options.color = ['red','blue','green','aliceblue'];
    console.log(options);
    new Chart(ctx,options);
}

function chartsample2(){
    var ctx = document.getElementById("sample2");
    var options = {};
    var data = {};
    options.type = "line";
    data.labels = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre"];
    data.datasets = [{
        label: "Hello",
        data:[150,300,200,100,50,80,70,120,160]
    }];
    options.data = data;
    options.options = {
        maintainAspectRatio : false
    };
    mchart = new Chart(ctx,options);
}
