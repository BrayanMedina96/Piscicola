var myChart = null;

$(function () {

    $("#txtImportar").val("0");
  /*  n = new Date();
    //Año
    y = n.getFullYear();
    //Mes
    m = n.getMonth() + 1;
    //Día
    d = n.getDate();
    fecha = y + "/" + m + "/" + d;
    $("#txtFechaInicial").val(fecha);
    $("#txtFechaFinal").val(fecha);
*/
    miDashboard();

    $("#txtFechaInicial").datepicker({
        onSelect: function (fd, d, calendar) {
            calendar.hide()
        }
    })

    
    $("#txtFechaFinal").datepicker({
        onSelect: function (fd, d, calendar) {
            calendar.hide()
        }
    })



    $("#btnCrear").click(function () {

        $("#modal").modal();

        var obj = new Dashboard();
        obj.token = $("#txtVarUrl").val();
        var result = obj.variable();
        obj.cargarddl("ddlVariableY", result.responseJSON);
        obj.cargarddl("ddlVariableX", result.responseJSON);
        obj.cargarddl("ddlFiltro", result.responseJSON);


    });

    $("#btnAgregar").click(function () {
        var cls = document.getElementsByClassName("excluirX");
        if (cls.length > 0) {
            alert("En el eje X solo puedes seleccionar una variable");
            return;
        }

        var html = "";
        var elemento = $("#ddlVariableX option:selected").text();
        html = "<div id='" + $("#ddlVariableX").val() + "' go='" + $("#ddlVariableX").val() + "' class='excluirX alert alert-primary'>"
        html += "<strong class='mr-auto'>" + elemento + "</strong>";
        html += "<button type='button' onclick=eliminar('" + $("#ddlVariableX").val() + "') class='ml-1 mb-1 close' >&times;</button>"
        html += "</div>";
        $("#variableX").append(html);


    })

    $("#btnAgregarY").click(function () {

        var html = "";
        var elemento = $("#ddlVariableY option:selected").text();
        html = "<div id='" + $("#ddlVariableY").val() + "' go='" + $("#ddlVariableY").val() + "' class='excluirY alert alert-warning'>"
        html += "<strong class='mr-auto'>" + elemento + "</strong>";
        html += "<button type='button' onclick=eliminar('" + $("#ddlVariableY").val() + "') class='ml-1 mb-1 close' >&times;</button>"
        html += "</div>";
        $("#variableY").append(html);


    })

    $("#btnFiltro").click(function () {

        var html = "";
        var elemento = $("#ddlFiltro option:selected").text();
        html = "<div id='" + $("#ddlFiltro").val() + "' go='" + $("#ddlFiltro").val() + "' class='filtro alert alert-dark'>"
        html += "<strong class='mr-auto'>" + elemento + "</strong>";
        html += "<button type='button' onclick=eliminar('" + $("#ddlFiltro").val() + "') class='ml-1 mb-1 close' >&times;</button>"
        html += "</div>";
        $("#filtro").append(html);


    })


    $("#btnEnviar").click(function () {

        $("#modal").modal("hide");


        var obj = new Dashboard();
        obj.nombre = $("#txtNombre").val();
        obj.x = prepararYX("excluirX");
        obj.y = prepararYX("excluirY");
        obj.filtro = prepararYX("filtro");
        obj.token = $("#txtVarUrl").val();
        obj.tipografica = $("#ddlTipoGrafica").val();
        obj.guardar();
        miDashboard();

        limpiar();

    })

    $("#btnBuscar").click(function () {
        

        grafica($("#txtGrafica").val());
     
        
    })


})

