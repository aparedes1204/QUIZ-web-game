questionCounter = function(){
    var kont=0, total=0
            $.ajaxSetup({ cache: false });
            $.getJSON('../json/Questions.json', function (datuak) {
                $.each(datuak, function (i, field) {
                    for (var i = 0; i < field.length; i++) {
                        if (field[i].author == $("#eposta").val()) {
                            kont++
                        }
                        total++
                    }
                })
                $("#galderenKont").html("Nire galderak/Galderak guztira (JSON) datu-basean: "+kont+"/"+total-1)
            })
}

$(document).ready(function() {  
        questionCounter()
        setInterval(questionCounter,10000)
})