

$(function () {

    var reader = new FileReader;
    txtImportar = $("#txtImportar");
 

    $("#fileToUpload").change(function (event) {

        var file = event.target.files[0];
        reader.readAsText(file);
        reader.onload = onLoad;

    })


    $("#btnLimpiar").click(function(){
        $("#txtImportar").val("");
    })

    $(".opcion").click(function(){

        $("#pnCultivo").attr("hidden","hidden");
        dibujarCampo( $("#"+this.id).attr("go") );
        $("#lblImportar").text( $("#"+this.id).attr("go")  );

        if($("#"+this.id).attr("go")=="Usuario")
        {
            $("#pnMensaje").html("");
            $("#pnMensaje").html(modal("Información", "Para importar usuarios deben estar creados previemanete como personas.", "modal-sm"));
            $("#myModal").modal();
        }


    })

    $("#btnEnviar").click(function(){

        var result=null;

        if($("#lblImportar").text()=="")
        {
            $("#pnMensaje").html("");
            $("#pnMensaje").html(modal("Alerta", "Debe seleccionar que tipo de dato va importar.", "modal-sm"));
            $("#myModal").modal();
            return;
        }

        if($("#txtImportar").val()=="")
        {
            $("#pnMensaje").html("");
            $("#pnMensaje").html(modal("Alerta", "Debe cagar los datos.", "modal-sm"));
            $("#myModal").modal();
            return;
        }

       switch ($("#lblImportar").text()) {
           case "Sondeo":
                 result=sonda();
               break;
            case "Persona":
                result=persona();
              break;
            case "Usuario":
                result=usuario();
              break;
            case "Lago":
                result=lago();
              break;
            case "Sensor":
                result=sensor();
             break;
           default:
               break;
       }


       $("#pnMensaje").html("");
       if(result.responseJSON!=true)
       {

        $("#pnMensaje").html(modal("Error", "<label> Los datos no contiene la estructura correcta. </label>", "modal-sm"));
      
       }
       else{

        $("#pnMensaje").html(modal("Error", "<label> Registros guardados con éxito. </label>", "modal-sm"));

       }

       $("#myModal").modal();

    })

    function sonda()
    {
        var obj=new Sonda();
        obj.importarText=$("#txtImportar").val();
        obj.token = $("#txtVarUrl").val();
        return obj.importar();
    }

    function persona()
    {
        var obj=new Persona();
        obj.importarText=$("#txtImportar").val();
        obj.token = $("#txtVarUrl").val();
        return obj.importar();
    }

    function usuario()
    {
        var obj=new Usuario();
        obj.importarText=$("#txtImportar").val();
        obj.token = $("#txtVarUrl").val();
        return obj.importar();
    }

    function lago()
    {
        var obj=new Lago();
        obj.importarText=$("#txtImportar").val();
        obj.token = $("#txtVarUrl").val();
        return obj.importar();
    }

    function sensor()
    {
        var obj=new Sensor();
        obj.importarText=$("#txtImportar").val();
        obj.token = $("#txtVarUrl").val();
        return obj.importar();
    }


    $("#btnPlantilla").click(function () {
        
        var url = "https://drive.google.com/drive/folders/1GMM3TqxgWgvvGe2dLH_5PzwlN4KdhVUu?usp=sharing";
        window.open(url);

    })




function dibujarCampo(tipo)
{

    const titulo = {
        'Sondeo' : ['Fecha', 'Hora', 'Temperatura ambiente', 'Temperatura estanque',
            'Oxigeno disuelto', 'pH', 'Cond. Electrica',
            'Amonio NH3', 'Amonio NH4', 'Nitrito', 'Alcalinidad',
            'Peces muertos', 'Observación'
        ],
        'Sensor' : ['Nombre','<label title=serial>Código</label>','Descripción','Marca','Fecha mantenimiento','Repetir cada'
        ],
        'Lago' : ['Nombre','Descripción','Área m²','Altitud','Cantidad de peces','Profundidad','Tipo de lago'
        ],
        'Usuario' : ['N. Documento','Usuario','Perfil','Fecha expiración'
        ],
        'Persona' : [ 'Tipo Documento','N. Documento','Nombre','Apellido'
        ]
    };

    var lista= index(titulo,tipo);
    var html="";
    for (const key in lista) {

        html+="<th>"+lista[key]+"</th>";


    }

    $("#tabla").html(html);

}


function index(titulo, tipo) {
    var obj = null;
    switch (tipo) {
        case "Sondeo":
            obj = titulo.Sondeo;
            $("#txtTipo").val(tipo);
            $("#pnCultivo").removeAttr("hidden")
            break;
        case "Sensor":
            obj = titulo.Sensor;
            break;
        case "Lago":
            obj = titulo.Lago;
            break;
        case "Usuario":
            obj = titulo.Usuario;
            break;
        case "Persona":
            obj = titulo.Persona;
            break;

        default:
            break;
    }

    return obj;
}

function onLoad() {


    var result = reader.result.trim();
    var lineas = result.split('\n');
    var primera="";
    var primeraVez=true;

    for (var linea of lineas) {

        if(linea=="")
        {
          continue;
        }

        if(primeraVez)
        {
            primeraVez=false;
            continue; 
        }
        
        txtImportar.append( primera + decodeURIComponent( linea )  );

        if(primera=="")
        {
            primera="|";
        }

    }

}


})

