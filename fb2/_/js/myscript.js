window.fbAsyncInit = function() {
    FB.init({
      appId      : '960499163985821',
      xfbml      : true,
      version    : 'v2.5',
      status     : true,
      cookie     : true
      //channelUrl : ''
    });
    
    //by placing this function here it will execute after the fb api has loaded
    listPosts();
    listTweets();
    handleAPILoaded();
    
    FB.getLoginStatus(function(response) {
      if (response.status === 'connected') {
        // the user is logged in and has authenticated your
        // app, and response.authResponse supplies
        // the users ID, a valid access token, a signed
        // request, and the time the access token 
        // and signed request each expire
        var uid = response.authResponse.userID;
        var accessToken = response.authResponse.accessToken;
        //$('.loggedin').css('display','block');
    	//$('.loggedoff').css('display','none');
    	
    	FB.api('/me', function(info){
    		console.log(info);
    		document.getElementById('welcome').innerHTML= "Hello there " + info.name;
    	});
    	
    	FB.ui({
	  method: 'pagetab',
	  redirect_uri: 'https://elamsestates.com/fb'
	}, function(response){});
	
	/* make the API call */
FB.api(
  '/me',
  'GET',
  {"fields":"email,likes,birthday,name,about,education"},
  function(response) {
      // Insert your code here
      populateData(response);
  }
);

    	FB.api('/960499163985821/achievements','get',{
    		'access_token': '960499163985821|4UQlajldAuQHLs3fNZERuQzHPS8'
    	}, function(appResponse){
    		//declare variable to hold app achievement data
    		appAchievements=appResponse.data;
    	}); //get app achievements
    	    		
      } else if (response.status === 'not_authorized') {
        // the user is logged in to Facebook, 
        // but has not authenticated your app
        FB.login(function(response){},{scope:'user_friends,user_about_me,user_location,user_photos,publish_actions,user_birthday,user_likes',enable_profile_selector:true});
         
	var oauth_url = "https://www.facebook.com/dialog/oauth/";
	oauth_url += '?client_id=960499163985821'; //your client id
	oauth_url += '&redirect_uri=' + 'https://apps.facebook.com/socialbinge/';//send them here if theyre not logged in
	oauth_url += '&scope=user_about_me,user_location,user_photos,publish_actions,user_birthday,user_likes';
	   
	window.top.location = oatuh_url;
	
        
      } else {
        // the user isnt logged in to Facebook.
        window.top.location = "https://www.facebook.com/index.php";
      } //response.status
   }); //getLogInStatus
}; //fbAsyncInit

    /*function goLogIn() {
    	FB.login(function(response){
    		//handle the response
    		$('.loggedin').css('display','block');
    		$('.loggedoff').css('display','none');
    	},{scope:publish_actions});
    }*/ //goLogIn
    
    /*from youtube training vid
    function populateVideos(data){
    	var entries = data.feed.entry;
    	var output = '<h2 class="label">Latest Videos</h2>';
    	
    	output += '<ul>';
    	for (var i=0; i<data.feed.entry.length; i++){
    		var entriesID=entries[i].id.$t.substring(38);
    		var entriesTitle=entries[i].title.$t;
    		var entriesDescription=entries[i].media$group.media$description.$t;
    		var entriesThumbnail=entries[i].media$group.media$thumbnail[1].url;
    		
    		output += '<li><div class="entriestitle">' + entriesTitle + '</div>';
    		output += '<a href="https://www.youtube.com/wathc?v=' +entriesID+ '&feature=youtube_gdata"' target="_blank"><img src=' +entriesThumbnail+ ' alt=' +entriesTitle+ ' /></a>';
    	}
    	
    	output +='</ul>';
    	document.getElementById('videogroup').innerHTML = output;
    }*/
    
    function populateVideos(data){
	var output = '';
	output += '<h2 class="label">Latest Videos</h2>';
	for(var i = 0; i < data.items.length; i++){
		var title = data.items[i].snippet.title;
		var thumbnail = data.items[i].snippet.thumbnails.default.url;
		var description = data.items[i].snippet.description;
		var id = data.items[i].id;

		var blocktype = ((i % 2)===1) ? 'b':'a';
		output += '<div class="ui-block-' +blocktype+ '">';
		output += '<h3 class="movietitle">' +title+ '</h3>';
		output += '<a href="" data-transition="fade">';
		//output += '<img src="' +thumbnail+ '" alt=" ' + title + '">';
		output += '<iframe src="https://www.youtube.com/embed/videoseries?list=' +id+ '&wmode=transparent&amp;HD=0&amp;showinfo=0;controls=1&amp;autoplay=0" frameborder="0" allowfullscreen></iframe>';
		output += '</a>';
		output += '</div>';
	}//entries loop
	$('#videogroup').html(output);
}//listVids

    function listPosts(){
    	$.getJSON('https://elamsestates.com/blog/?json=1', function(data){
    		var output = '';
    		var excerpt='';
    		output = '<h2 class="label">Latest Blog Posts</h2>';
    		$.each(data.posts, function(key, val){
    			var title = data.posts[key].title;
    			var link = data.posts[key].url;
    			
    			//get excerpt, but remove click to read link
    			
    			/*var tempDiv = document.createElement('tempDiv');
    			tempDiv.innerHTML - data.posts[key].excerpt;
    			$('a', tempDiv).remove();
    			var excerpt = tempDiv.innerHTML;*/
    			
    			
    			//set up the output
    			output += '<div id="storyid' +key+ '" class="articles">';
    			output += '<h3><a href="' +link+ '" target="_blank">' +title+ '</a></h3>';
    			output += '<p>' +data.posts[key].excerpt;
    			
    			output += '<a onclick="postToFeed(\'' +title+ '\',\'' +link+ '\',\'' +excerpt+ '\');">Post to Feed</a>';
    			output += '<br><a onclick="messageToFriend(\'' +title+ '\',\'' +link+ '\',\'' +excerpt+ '\'); return false;">Message To Friend</a>';
    			
    			output += '</p>';
    			output += '</div>';
    		}); //go throught each piece of JSON data
    		document.getElementById('blog').innerHTML = output;
    	}); //get JSON data for stories
    } //populate stories
    
    function listTweets(){
    	$.getJSON('/twitter/tweets_json.php?count=10', function(data){
    		var output = '';
    		var excerpt='';
    		output = '<h2 class="label">Latest Tweets</h2>';
    		$.each(data, function(key, val){
    			var text = data[key].text;
			var thumbnail = data[key].user.profile_image_url;
			var name = data[key].user.name;
    			
    					//parse(means translate) urls in twitter text
			text = text.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&~\?\/.=]+/g, function(i){
				var url=i.link(i);
				return url;
			});
			//parse(means translate) @mentions in twitter text
			text = text.replace(/[@]+[A-Za-z0-9-_]+/g, function(i){
				var item=i.replace("@","");
				var url=i.link("https://twitter.com/" + item);
				return url;
			});
			//parse(means translate) hashtags in twitter text
			text = text.replace(/[#]+[A-Za-z0-9-_]+/g, function(i){
				var url=i.link(i);
				return url;
			});
	
			output += '<li>';
			output += '<img src="' +thumbnail+ '" alt="Photo of ' +name+ '">';
			output += '<div>' +text+ '</div>';
			output += '</li>';
    		}); //go throught each piece of JSON data
    		document.getElementById('tweets').innerHTML = output;
    	}); //get JSON data for stories
    } //populate stories
    
    $('._5lm5._2pi3._3-8y ._42ef._8u').css('display','none');
    
    function postToFeed(title, link, excerpt){
    	FB.ui({
    		method:'feed',
    		'link':link,
    		'picture':'http://pbs.twimg.com/profile_images/678414496918990848/nER9NVQR_normal.png',
    		'name':title,
    		'caption':'Elams Estates Blog',
    		'description':excerpt
    	}, function(response){
    		if(response && response.post_id){
    			document.getElementById('mymessage').innerHTML='Thanks. This has been posted onto your timeline.';
    		}else{
    			document.getElementById('mymessage').innerHTML='The post was not published.';
    		} //response from post attempt
    	}); //call to FB.ui
    } //postToFeed


        function messageToFriend(title, link, excerpt){
    	FB.ui({
    		method:'send',
    		'link':link,
    		'picture':'https://scontent-atl3-1.xx.fbcdn.net/hprofile-xfa1/v/t1.0-1/p50x50/1620495_921748321194573_3711801221490778895_n.jpg?oh=574a842cee54098c1553b1902f5a7432&amp;oe=5708D9FC',
    		'name':title,
    		'caption':'Elams Estates Messenger',
    		'description':excerpt
    	}, function(response){
    		if(response && response.post_id){
    			document.getElementById('mymessage').innerHTML='Thanks. The message has been sent.';
    		}else{
    			document.getElementById('mymessage').innerHTML='The message was cancelled.';
    		} //response from post attempt
    	}); //call to FB.ui
    } //postToFeed
    
     function requestToFriends(){
 	FB.ui({
 		method:'apprequests',
 		message:'CONNECT my social media',
 		});
 }
 
 

 

  //load the js SDK asynchronously
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   
   
   