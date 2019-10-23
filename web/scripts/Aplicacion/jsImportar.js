$(function () {

    var reader = new FileReader;
    txtImportar = $("#txtImportar");

    $("#fileToUpload").change(function (event) {

        var file = event.target.files[0];
        reader.readAsText(file);
        reader.onload = onLoad;

    });


    function onLoad() {

        var result = reader.result;
        var lineas = result.split('\n');
        for (var linea of lineas) {

            txtImportar.append(linea);

        }

    }

})
