$(document).ready(function(){

    $("#logout").click(function(){
        var data = {}
        if (confirm(`Ziur zaude log out egin nahi duzula?`)){
             $.ajax({
                url: '../php/LogOut.php',
                data: data,
                type: 'POST',
                success: function(data) {
                    location.replace("../php/LayOut.php") 
                }, 
                error: function(data){
                     alert("Ezin izan da zerbitzariarekin konektatu")
                },
                cache: false
            })
        }

    });
});