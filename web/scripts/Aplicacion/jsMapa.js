"use strict";

let map;
let markers = [];
let infowindow;
let image;
let total;


//let marker;


function initMap() {

    getLocation();

}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {

    var center = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
    };

    var mapOptions = {
        zoom: 12,
        center: center,
        mapTypeId: 'satellite'
    };

    map = new google.maps.Map(document.getElementById('map'), mapOptions);

    infowindow = new google.maps.InfoWindow({});

    image = {
        url: '../svg/markerazul2.png',
        // This marker is 20 pixels wide by 32 pixels high.
        /*  size: new google.maps.Size(12, 24),
          // The origin for this image is (0, 0).
          origin: new google.maps.Point(0, 0),
          // The anchor for this image is the base of the flagpole at (0, 32).
          anchor: new google.maps.Point(0, 24)*/
    };


    dibujar();

}


function dibujar() {
    markers = [];

    $("#pnProgress").show();

    var obj = new Sonda();
    obj.token = $("#txtVarUrl").val();
    var result = obj.parametrosInfo();

    console.log(result);

    if (result['estado']) {


        result['data'].reduce((accumulatorPromise, nextID) => {
            return accumulatorPromise.then(() => {
                return doMarcador(nextID);
            });
        }, Promise.resolve()).then(e => {

            var obj = new Sonda();
            obj.token = $("#txtVarUrl").val();
            var result = obj.enviarCorreo();

        });
    }



}

function doMarcador(key) {
    return new Promise(function (resolve) {

        setTimeout(() => {



            if (key.data.lagogeolocalizacion != null) {
                var ubi = ubicacion(key.data);

                console.log(ubi);
                var latLng = {
                    lat: parseFloat(ubi[0]),
                    lng: parseFloat(ubi[1])
                };

                console.log(latLng);

                var marker = new google.maps.Marker({
                    position: latLng,
                    map: map,
                    animation: google.maps.Animation.DROP,
                    scale: 0.5
                    // icon:image

                });


                marker.addListener("click", () => {

                    clearAnimation();

                    infowindow.close();
                    infowindow.setContent(info(key));
                    infowindow.open(map, marker);
                    //map.setZoom(14);
                    map.setCenter(marker.getPosition());
                    if (marker.getAnimation() !== null) {
                        marker.setAnimation(null);
                    } else {
                        marker.setAnimation(google.maps.Animation.BOUNCE);
                    }


                    setTimeout(actaulizarDatos, 1000);

                });



                markers.push(marker);


            }


            resolve();
        }, 10);
    });
}


function info(key) {
    var mensaje = ""
    mensaje += "<br/> Lago: <strong>" + key.data.lagonombre + "</strong>";
    mensaje += "<br/> Material: <strong> Tierra </strong>"; //key.data.tipolagonombre
    mensaje += "<br/> <strong> Sonda: S001 </strong>";

   /* if (key.sonda.estado) {
        for (let index = 0; index < key.sonda.data.length; index++) {

            var element = key.sonda.data[index];
            mensaje += "<li>" + element.sensornombre + "</li>";

        }

    }*/

    mensaje += "<br/><strong> Cultivo: </strong>";
    mensaje += "<li>  Pez: <strong>" + key.data.especiepez + "</strong> </li>";
    mensaje += "<li> Inicio: <strong>" + key.data.fechainicio + "</strong> </li>";
    mensaje += "<li> Final: <strong>" + key.data.fechafinalizacion + "</strong> </li>";

    if (key.variable.data != undefined) {

        var t = key.variable.data[0];
        mensaje += "<table class='table h5'>";
        mensaje += `<tr> <td>T.Amb</td>  <td id="txttemperaturaambiente"> ${t.temperaturaambiente}</td> </tr>`;
        mensaje += `<tr> <td>T.Est</td>  <td id="txttemperaturaestanque">${t.temperaturaestanque}</td> </tr>`;
        mensaje += `<tr> <td>O.D</td>  <td id="txtoxigenodisuelto">${t.oxigenodisuelto}</td> </tr>`;
        mensaje += `<tr> <td>pH</td>  <td id="txtph">${t.ph}</td> </tr>`;
        mensaje += "</table>";

    }


    return mensaje;
}

