$(document).ready(function(){

    $("#fbLogin").click(function(){
        FB.login(function(response){
           console.log(response.email)
          },{scope: 'email'});
    })

    $("#fbLogout").click(function(){
        FB.logout(function(response) {
            
         });
    })
})

function statusChangeCallback(response) {  
    console.log('statusChangeCallback');
    console.log(response);                 
    if (response.status === 'connected') { 
      testAPI();  
    } else {                               
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this webpage.';
    }
  }


  function checkLoginState() {             
    FB.getLoginStatus(function(response) { 
      statusChangeCallback(response);
    });
  }


  window.fbAsyncInit = function() {
    FB.init({
      appId      : '943970049544335',
      cookie     : true,                   
      xfbml      : true,                   
      version    : 'v12.0'           
    });


    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);  
    });
  };
 
  function testAPI() {                    
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.email);
    });
  }
