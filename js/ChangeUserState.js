$(document).ready(function(){

    $("#userTable").on('click','#permutationButton',function(){
         var currentRow=$(this).closest("tr"); 
        
         var data = {}
         data["eposta"] = currentRow.find("td:eq(0)").text();
         data["egoera"] = currentRow.find("td:eq(3)").text();
         
         $.ajax({
             url: '../php/ChangeUserState.php',
             data: data,
             type: 'POST',
             dataType: 'json',
             success: function(data) {
                //location.reload()
                currentRow.find("td:eq(3)").text(data.egoera);
                currentRow.find("#permutationButton").attr("value", data.buttonValue)
                 
             }, 
             error: function(data){
                 alert("Ezin izan da zerbitzariarekin konektatu")
             },
             cache: false
        })

    });
});