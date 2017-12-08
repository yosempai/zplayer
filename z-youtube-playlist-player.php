<?php
/**
* Plugin Name: ZPlayer Youtube Playlist Player
* Plugin URI: N/A
* Description: A custom playlist player in JQuery using Youtube API
* Version: 1.1
* Author: Mitchell Allen
* Author URI: N/A
**/
//playlist.js, playlist.php


function zplayer_youtube_playlist( $atts ){
	 if( empty($atts['playlist_id']) ) {
	     return "No Playlist ID Specified :("; 
	     } else {
	       $width = $atts['width'];
	       	      $playlist_id = $atts['playlist_id'];
		      		   $mode = $atts['mode'];
				   	   //$mode = "stacked";
					   	   
							if($width > 0) {
								    $style = "width:".$width."%;";
								    	   } 
									     
										
										}
										
										$pluginFileURL = plugins_url( 'playlist.php', __FILE__ );
    $return = "<div class='intrinsic-container-16x9 ".$mode."' style='".$style."'><iframe style='border:0; width:100%; height:100%;' src='".$pluginFileURL."?id=".$playlist_id."&mode=".$mode."'></iframe></div>";
    return $return;
}
add_action( 'wp_enqueue_scripts', 'zplayer_enqueue_scripts' );
function zplayer_enqueue_scripts() {
	 add_shortcode( 'zplayer', 'zplayer_youtube_playlist' );
	 wp_register_style( 'style', plugins_url('stylesheet.css', __FILE__) );
	 wp_enqueue_style( 'style', get_stylesheet_uri() );
}

function get_playlist_code($playlist_id) {		
	 //get path to playlist.php file in plugin directory (current dir)
	 
}

/*
function js_enqueue_scripts() {
	  		      
			          wp_register_script( "scripts", plugin_dir_url( __FILE__ ) . "playlist.js", array( 'jquery' ), '1.6.4', true );
				      
				          
					      
					          wp_enqueue_script( "scripts" );
						  } */