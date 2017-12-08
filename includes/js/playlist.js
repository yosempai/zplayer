//get API key from config.js file
var apiKey = config.APOD_KEY;

//get the titles of videos in playlist from youtube API
var playlistID = php_vars.playlist_id;
var youtubeAPIURL = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=50&playlistId="+playlistID+"&key="+apiKey;

jQuery.getJSON(youtubeAPIURL, function (data) { //scrape JSON text
  if( !data || data === ""){
    alert("no data");
    return;
  }
  var json = data;
  var playlistLength = json['pageInfo']['resultsPerPage'];
  for(var i = 0; i < playlistLength; i++){ //loop through playlist items
  jQuery("#playlistTitles").append("<div id='video"+i+"' class='ytbutton'><a href='#none' onclick='player.playVideoAt("+i+");' >"+json['items'][i]['snippet']['title']+"</a></div>"); //print the button with title
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
	  playerVars: { 'autoplay': 1, 'controls': 1, autohide:0, playsinline:1, rel:0, listType:'playlist',
          list: playlistID},
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
