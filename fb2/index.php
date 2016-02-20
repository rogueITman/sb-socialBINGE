<!DOCTYPE html>
<!-- xmlns="http://wwww.w3.org/1999/xhtml" emlns:og="http://ogp.me/ns"-->
<html>
<head>
	<meta charset="utf-8">
	<title>
		Elam's Estates LLC fb App
	</title>
	<link href='https://fonts.googleapis.com/css?family=Exo|Average' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="_/css/styles.css">
	<script type="text/javascript" src="_/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="_/js/myscript.js"></script>
	<script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
	<link rel="stylesheet" href="_/css/upload_video.css">
	<link rel="stylesheet" href="_/css/my_uploads.css">
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans' type='text/css'>
	<script type="text/javascript" src="_/js/instafeed.min.js"></script>
	<script type="text/javascript">
		var userFeed = new Instafeed({
			get: 'user',
		        userId: '2666030908',
		        accessToken: '2666030908.fbf7783.e210e240564b474789051f8037c34b3f'
		});
		userFeed.run();
	</script>
	
	<script>
		 function tplawesome(e,t){res=e;for(var n=0;n<t.length;n++){res=res.replace(/\{\{(.*?)\}\}/g,function(e,r){return t[n][r]})}return res}

$(function() {
    $("form").on("submit", function(e) {
       e.preventDefault();
       // prepare the request
       var request = gapi.client.youtube.search.list({
            part: "snippet",
            type: "video",
            q: encodeURIComponent($("#search").val()).replace(/%20/g, "+"),
            maxResults: 3,
            order: "viewCount",
            publishedAfter: "2015-01-01T00:00:00Z"
       }); 
       // execute the request
       request.execute(function(response) {
          var results = response.result;
          $("#results").html("");
          $.each(results.items, function(index, item) {
            $.get("tpl/item.html", function(data) {
                $("#results").append(tplawesome(data, [{"title":item.snippet.title, "videoid":item.id.videoId}]));
            });
          });
          resetVideoHeight();
       });
    });
    
    $(window).on("resize", resetVideoHeight);
});

function resetVideoHeight() {
    $(".video").css("height", $("#results").width() * 9/16);
}

function init() {
    gapi.client.setApiKey("969594929611-rv32lnq1cfbr04lk7k0d7akr85438bee.apps.googleusercontent.com");
    gapi.client.load("youtube", "v3", function() {
        // yt api is ready
    });
}
	</script>

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');

fbq('init', '1123443411008821');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1123443411008821&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
<script>fbq('track', 'ViewContent');</script>
</head>
<body>
	<div id="fb-root"></div>
	<div id="content">
		<!--<div class="loggedoff">
			<p>Welcome, you are not logged in. To see awesome features, please <a href="#" onclick="goLogIn()">Log in</a></p>
		</div>
		
		<div class="loggedin">
			<p>Welcome! Thanks for visiting our App.</p>
			<img src="images/appLogo3.png" />
		</div>
		
		<div>
			<h2>My First App</h2>
			<p>This is some text</p>
		</div>-->
		<!--<div id="welcome"></div>
		<img src="images/appLogo3.png" />
		<h2>My First App</h2>
		<p>This is some text</p>-->
		<div class="navShort label">
			<ul>
				<li class="label"><a href="https://elamsestates.com/fb/socialbinge_about">socialBINGE About Page</a>
				<li class="label"><a href="https://elamsestates.com/fb/socialbinge_pricing">socialBINGE Pricing Page</a></li>
				<li class="label"><a href="https://elamsestates.com/fb/socialbinge_features">socialBINGE Features Page</a></li>
			</ul>
		</div>
		<div id="main">
			<div id="fb-root"></div>
			<div id="mymessage"></div>
			<div id="welcome"></div>
			
			<div id="socialplugins">
		    	<h2 class="label">Social Stuff</h2>
		    	<p>Help me share this App as a service by liking, recommending, or sharing.</p>
		    	<div class="fb-like" data-href="https://apps.facebook.com/socialbinge/" data-layout="standard" data-action="like" data-show-faces="true" data-share="true" data-width="225px"></div><!--social plugin LIKE/SHARE btn-->
			<div class="fb-like" data-href="https://apps.facebook.com/socialbinge/" data-layout="standard" data-action="recommend" data-show-faces="true" data-share="false" data-width="100%"></div><!--social plugin RECOMMEND/SHARE btn-->
		        <div class="fb-follow" data-href="https://www.facebook.com/anthony.elam.14" data-layout="standard" data-show-faces="true" data-width="100%"></div>
			<div class="fb-live-stream" data-width="500" data-height="400" data-always-post-to-friends="false"></div>
			<div id="join" onclick="requestToFriends();"><img src="images/invite.png" alt="Invite Button" /></div>
			</div>
			
			
			<div id="tweets"></div>
			<!--<form id="form"><input type="text" id="search" /></form>-->
			
			
		</div><!--mainContent-->
		<div id="sidebar">
		    <div id="blog"></div>
		    <div class="fb-comments" data-href="http://apps.facebook.com/socialbinge/" data-width="200px" data-numposts="5"></div>
		    <div id="videogroup"></div> <!--videogroup-->
		    <h2 class="label">Latest Instagram</h2>
		    <div id="instafeed"></div> <!--instagram-->
		    <div id="instagram"></div> <!--instagram not used-->
				    
<!------------------>




<!-------------------->
		
		</div><!--sidebarContent-->
		
	</div><!--content-->
	<!--<script type="text/javascript" src="https://www.googleapis.com/youtube/v3/playlists?part=snippet&channelId=UCdJGmurxNNXEW8aLvH2HGZw&key=AIzaSyAtzQQ2uM1QfjvqShhC28inTjpMxqE6_B8?alt=json-in-script&callback=populateVideos&max-results=7&category=Villalobos"></script>-->
	<script type="text/javascript" src="https://www.googleapis.com/youtube/v3/playlists?part=snippet&channelId=UCikzJG7RbnNZhKLqqaXRM6A&key=AIzaSyAtzQQ2uM1QfjvqShhC28inTjpMxqE6_B8&callback=populateVideos"></script>
	<!--<script type="text/javascript" src="https://elamsestates.com/blog/?json=1&count=10&callback=listPosts"></script>
	<script type="text/javascript" src="https://elamsestates.com/twitter/tweets_json.php?count=30&callback=listTweets"></script>
	<script type="text/javascript" src="https://api.flickr.com/services/feeds/photos_public.gne?id=137778500@N07&format=json"></script>-->
	<script src="//apis.google.com/js/client:plusone.js"></script>
	<script src="_/js/auth.js"></script>
	<script src="_/js/playlist_updates.js"></script>
	<script src="_/js/cors_upload.js"></script>
	<script src="_/js/upload_video.js"></script>
	
	<script src="_/js/myscript.js"></script>
	<script src="https://apis.google.com/js/client.js?onload=init"></script>
</body>
</html>