<?php
ob_start();
define('WP_USE_THEMES', false);
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
?>
<?php $post = get_post( $_GET['q'] ); ?>
<?php setup_postdata($post); ?>
<? $servers = get_post_meta($post->ID, 'watch', true); ?>

<? $i = 1; foreach (get_post_meta($post->ID, 'watch', true) as $embed) { ?>
	<? if( $i == $_GET['i'] ) { ?>
    	<?=$embed['embed']?>
	<? } ?>
<? $i++; } ?>