$(function () {

   consultar('prediccion','GET',null);

   function consultar(api,tipo,parametro) {

       return $.ajax({
           type: 'GET',
           url: urlApiPrediccion + api,
          // data: parametro,
          //  crossDomain: true,
          // no contentType: "application/json; charset=utf-8",
           dataType: 'json',
         //  async: false,
         /* headers: {
            'Access-Control-Allow-Origin': '*'
            
           },*/
           success: function (response) {
            //   alert("");
               graficaPrediccion(response);
           },
           failure: function (response) {
           // alert("");
               return response;
           }

       });
   }

   function graficaPrediccion(response) {
        
       console.log(response);
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
       

       var label = ["T. Ambiente","T Estanque","Oxigeno D.","PH","Cond. Electrica","NH3","NH4","Nitrito","Alcalinidad"];
       var ejex=[];

       var tipoGrafica = "line";
       
       var primera=true;
       dia=0;
       contdor=0;

       for (let index = 0; index < response.data.length; index++) {

           contdor++;

           const element = response.data[index].data;
           tambiente.push(element[1]);
           testanque.push(element[2])
           oxigenoD.push(element[3]);
           pH.push(element[4]);
           condElectrica.push(element[5]);
           nH3.push(element[6]);
           nH4.push(element[7]);
           nitrito.push(element[8]);
           alcalinidad.push(element[9]);
           ejex.push("d."+dia+"Hora:"+element[0]);

           if (contdor == 2) {
               contdor = 0;
               dia++;
           }

           //console.log(element[0]);
           
       }
       
        
       data.push( fobjGrafica(label[0],tambiente) );
       data.push( fobjGrafica(label[1],testanque) );
       data.push( fobjGrafica(label[2],oxigenoD) );
       data.push( fobjGrafica(label[3],pH) );
       data.push( fobjGrafica(label[4],condElectrica) );
       data.push( fobjGrafica(label[5],nH3) );
       data.push( fobjGrafica(label[6],nH4) );
       data.push( fobjGrafica(label[7],nitrito) );
       data.push( fobjGrafica(label[8],alcalinidad) );

       graficar(ejex, data, tipoGrafica, "Predicción");

   }

    function fobjGrafica(label, data) {

        var objGrafica = {
            "label": "",
            "data": Array(),
            "borderColor": ""
        };

        objGrafica.label = label;
        objGrafica.borderColor = color(Math.floor((Math.random() * 9) + 1));
        objGrafica.data = data;
        return objGrafica;
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

