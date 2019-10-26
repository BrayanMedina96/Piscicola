
document.write('<script src="../jsConfig.js"></script>');


function consultarAjax(tipo,parametro)
{
    var dat="";
    if(tipo=="POST" || tipo=="PUT" || tipo=="DELETE")
    {
        dat=parametro;
    }

    return $.ajax({
        type: tipo,
        url: sw+"/"+proyecto+"/"+api+"/"+dat,
        data: parametro ,
        contentType: "application/json; charset=utf-8",
        dataType: 'json',
        async:false,
        success: function(response)
        {
            return  response;
        },
        failure: function (response) {
            return response;
        }
        
    });

}