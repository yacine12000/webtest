<?php
ob_start();
define('WP_USE_THEMES', false);
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
$post = get_post($_POST['id']);
setup_postdata($post);
?>
<div class="tvScreen">
	<script>
	function server(i, el) {
	    $(".serversUl > a").removeClass('active').removeAttr('active');
	    $(el).addClass('active');
	    $.ajax({
	        url: '<?php echo get_template_directory_uri()?>/servers/server.php',
	        data: 'q=<?php echo $post->ID?>&i='+i+'',
	        success: function(msg) {
	            $("#serverCode").html(msg);
	        }
	    });
	}
	</script>
	<div class="serversUl">
		<h2>
			<i class="fa fa-play"></i>
			سيرفرات المشاهدة
		</h2>
		<? $i = 1; foreach (get_post_meta($post->ID, 'watch', true) as $server) { ?>
			<a class="noAjax <? if( $i == '1' ) { ?>active<? } ?> server<?=$i?>" href="Javascript:void(0);" onclick="server(<?=$i?>, this);">سيرفر <?=$i?></a>
		<? $i++; } ?>
	</div>
	<div class="serverIframe" id="serverCode">
		<? $i = 1; foreach (get_post_meta($post->ID, 'watch', true) as $server) { ?>
			<? if( $i == '1' ) { ?>
				<?=$server['embed']?>
			<? } ?>
		<? $i++; } ?>
	</div>
</div>