function timeValues(t) {

    var value = Math.floor(Math.random() * 3);

    if (value == 2) {
        t.temperaturaambiente = t.temperaturaambiente - value;
        t.temperaturaestanque = t.temperaturaestanque - value;
        t.oxigenodisuelto = t.oxigenodisuelto - value;
        t.ph = t.ph - value;
    } else {
        t.temperaturaambiente = t.temperaturaambiente + value;
        t.temperaturaestanque = t.temperaturaestanque + value;
        t.oxigenodisuelto = t.oxigenodisuelto + value;
        t.ph = t.ph + value;
    }

    return t;

}

function clearAnimation() {
    for (let i = 0; i < markers.length; i++) {
        markers[i].setAnimation(null);
    }
}

function actaulizarDatos(){

    console.log("xxxxxx");
    
    var valor= parseFloat((Math.random() * 2 - 1).toFixed(2)) ; //Math.floor(Math.random() * 3);

    $("#txttemperaturaambiente").val(25 + valor);
    $("#txttemperaturaestanque").val(20 + valor);
    $("#oxigenodisuelto").val(20 + valor);

}


/*
$(function () {

    openInitMap();

    var markers=new Array()

    function openInitMap() {

        if ('geolocation' in navigator) {

            navigator.geolocation.getCurrentPosition(position => {
                lat = position.coords.latitude;
                lon = position.coords.longitude;

                L.Map = L.Map.extend({
                    openPopup: function(popup) {

                        this._popup = popup;

                        return this.addLayer(popup).fire('popupopen', {
                            popup: this._popup
                        });
                    }
                })

                snapshot = document.getElementById('snapshot');
                map = L.map('map',{zoomControl: false,}).setView([lat, lon], 13);

                assetLayerGroup = new L.LayerGroup();

                var n = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
                var n2 = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';

               var tiles= L.tileLayer(n, {
                    maxZoom: 22,
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    id: 'mapbox/streets-v11',
                    tileSize: 512,
                    zoomOffset: -1
                }).addTo(map);

                L.control.zoom({
                    position:'bottomright'//topright
               }).addTo(map);

                L.marker([lat, lon]).addTo(map)
                    .bindPopup("<b>Mi ubicación</b><br />").openPopup();



                lago()

            });
        } else {
            console.log('geolocation not available');
        }


    }


    function lago()
    {

        var obj = new Sonda();
        obj.token = $("#txtVarUrl").val();
        var result = obj.parametrosInfo();

        if(result['estado'])
        {
            result['data'].reduce((accumulatorPromise, nextID) => {
                return accumulatorPromise.then(() => {
                    return doIntensiveStuff(nextID,"../svg/lago.png",30);
                });
            }, Promise.resolve()).then(e=>{

               /* console.log(markers)
                var markerGroup = L.featureGroup(markers).addTo(map);
                markerGroup.eachLayer(function(layer) {
                    layer.openPopup();
                });

            });
        }

    }

    function doIntensiveStuff(key,icon,size) {
        return new Promise(function (resolve) {

            setTimeout(() => {

                if(key.data.lagogeolocalizacion!=null)
                {
                    var ubi = ubicacion(key.data);
                    console.log(ubi)

                   var marker= L.marker([ubi[0], ubi[1]], {
                        icon: L.icon({
                            iconUrl: icon,
                            iconSize: [size, size],
                            iconAnchor: [8, 8]
                        })
                    })
                    .addTo(map)
                    .bindPopup( mensaje(key) ,{autoClose:false} )
                    .openPopup()

                    //markers.push(marker)
                }


                resolve();
            }, 10);
        });
    }

    function mensaje(key)
    {
        var mensaje=""
        mensaje += "<br/> Lago: <strong>" + key.data.lagonombre + "</strong>";
        mensaje += "<br/> Material: <strong>" + key.data.tipolagonombre + "</strong>";
        mensaje += "<br/> <strong> Sonda: </strong>";

        if( key.sonda.estado)
        {
          for (let index = 0; index < key.sonda.data.length; index++) {

             var element = key.sonda.data[index];
             mensaje += "<li>" + element.sensornombre + "</li>";

          }

        }

        mensaje += "<br/><strong> Cultivo: </strong>";
        mensaje += "<li>  Pez: <strong>" + key.data.especiepez + "</strong> </li>";
        mensaje += "<li> Inicio: <strong>" + key.data.fechainicio + "</strong> </li>";
        mensaje += "<li> Final: <strong>" + key.data.fechafinalizacion + "</strong> </li>";
        return mensaje;
    }

    $("#btnNotificacion").click(function(){



    })

})
*/