$(document).ready(function(){

    $("#userTable").on('click','#removeButton',function(){
         var currentRow=$(this).closest("tr"); 
        
         var data = {}
         data["eposta"] = currentRow.find("td:eq(0)").text();
         
         $.ajax({
             url: '../php/RemoveUser.php',
             data: data,
             type: 'POST',
             success: function(data) {
                currentRow.remove()
             }, 
             error: function(data){
                 alert("Ezin izan da zerbitzariarekin konektatu")
             },
             cache: false
        })

    });
});