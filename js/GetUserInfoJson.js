$(document).ready(function () {

    $("#bete").click(function () {

        var aurkitua
        $.getJSON('../json/Users.json', function (datuak) {
            $.each(datuak, function (i, field) {
                $("#tfno").val("")
                $("#izena").val("")
                $("#abizenak").val("")
                for (var i = 0; i < field.length; i++) {
                    if (field[i].eposta == $("#eposta").val()) {
                        $("#tfno").val(field[i].telefonoa)
                        $("#izena").val(field[i].izena)
                        $("#abizenak").val(field[i].abizena1 + " " + field[i].abizena2)
                        aurkitua = true
                    }
                }
            })

            if (!aurkitua) {
                $("#tfno").val("")
                $("#izena").val("")
                $("#abizenak").val("")
                alert("Ez dago " + $("#eposta").val() + " eposta duen erabiltzailerik")
            }

        })

    })



})