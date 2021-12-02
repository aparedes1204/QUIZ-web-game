userCounter = function(){
    $("#userKont").load('../xml/UserCounter.xml')
}

$(document).ready(function() {  
    userCounter()
    setInterval(userCounter,2000)
})