var xhro = new XMLHttpRequest();

    xhro.onreadystatechange=function(){
        if (xhro.readyState==4&&xhro.status==200){
            document.getElementById("test").innerHTML = xhro.responseText;
        }    
    }
function addQuestion(){
    xhro.open("POST","../php/AddQuestionWithImage.php");
    xhro.setRequestHeader("Content-type0","application/x-www-form-urlencoded");
    var eposta = document.getElementById("eposta");
    var e_zuzena =  document.getElementById("e_zuzena");
    var e_okerra1 =  document.getElementById("e_okerra1");
    var e_okerra2 =  document.getElementById("e_okerra2");
    var e_okerra3 =  document.getElementById("e_okerra3");
    var zailtasuna = document.getElementById("zailtasuna");
    var arloa = document.getElementById("arloa");
    var image = document.getElementById("choose-file").files[0];
    xhro.send()
}