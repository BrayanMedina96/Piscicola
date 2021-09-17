<html>

<head>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <title>Mapa v1.0</title>

    <?php 
          require("../plantilla/menu.php");
     ?>


  <!--  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
        integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
        integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
        crossorigin=""></script>-->

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChAqzk9KXEkrQsclmVyYUluRkEDI7Urh0&callback=initMap"
        async defer></script>

    <script src='../scripts/Aplicacion/jsUtilidad.js'></script>
    <script src='../scripts/Aplicacion/jsMapa.js'></script>
    <script src='../scripts/Aplicacion/class/jsClassSonda.js'></script>



</head>

<body>

    <div id="map"></div>

    <div id="panelOpcionLeft" class="btn-group-vertical">

        <button id="btnNotificacion" title="Notificación" class="btn_card" type="button">
            <img style="width:20px" src="../svg/notification.png">
        </button>

    </div>

</body>


</html>