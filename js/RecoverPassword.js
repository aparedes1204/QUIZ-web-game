$(document).ready(function(){

    $("#emailsubmit").on('click',function(){ 
        if($("#eposta").val() == ""){
            $("#epostaAlert").html("Eposta bat sartu")
        } else {
            var data = {}
            data["eposta"] = $("#eposta").val();
            data["mail"] = ""
            $.ajax({
                url: '../php/RecoverPassword.php',
                data: data,
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    if(!data.correct){
                        $("#epostaAlert").html("Eposta okerra")
                        $("#epostaAlert").css("color", "red")
                        $("#code").prop("disabled", true)
                    } else {
                        $("#epostaAlert").html("")
                        $("#eposta").prop("readonly", true)
                        $("#codeAlert").html("Kode zure epostara bidali da") 
                        $("#code").removeAttr("disabled")
                        $("#emailsubmit").remove()
                    }
                    
                }, 
                error: function(data){
                    alert("Errorea zerbiztariarekin konektatzerakoan")
                },
                cache: false
            })
        }

    });

    $("#code").on('keyup',function(){ 
        var data = {}
        data["code"] = $("#code").val();
        data["validate"] =""
        $.ajax({
            url: '../php/RecoverPassword.php',
            data: data,
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                if(!data.correct){
                    $("#codeAlert").html("Kode okerra")
                    $("#codeAlert").css("color", "red")
                } else {
                    $("#codeAlert").html("Kode zuzena")
                    $("#codeAlert").css("color", "green")
                    $("#code").prop("readonly", true)
                    $("#eginbeharrekoa").html("Sartu nahi duzun pasahitza berria, gutxienez 8 karaktere") 
                    $("#pasahitzacontainer").css("display", "block")
                    $("#pasahitzacontainer").after($('<input type="button" id="pasahitzaaldatu" value="Pasahitza aldatu">'));

                    $("#pasahitzaaldatu").click(function(){ 
                        var data = {}
                        data["eposta"] = $("#eposta").val();
                        data["pasahitza"] = $("#pasahitza").val();
                        data["pasahitzaErrep"] = $("#pasahitzaErrep").val();
                        $.ajax({
                            url: '../php/RecoverPassword.php',
                            data: data,
                            type: 'POST',
                            dataType: 'json',
                            success: function(data) {
                                if(data.correct == 1){
                                    $("#pasahitzaAlert").html("Pasahitz okerra. Gutxienez 8 karakterekoa izan behar da, hutsunerik gabe")
                                }
                                if (data.correct == 2){
                                    $("#pasahitzaAlert").html('Pasahitzak ez dira berdinak')
                                }
                                if (data.correct == 3){
                                    $("#pasahitzaAlert").html('Arazo bat egon da pasahitza aldatzerakoan')
                                }
                                if (data.correct == 0){
                                    if (confirm("Pasahitza aldatu egin da")){
                                        window.location.assign("../php/Layout.php")
                                    }
                                }
                            }, 
                            error: function(data){
                                alert("Errorea zerbiztariarekin konektatzerakoan")
                            },
                            cache: false
                        })
                
                    });
                
                }
                
            }, 
            error: function(data){
                alert("Errorea zerbiztariarekin konektatzerakoan")
            },
            cache: false
        })

    });

});

