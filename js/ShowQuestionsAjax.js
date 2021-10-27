var xhro = new XMLHttpRequest()

xhro.onreadystatechange = function(){
    if (xhro.readyState == 4){
        var htmlTXT = xhro.response;
        var div = document.createElement('div');
        div.innerHTML = htmlTXT;
        var elements = div.getElementsByTagName('div');
        document.getElementById("galderak").innerHTML = elements[2].innerHTML
    }
}

function showQuestions(){
    xhro.open("GET", "../php/ShowJsonQuestions.php") 
    xhro.send();
}