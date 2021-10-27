$(document).ready(function() {

    $("#submit").click(function(){     
        
        var form = new FormData(document.forms["galderenF"])


        $.ajax({
            url: '../php/AddQuestionWithImage.php',
            data: form,
            enctype: 'multipart/form-data',
            processData: false, 
            contentType: false, 
            type: 'POST',
            success: function(data) {
              $("#test").html(data)
            }, 
            error: function(data){
                alert("Galdera ez da ondo gorde")
            },
            cache: false
        });
    })


})