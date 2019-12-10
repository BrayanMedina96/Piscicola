$(function () {
    
    $("#txtFecha").datepicker({
        onSelect: function (fd, d, calendar) {
            calendar.hide()
        }
    })

    $("#txtHora").datepicker({
        dateFormat: ' ',
    timepicker: true,
    classes: 'only-timepicker',
        onSelect: function (fd, d, calendar) {
            calendar.hide()
        }
    })














})