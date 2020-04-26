<?php 
define('WP_USE_THEMES', false);
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
$id = $_POST['id'];
$post = new post();
$post->set_like($id);
echo $post->likes($id);