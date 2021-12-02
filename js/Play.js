var id_list = new Array()
var index = 0
var zuzen = 0
var erantzunda = 0
$(document).ready(function(){

    $(".gaia").click(function(){
        var gaia = $(this).val()
        var data = {}
        data["gaia"]=gaia
         $.ajax({
             url: '../php/GetQuestion.php',
             type: 'POST',
             data: data,
             dataType: 'json',
             success: function(data) {
                id_list = data.response 
                $.ajax({
                    url: '../php/GetQuestion.php',
                    type: 'POST',
                    data: {"id":id_list[index]},
                    dataType: 'html',
                    success: function(data) {
                        $("#content").html(data)
                        index++
                        if (index == id_list.length){
                            $("#hurrengoa").val("Emaitzak ikusi")
                        }
                    }, 
                    error: function(data){
                        alert("Ezin izan da zerbitzariarekin konektatu")
                    },
                    cache: false
               })
             }, 
             error: function(data){
                 alert("Ezin izan da zerbitzariarekin konektatu")
             },
             cache: false
        })

    });
});
$(document).on('click', '#hurrengoa', function(e){
    if(index < id_list.length){
        $.ajax({
            url: '../php/GetQuestion.php',
            type: 'POST',
            data: {"id":id_list[index]},
            dataType: 'html',
            success: function(data) {
            index++
            $("#content").html(data)
            if (index == id_list.length){
                $("#hurrengoa").val("Emaitzak ikusi")
            }
            }, 
            error: function(data){
                alert("Ezin izan da zerbitzariarekin konektatu")
            },
            cache: false
        })
    } else {
        emaitzak()
    }
});

$(document).on('click', '#erantzun', function(e){
    var erantzunanum = $('input[name=erantzuna]:checked', '#questionF').val()
    var erantzuna = $(`#erantzuna${erantzunanum}`).text().trim()
    if(erantzunanum == null){
       alert("Erantzun bat aukeratu")
   } else  {
        var data = {}
        data["id"] = id_list[index-1]
        data["erantzuna"] = erantzuna
        $.ajax({
            url: '../php/CheckQuestion.php',
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(data) {
                $("#erantzun").prop("disabled", true)
                $("[name=erantzuna]").each(function(){
                    $(this).prop("disabled", true)
                });
                $("#hurrengoa").removeAttr("disabled")
                if(data.correct){
                    zuzen++
                    $("#erantzuninfor").text("Erantzun zuzena. Zorionak")
                    $("#erantzuninfor").css("color", "green")
                } else {
                    $("#erantzuninfor").text("Erantzun okerra")
                    $("#erantzuninfor").css("color", "red") 
                }
                erantzunda++
            }, 
            error: function(data){
                alert("Ezin izan da zerbitzariarekin konektatu")
            },
            cache: false
        })
    }
});

$(document).on('click', '#like', function(e){
    var data = {}
    data['like'] = ""
    data['id'] = id_list[index-1]
    $.ajax({
        url: '../php/GalderaBaloratu.php',
        type: 'POST',
        data: data,
        dataType: 'html',
        success: function(data) {
            $("#balorazioa").text(data)
            $("#like").prop("disabled", true)
            $("#dislike").removeAttr("disabled")
        }, 
        error: function(data){
            alert("Ezin izan da zerbitzariarekin konektatu")
        },
        cache: false
    })
});

$(document).on('click', '#dislike', function(e){
    var data = {}
    data['dislike'] = ""
    data['id'] = id_list[index-1]
    $.ajax({
        url: '../php/GalderaBaloratu.php',
        type: 'POST',
        data: data,
        dataType: 'html',
        success: function(data) {
            $("#balorazioa").text(data)
            $("#dislike").prop("disabled", true)
            $("#like").removeAttr("disabled")
        }, 
        error: function(data){
            alert("Ezin izan da zerbitzariarekin konektatu")
        },
        cache: false
    })
});

$(document).on('click', '#emaitzak', function(e){
   emaitzak()
});

$(document).on('click', '#gordeemaitzak', function(e){
    if($("#eposta").val() == ""){
        $("#vipAlert").text("Sartu eposta bat")
    } else {
        var data = {}
        data["eposta"] = $("#eposta").val()
        $.ajax({
            url: '../php/isVip.php',
            type: 'POST',
            data: data,
            dataType: 'text',
            success: function(data) {
                var response = data.search("ZORIONAK")
                if(response == -1){
                    $("#vipAlert").text("Ez duzu kontu vip-a") 
                } else {
                    var emaitzak = {}
                    emaitzak["eZuzenak"] = zuzen
                    emaitzak["eOkerrak"] = erantzunda - zuzen
                    emaitzak["eposta"] = $(this).val()
                    $.ajax({
                        url: '../php/GordeEmaitzak.php',
                        type: 'POST',
                        data: emaitzak,
                        dataType: 'text',
                        success: function(data) {
                            if(data == "success"){
                                if (confirm("Zure puntuaketa gorde egin da")){
                                    window.location.assign("../php/Layout.php")
                                }
                            } else {
                                alert("Arazo bat egon da emaitzak gordetzerakoan")
                            }
                        }, 
                        error: function(data){
                            alert("Ezin izan da zerbitzariarekin konektatu")
                        },
                        cache: false
                    })
                }
            }, 
            error: function(data){
                alert("Ezin izan da zerbitzariarekin konektatu")
            },
            cache: false
        })

    }
 });

function emaitzak(){
    $("#content").html(`
        <form id='emaitzakF')>
            <h3>Joko sesioaren bukaeran hauek dira zure emaitzak</h3>
            <p>Erantzundako galdera kopurua: ${erantzunda}</p>
            <p>Zuzen erantzundako galdera kopurua: ${zuzen}</p>
            <p>Kontu VIP bat baduzu emaitzak gorde ditzazkezu zure eposta sartuz</p>
            <p>Eposta: <input type='text' id='eposta'></p>
            <p id="vipAlert"></p>
            <p><input type='button' id='gordeemaitzak' value='Emaitzak gorde'></p>
        </form>
    `)
}