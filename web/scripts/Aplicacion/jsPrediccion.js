var result;

$(function () {

   
   cultivo(); 

   $("#btnBuscar").click(function(){
     loading();
     consultar('api','GET',null);
   })

   function cultivo() {

       var obj = new Cultivo();
       obj.token = $("#txtVarUrl").val();
       result = obj.consultarSonda().responseJSON;
       obj.cargarddl2("ddlCultivo", result, "cultivoid", "nombre");

   }

   $("#ddlCultivo").change(function () {
       var sonda = result.filter(b => {
           return (b.cultivoid == this.value)
       });

       $("#txtSonda").val(sonda[0].max);

   });

   function consultar(api,tipo,parametro) {

       return $.ajax({
           type: 'GET',
           url:sw+"/"+proyecto+"/"+api+"/"+"?entidad=Prediccion&token="+$("#txtVarUrl").val().trim()+"&do=&cultivo_id="+$("#ddlCultivo").val()+"&fecha="+$("#txtSonda").val(),
          // data: parametro,
          //  crossDomain: true,
           contentType: "application/json; charset=utf-8",
           dataType: 'json',
         //  async: false,
         /* headers: {
            'Access-Control-Allow-Origin': '*'
            
           },*/
           success: function (response) {
            //   alert("");
               closeLoading();
               graficaPrediccion(response);
           },
           failure: function (response) {
           // alert("");
               closeLoading()
               return response;
           }

       });
   }

   function graficaPrediccion(response) {
        
       try {

        //console.log(response);
        var data = [];
        var tambiente=[];
        var testanque=[];
        var oxigenoD=[];
        var pH=[];
        var condElectrica=[];
        var nH3=[];
        var nH4=[];
        var nitrito=[];
        var alcalinidad=[];
        var dia = new Date();

        var numeroDia=dia.getDate().toString().length;
        var numeroMes=(dia.getMonth()+1).toString().length;
        var hoy=dia.getFullYear()+"-"+(numeroMes==1?"0"+(dia.getMonth()+1):(dia.getMonth()+1))+'-'+(numeroDia==1?("0"+dia.getDate().toString()):dia.getDate().toString());
 
        var label = ["T. Ambiente","T Estanque","Oxigeno D.","PH","Cond. Electrica","NH3","NH4","Nitrito","Alcalinidad"];
        var ejex=[];
 
        var tipoGrafica = "line";
        var indexLine=-1;
 
        var primera=true;
        dias=0;
        contdor=0;
 
        for (let index = 0; index < response.data.length; index++) {
 
            contdor++;
 
            const element = response.data[index];//.data
            tambiente.push(element[1]);
            testanque.push(element[2])
            oxigenoD.push(element[3]);
            pH.push(element[4]);
            condElectrica.push(element[5]);
            nH3.push(element[6]);
            nH4.push(element[7]);
            nitrito.push(element[8]);
            alcalinidad.push(element[9]);
            ejex.push(element.fecha+" Hora:"+element[0]);
 
            if (contdor == 2) {
                contdor = 0;
                dias++;
            }
           
            if (element.fecha == hoy) {
                indexLine ++;
                /*if (dia.getHours() < 13) {
                    indexLine  =indexLine - 1;
                }*/
            }
    
         }
        
         
         data.push( fobjGrafica(label[0],tambiente,"temperaturaambiente") );
         data.push( fobjGrafica(label[1],testanque,"temperaturaestanque") );
         data.push( fobjGrafica(label[2],oxigenoD,"oxigenodisuelto") );
         data.push( fobjGrafica(label[3],pH,"ph") );
         data.push( fobjGrafica(label[4],condElectrica,"conductividadelectrica") );
         data.push( fobjGrafica(label[5],nH3,"amonionh3") );
         data.push( fobjGrafica(label[6],nH4,"amonionh4") );
         data.push( fobjGrafica(label[7],nitrito,"nitrito") );
         data.push( fobjGrafica(label[8],alcalinidad,"alcalinidad") );
        
       //  console.log(indexLine);

         graficar(ejex, data, tipoGrafica, "Predicción",indexLine);
       } catch (error) {
            badge("#pnMensaje","Problemas :"+error , "success");
       }
       

   }

    function fobjGrafica(label, data,c) {

        var objGrafica = {
            "label": "",
            "data": Array(),
            "borderColor": ""
        };

        objGrafica.label = label;
        objGrafica.borderColor = color(c);
        objGrafica.data = data;
        return objGrafica;
    }

   function graficar(label, dataSet, tipoGrafica, titulo,indexLine) {

       var originalLineDraw = Chart.controllers.line.prototype.draw;
       Chart.helpers.extend(Chart.controllers.line.prototype, {
           draw: function () {
               originalLineDraw.apply(this, arguments);

               var chart = this.chart;
               var ctx = chart.chart.ctx;

               var index = chart.config.data.lineAtIndex;
               if (index) {
                   var xaxis = chart.scales['x-axis-0'];
                   var yaxis = chart.scales['y-axis-0'];
                   ctx.save();
                   ctx.beginPath();
                   ctx.moveTo(xaxis.getPixelForValue(undefined, index), yaxis.top);
                   ctx.strokeStyle = '#ff0000';
                   ctx.lineTo(xaxis.getPixelForValue(undefined, index), yaxis.bottom);
                   ctx.stroke();
                   ctx.restore();
               }
           }
       });

       var config = {
           type: 'line',
           data: {
               labels: label,
               datasets: dataSet,
               lineAtIndex: indexLine
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
       };

       var ctx = document.getElementById("myChart").getContext("2d");
       new Chart(ctx, config);



   }

   function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
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

})

