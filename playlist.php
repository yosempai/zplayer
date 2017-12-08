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
	$mode       = $_REQUEST['mode'];
?>
   <div>
        <div class="responsiveVideoWrapper <?php echo $mode; ?>">
            <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
            <div id="player"></div>
        </div>
        <div id="playlistTitles" class="ytapivideoplayer <?php echo $mode; ?>"></div>
    </div>
</body>
</html>
