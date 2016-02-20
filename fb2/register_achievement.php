<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Register Achievements Page</title>

<script>
	    //load the js SDK asynchronously
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
	
	window.fbAsyncInit = function() {
    FB.init({
      appId      : '960499163985821',
      xfbml      : true,
      version    : 'v2.5',
      status     : true,
      cookie     : true
      //channelUrl : ''
    });
    }
    
    var appToken='<?php
    	$APPLICATION_ID='960499163985821';
    	$APPLICATION_SECRET='90c9d8be48ba9435ee2cdce53384f224';
    	
    	$token_url="https://graph.facebook.com/oauth/access_token?" .
    	'client_id=' . $APPLICATION_ID .
    	'&client_secret=' . $APPLICATION_SECRET .
    	'&grant_type=client_credentials';
    	$result=file_get_contents($token_url);
    	$pieces=explode('=', $result);
    	echo $pieces[1];
    	?>';
    	
    function registerAchievement(url){
    	FB.api('/960499163985821/achievements', 'post',{
    		'achievement':url,
    		'access_token':appToken,
    		'display_order':1
    	}, function(response){
    		if(response.error){
    			document.getElementById('mymessage').innerHTML = response.error.message;
    		}else{
    			document.getElementById('mymessage').innerHTML = "Thanks. This achievement has been registered with Facebook.";
    		}
    	});
    }
</script>
</head>
<body>

<div id="fb-root"></div>
<div id="mymessage"></div>
<button id="register" onclick="registerAchievement('http://www.elamsestates.com/fb/builder.php');">Register</button><br />


</body>
</html>