function miDashboard() {

     
    var obj = new Dashboard();
    obj.token = $("#txtVarUrl").val();
    var result = obj.consultar().responseJSON;
    var html = "";
    $("#miCreacion").html(html);
    for (var indice in result) {
        var titulo = result[indice]["nombre"].replace(/ /g, "_");
        html += "<a tipo=" + result[indice]["tipografica"] + "  id=" + result[indice]["dashboardid"] + " onclick=grafica(" + result[indice]["dashboardid"] + ") title=" + titulo + " go='x:" + result[indice]["x"] + "-y:" + result[indice]["y"] + "' class='list-group-item list-group-item-action opcion'>";
        html += "<img width='24px' src='../svg/pie-chart.png' /> " + result[indice]["nombre"];
        html += "<button type='button' onclick=eliminarGrafica('" + result[indice]["dashboardid"] + "') class='ml-1 mb-1 close' >&times;</button> </a>";
    }

    $("#miCreacion").append(html);

}

function color(valor) {
    var color = "";
    var paletaColor = {
        "Rojo": 'rgba(255, 99, 132, 1)',
        "Azul": 'rgba(54, 162, 235, 1)',
        "Amarillo": 'rgba(255, 206, 86, 1)',
        "Verde": 'rgba(82, 192, 75, 1)',
        "Gris": 'rgba(143, 157, 157, 1)',
        "Morado": 'rgba(231, 114, 233, 1)',
        "Lima": 'rgba(26, 236, 67, 1)',
        "Agua": 'rgba(34, 239, 206, 1)',
        "Anaranjado": 'rgba(217, 99, 35, 1)',
        "Rosa": 'rgba(240, 115, 216, 1)',
        "Morado": 'rgba(174, 13, 245, 1)',
        "Cian": 'rgba(13, 245, 227, 1)',
        "Turquesa": 'rgba(12, 200, 229, 1)',
        "Negro": 'rgba(0, 0, 0, 1)',
    };

    switch (valor) {
        case "gris":
        case 1:
            color = paletaColor.Gris;
            break;
        case "rojo":
        case 2:
            color = paletaColor.Rojo;
            break;
        case "amarillo":
        case "ph":
        case 3:
            color = paletaColor.Amarillo;
            break;
        case "azul":
        case "oxigenodisuelto":
        case 4:
            color = paletaColor.Azul;
            break;
        case "verde":
        case "amonionh3":
        case 5:
            color = paletaColor.Verde;
            break;
        case "Morado":
        case 6:
            color = paletaColor.Verde;
            break;
        case "Lima":
        case "temperaturaestanque":
        case 7:
            color = paletaColor.Lima;
            break;
        case "Agua":
        case 8:
            color = paletaColor.Verde;
            break;
        case "temperaturaambiente":
            color = paletaColor.Anaranjado;
            break;
        case "conductividadelectrica":
            color = paletaColor.Gris;
            break;
        case "amonionh3":
            color = paletaColor.Rosa;
            break;
        case "amonionh4":
            color = paletaColor.Morado;
            break;
        case "nitrito":
            color = paletaColor.Cian;
            break;
        case "alcalinidad":
            color = paletaColor.Turquesa;
            break;
        case "pecesmuertos":
            color = paletaColor.Negro;
            break;
            
        default:
            break;
    }

    return color;
}

function eliminar(elemento) {
    $("#" + elemento).remove();
}


function prepararYX(elemen) {
    var filtro = "";
    var primera = "";

    $("." + elemen).each(function () {

        filtro += primera + $(this).attr("go").replace(/_/g, " ");

        if (primera == "") {
            primera = ",";
        }

    });

    return filtro;
}

function grafica(params) {

    var obj = new Dashboard();
    obj.token = $("#txtVarUrl").val();
    obj.fechaInicio=$("#txtFechaInicial").val();
    obj.fechaFinal=$("#txtFechaFinal").val();
   
    $("#txtGrafica").val(params);

    preparar(obj.consultarSonda().responseJSON, $("#" + params).attr("go"), $("#" + params).attr("title"), params);
}


