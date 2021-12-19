$(document).ready(function(){

    $("#fbLogin").click(function(){
        FB.login(function(response){
           console.log(response.email)
          },{scope: 'email'});
    })

    $("#fbLogout").click(function(){
        FB.logout(function(response) {
            // Person is now logged out
         });
    })
})