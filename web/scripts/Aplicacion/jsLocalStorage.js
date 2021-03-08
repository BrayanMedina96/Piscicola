function existe(params) {
    return localStorage.getItem("aqua-"+params);
}


function getData(params) {
    return JSON.parse( localStorage.getItem('aqua-'+params) );
}

function getDataBase(params) {
   
    return JSON.parse( b64_to_utf8( localStorage.getItem('aqua-'+params) ) );
}


function getFull(params) {
    return  localStorage.getItem('aqua-'+params) ;
}

function setData(key,data) {
    localStorage.setItem('aqua-'+key,data);
}

function limpiarStorage () {


    var aKey = [];
    for (var i = 0; i < localStorage.length; i++) {
        
        if (localStorage.key(i).search("aqua-") >= 0) {
            aKey.push(localStorage.key(i));
        }

    }

    for (let index = 0; index < aKey.length; index++) {

       
        localStorage.removeItem(aKey[index]);
    }

}

function b64_to_utf8(str) {
    return decodeURIComponent(escape(window.atob(str)));
}

function dataUser(data)
{

   $("#txtUserPadre").val(data.userPadre)
   $("#txtPersonaidMenu").val(data.personaid)
   $("#txtUsuarioidMenu").val(data.usuarioid)
   $("#txtUsuarioMenu").val(data.usuario)
   $("#txtVarUrl").val(localStorage.getItem('aqua-user'))
   $("#lblNombre").text(data.nombre)
   $("#lblNombreComercial").text(`[${data.nombreComercial}]`)
   

}