$(document).ready(function() {

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
                    $("#epostaAlert").html()
                    $("#epostaAlert").html("Eposta zuzena. Web Sistemak ikasgaian matrikulatuta zaude")

                    var emailRE = /^[a-zA-Z]+([0-9]{3}@ikasle\.ehu|(\.[a-zA-Z]+){0,1}[a-zA-Z]+@ehu)\.(eus|es)$/
                    
                    if (emailRE.test(eposta)) {
                        $("#submit").removeAttr("disabled")
                    } else {
                        alert("Eposta okerra")
                    }  
                } else {
                    $("#epostaAlert").html()
                    $("#epostaAlert").html("Eposta okerra. Ez zaude Web Sistemak ikasgaian matrikulatuta")
                    $("#submit").prop("disabled", true)
                }
            }, 
            error: function(data){
                $("#epostaAlert").html()
                $("#epostaAlert").html("Arazo bat egon da matrikulak kontsultatzerakoan")
                $("#submit").prop("disabled", true)
            },
            cache: false
        });
    })


})