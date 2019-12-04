$(function () {

    var reader = new FileReader;
    txtImportar = $("#txtImportar");

    $("#fileToUpload").change(function (event) {

        var file = event.target.files[0];
        reader.readAsText(file);
        reader.onload = onLoad;

    })


    $("#btnLimpiar").click(function(){
        $("#txtImportar").val(" ");
    })

    $(".opcion").click(function(){

        dibujarCampo( $("#"+this.id).attr("go") );
    
        $("#lblImportar").text( $("#"+this.id).attr("go")  );

    })

    $("#btnEnviar").click(function(){

       var obj=new Sonda();
       obj.importarText=$("#txtImportar").val();
       obj.token = $("#txtVarUrl").val();
       obj.importar();

    })

    $("#btnPlantilla").click(function () {
        
        var url = "";

        switch ($("#lblImportar").text()) {
            case "Sondeo":
                url = "https://drive.google.com/file/d/1AynZmJDdlSo8trO1R2yO6nJN-SR48oAE/view?usp=sharing";
                break;

            default:
                url = "https://drive.google.com/drive/folders/1GMM3TqxgWgvvGe2dLH_5PzwlN4KdhVUu?usp=sharing";
                break;
        }

        window.open(url);


    })

function onLoad() {

    var result = reader.result.trim();
    var lineas = result.split('\n');
    var primera="";
    for (var linea of lineas) {

        if(linea=="")
        {
          continue;
        }
        
        txtImportar.append( primera + decodeURIComponent( linea )  );

        if(primera=="")
        {
            primera="|";
        }

    }

}


function dibujarCampo(tipo)
{

    const titulo = {
        'Sondeo' : ['Fecha', 'Hora', 'Temperatura ambiente', 'Temperatura estanque',
            'Oxigeno disuelto', 'pH', 'Cond. Electrica',
            'Amonio NH3', 'Amonio NH4', 'Nitrito', 'Alcalinidad',
            'Peces muertos', 'Observación'
        ],
        'Sensor' : [''
        ],
        'Lago' : [''
        ],
        'Usuario' : [''
        ],
        'Persona' : [''
        ]
    };

    var lista= index(titulo,tipo);
    console.log(lista);
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




})
