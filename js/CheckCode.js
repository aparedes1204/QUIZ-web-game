$(document).ready(function(){

    $("#code").on('keyup change',function(){ 
        var data = {}
        data["code"] = $("#code").val();
         $.ajax({
             url: '../php/CheckCode.php',
             data: data,
             type: 'POST',
             dataType: 'json',
             success: function(data) {
                 if(data.correct){
                    $("#epostaAlert").html("Kode zuzena")
                    $("#epostaAlert").css("color", "green") 
                    $("#pasahitza").removeAttr("disabled")
                    $("#pasahitzaErrep").removeAttr("disabled")
                    $("#submit").removeAttr("disabled")
                 } else {
                    $("#epostaAlert").html("Kode okerra")
                    $("#epostaAlert").css("color", "red") 
                    $("#pasahitza").prop("disabled", true)
                    $("#pasahitzaErrep").prop("disabled", true)
                    $("#submit").prop("disabled", true)
                 }
                 
             }, 
             error: function(data){
                $("#pasahitza").prop("disabled", true)
                $("#pasahitzaErrep").prop("disabled", true)
                $("#submit").prop("disabled", true)
             },
             cache: false
        })

    });
function validatePasswords(){
    if($("#pasahitza").val() != $("#pasahitzaErrep").val()){
        $("#pasahitzaAlert").html("Pasahitzak ez dira berdinak")
        return false
    }
}
});