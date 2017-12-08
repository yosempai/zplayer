<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="js">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Zager Guitar Videos</title>
<link rel="stylesheet" type="text/css" href="includes/css/master.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>
	<div id="preloader"></div>
	<?php
		$playlistID = $_REQUEST['id'];
		$mode = $_REQUEST['mode'];
	?>
	<div>
		<div class="responsiveVideoWrapper <?php echo $mode ?>">
			<!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
			<div id="player"></div>
		</div>
		<div id="playlistTitles" class="ytapivideoplayer <?php echo $mode ?>"></div>
	</div>
<script>
jQuery(document).ready(function($) {

// site preloader -- also uncomment the div in the header and the css style for #preloader
$(window).load(function(){
	$('#preloader').fadeOut('slow',function(){$(this).remove();});
});

});

//get the titles of videos in playlist from youtube API
var youtubeAPIURL = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=50&playlistId=<?php echo $playlistID; ?>&key="+apiKey;

$.get(youtubeAPIURL, function (data) { //scrape JSON text
  if( !data || data === ""){
    return;
  }
  var json;
  try {
    json = jQuery.parseJSON(data); //parse JSON to js array
  } catch (e) {
    //error
    return;
  }
  	var playlistLength = json['pageInfo']['totalResults'];
	for(i = 0; i < playlistLength; i++){ //loop through playlist items
		if(i == playlistLength-1) {
			var classes = 'ytbutton last';
		} else {
			var classes = 'ytbutton';
		}
		$("#playlistTitles").append("<div id='video"+i+"' class='"+classes+"'><a href='#none' onclick='player.playVideoAt("+i+");' >"+json['items'][i]['snippet']['title']+"</a></div>"); //print the button with title
	}

}, "text");

	//make the video player
  // 2. This code loads the IFrame Player API code asynchronously.
  var tag = document.createElement('script');

  tag.src = "https://www.youtube.com/iframe_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

  // 3. This function creates an <iframe> (and YouTube player)
  //    after the API code downloads.
	var player;
	function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
      height: '375',
      width: '500',
	  playerVars: { 'autoplay': 0, 'controls': 1, autohide:0, playsinline:1, rel:0, listType:'playlist',
          list: '<?php echo $playlistID; ?>'},
      events: {
        'onReady': onPlayerReady,
        'onStateChange': onPlayerStateChange
      }
    });
  }

  // 4. The API will call this function when the video player is ready.
  function onPlayerReady(event) {
    //player.playVideo();
	document.getElementById("video0").className = "ytactive";
  }

  // 5. The API calls this function when the player's state changes.
  //    The function indicates that when playing a video (state=1),
  //    the player should play for six seconds and then stop.
  var done = false;
function onPlayerStateChange(event) {   ///color the button blue
    if(event.data === -1) {    //video is not started yet
		var index = player.getPlaylistIndex(); //get current video
		for(i=0;i<player.getPlaylist().length;i++) {
			if(index == i) {
				document.getElementById("video"+i).className = "ytactive"; //set active button blue
			} else {
				document.getElementById("video"+i).className = "ytbutton"; //reset button gray
			}
		}

    } else if(event.data === 1) {
		//alert(player.getVideoData().title);
	}
}
  function stopVideo() {
    player.stopVideo();
  }

  function loadNewVideo(id) {
          if (player) {
            player.loadVideoById(id);
          }
        }
</script>
</body>
</html>
