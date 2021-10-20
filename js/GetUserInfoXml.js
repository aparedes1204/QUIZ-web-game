$(document).ready(function () {
    $("#bete").click(function () {

        $.get('../xml/Users.xml', function (datuak) {
            var erabZer = $(datuak).find('erabiltzailea');

            var aurkitua
            for (var i = 0; i < erabZer.length; i++) {
                if ($("#eposta").val() == erabZer[i].childNodes[1].childNodes[0].nodeValue) {
                    $("#tfno").val(erabZer[i].childNodes[9].childNodes[0].nodeValue)
                    $("#izena").val(erabZer[i].childNodes[3].childNodes[0].nodeValue)
                    $("#abizenak").val(erabZer[i].childNodes[5].childNodes[0].nodeValue + " " + erabZer[i].childNodes[7].childNodes[0].nodeValue)
                    aurkitua = true
                }
            }
            if (!aurkitua) {
                $("#tfno").val("")
                $("#izena").val("")
                $("#abizenak").val("")
                alert("Ez dago " + $("#eposta").val() + " eposta duen erabiltzailerik")
            }


        })
    })
});