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
                });*/

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