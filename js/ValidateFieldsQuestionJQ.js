$(document).ready(function() {

    $("#submit").click(function() {

        var eposta = $("#eposta").val()
        var galdera = $("#galdera").val()
        var e_zuzena = $("#e_zuzena").val()
        var e_okerra1 = $("#e_okerra1").val()
        var e_okerra2 = $("#e_okerra2").val()
        var e_okerra3 = $("#e_okerra3").val()
        var zailtasuna = $("#zailtasuna").val()
        var arloa = $("#arloa").val()



        if ($.trim(eposta) === "" || $.trim(galdera) === "" || $.trim(e_zuzena) === "" || $.trim(e_okerra1) === "" || $.trim(e_okerra2) === ""
            || $.trim(e_okerra3) === "" || zailtasuna == "" || $.trim(arloa) === "") {

            alert("Bete derrigorrezkoak diren eremuak (*)")
            return false

        }


        var emailRE = /^[a-zA-Z]+([0-9]{3}@ikasle\.ehu|(\.[a-zA-Z]+){0,1}[a-zA-Z]+@ehu)\.(eus|es)$/


        if (!emailRE.test(eposta)) {

            alert("Eposta okerra")
            return false

        }


        if (galdera.length < 10) {
            alert("Galdera motzegia (10 karaktere baina gutxiago)")
            return false

        }

        return true
    })

    $("#eposta").change(function (){
        var eposta = $("#eposta").val()
        var data = {}
        data["eposta"] = eposta

        $.ajax({
            url: '../php/ClientVerifyEnrollment.php',
            data: data,
            dataType: "json",
            type: 'POST',
            success: function(data) {
                if (data.enrolled){
                    var emailRE = /^[a-zA-Z]+([0-9]{3}@ikasle\.ehu|(\.[a-zA-Z]+){0,1}[a-zA-Z]+@ehu)\.(eus|es)$/
                    
                    if (emailRE.test(eposta)) {
                        $("#submit").removeAttr("disabled")
                    } else {
                        alert("Eposta okerra")
                    }  
                } else {
                    alert("Eposta okerra. Ez zaude Web Sistemak ikasgaian matrikulatuta")
                    $("#submit").prop("disabled", true)
                }
            }, 
            error: function(data){
                alert("Arazo bat egon da matrikulak kontsultatzerakoan")
                $("#submit").prop("disabled", true)
            },
            cache: false
        });
    })


})