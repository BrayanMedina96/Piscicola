$(function () {

    var url=`MC= ${getFull('user')}`

    $("#btnWizard").click(function () {
        $("#pnWizard").modal()
        cargarTreeWizard()
    })

    $("#btnMapa").click(function () {

        window.location.assign("../view/mapa.php")
  
     })

    function cargarTreeWizard() {


        var myTree = [{
            text: `Configuración`,
            nodes: [
                {
                    text: `Bienvenido`,
                },
                {
                    text: `Tipo Lago`,
                },
                {
                    text: `Lago`,
                },
                /*{
                    text: `Marcas de sondas`,

                },*/
                {
                    text: `Sonda`,

                }, {
                    text: "Rangos"
                },
                {
                    text: `Configuración (S-L)`,

                },
                {
                    text: `Cultivo`,

                },


            ]
        }, ];

        $('#default-tree-wizard').treeview({
            showBorder: false,
            showTags: true,
            highlightSelected: true,
            expandIcon: "icon-star-empty",
            collapseIcon: "icon-star-full",
            checkedIcon: "",
            uncheckedIcon: "",
            data: myTree,
            onNodeSelected: function (event, node) {
                selectNode(node.text);
            },

        });

    }

    function selectNode(key) {
        switch (key) {
            case "Bienvenido":
                $("#ifTipoLago").attr('src', `../view/bienvenido.php`).show();
            break;
            case "Tipo Lago":
                $("#ifTipoLago").attr('src', `../view/tipoLago.php?menu=1&${url}`).show();
                break;
            case "Lago":
                $("#ifTipoLago").attr('src', `../view/lago.php?menu=1&${url}`).show();
                break;
            /*case "Marcas de sondas":
                $("#ifTipoLago").attr('src', `../view/marca.php?menu=1&${url}`).show();
                break;*/
            case "Sonda":
                $("#ifTipoLago").attr('src', `../view/sensor.php?menu=1&${url}`).show();
                break;
            case "Configuración (S-L)":
                $("#ifTipoLago").attr('src', `../view/configuracion.php?menu=1&${url}`).show();
                break;
            case "Cultivo":
                $("#ifTipoLago").attr('src', `../view/cultivo.php?menu=1&${url}`).show();
                break;
            case "Rangos":
                $("#ifTipoLago").attr('src', `../view/rango.php?menu=1&${url}`).show();
                break;

            default:
                break;
        }
    }


    $("#btnQuestion").click(function(){
       $("#pnInfo").modal()
    })

})