function preparar(response, campo, title, elemen) {

    var objGrafica = {
        "label": "",
        "data": Array(),
        "borderColor": ""
    };

    var n = campo.split("-");

    var x = n[0].split(":");
    var y = n[1].split(":")[1].split(",");

    

    var label = [];
    var data = [];

    //line bar  radar doughnut polarArea
    var tipoGrafica = $("#" + elemen).attr("tipo");

    //PREPARA LABELS
    for (let index = 1; index < x.length; index++) {
        for (const key in response) {
            label.push(response[key][x[index]]);
        }
    }

    var primera = true;

    for (let index = 0; index < y.length; index++) {
        primera = true;

        objGrafica = {
            "label": "",
            "data": Array(),
            "borderColor": "",
            "backgroundColor": ""
        };


        for (const key in response) {

            if (primera) {
                primera = false;
                objGrafica.label = y[index];
                if (tipoGrafica == "bar") //|| tipoGrafica=="doughnut" || tipoGrafica=="pie" || tipoGrafica=="polarArea"
                {
                    objGrafica.backgroundColor = color(Math.floor((Math.random() * 9) + 1)) //"rgba("+Math.floor(Math.random() * 255)+","+Math.floor(Math.random() * 255)+","+Math.floor(Math.random() * 255)+",1)"; //  color(Math.floor((Math.random() * 9) + 1));
                }
                if (tipoGrafica == "line") //|| tipoGrafica=="radar"
                {
                    objGrafica.borderColor =  color( y[index] ); // "rgba("+Math.floor(Math.random() * 255)+","+Math.floor(Math.random() * 255)+","+Math.floor(Math.random() * 255)+",1)"; // color(Math.floor((Math.random() * 9) + 1));
                }

            }

            objGrafica.data.push(response[key][y[index]]);

        }
 
        data.push(objGrafica);
    }

    if (myChart != null) {
        myChart.destroy();
    }



    graficar(label, data, tipoGrafica, title);
    tabl(x,y,response,title);
    
    $("#txtImportar").val("1");

}

function eliminarGrafica(params) {

    if (confirm("Eliminar grafica.")) {
        var obj = new Dashboard();
        obj.id = params;
        obj.token = $("#txtVarUrl").val();
        obj.eliminar();
        miDashboard();

    }


}


function graficar(label, dataSet, tipoGrafica, titulo) {



    var ctx = document.getElementById('myChart').getContext('2d');

    myChart = new Chart(ctx, {
        type: tipoGrafica,
        data: {

            labels: label,

            datasets: dataSet

        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },

            title: {
                display: true,
                text: titulo
            },

        }
    });


    


}

function tabl(x,y,result,titulo) {
    
    

    var columna=[ {"data":x[1] } ];

    $("#tbEncabezado").html("");

    $("#tbEncabezado").append("<th>"+x[1]+"</th>")

    var encabezado=1;

    for (let index = 0; index < y.length; index++) 
    {

        $("#tbEncabezado").append("<th>"+y[index]+"</th>")
        columna.push({"data":y[index]});

        encabezado++;
        
    }

   

    tabla("Tabla", result, columna,{});

    var fila="";
    
    $('#Tabla #tdResultado tr').each(function () {

        
        var separador=";";
        
        for (let index = 0; index < encabezado; index++) {

            if(index==encabezado-1)
            {
            
                separador=" \n";
            }

            fila=fila+$(this).find("td").eq(index).html()+separador;
            
        }
        
        
    });

    download(fila,titulo, 'text/plain');

}



function limpiar() {
    $("#txtNombre").val("");
    $("#variableX").html("");
    $("#variableY").html("");

}

download_img = function (el) {

    
    if($("#txtImportar").val()=="0")
    {
        $("#pnMensaje").html("");
        $("#pnMensaje").html(modal("Alerta", "No hay información para exportar.", "modal-sm"));
        $("#myModal").modal();
        return;
    }
    var canvas = document.getElementById("myChart");
    var image = canvas.toDataURL("image/jpg");
    el.href = image;

}


function download(text, name, type) {
    var a = document.getElementById("a");
    var file = new Blob([text], {type: type});
    a.href = URL.createObjectURL(file);
    a.download = name;
  }