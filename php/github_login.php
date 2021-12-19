<?php

if($_SERVER['REQUEST_METHOD']=="GET"){
	signup_github();
}

function signup_github()
{
	$client_id = '0a7982ebd304ebdff71f';
	$redirect_url = 'https://sw.ikasten.io/~aparedes009/WS/php/Layout.php';
	
	//login request
	if($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		$url = "https://github.com/login/oauth/authorize?client_id=$client_id&redirect_uri=$redirect_url&scope=user";
		header("Location: $url");
	}
}
?>