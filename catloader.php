<?php 
define('WP_USE_THEMES', false);
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
?>
<div class="slider">
	<ul class="slides LoadedAJAAx">
		<? query_posts(array('post_type'=>'post', 'posts_per_page'=>12, 'cat'=>$_POST['cat'])); ?>
		<? if(have_posts()) { while(have_posts()) { the_post(); ?>
			<? require(get_template_directory().'/film.php'); ?>
		<? } } wp_reset_query(); ?>
	</ul>
</div>
<script type="text/javascript">
/////////////////////////////////
// carouFredSel
/////////////////////////////////
$(function() {
	$(".LoadedAJAAx").owlCarousel({
		items: 6,
		stopOnHover: true,
		autoPlay: 10000,
		addClassActive: true,
		navigationText : ["prev","next"],
	});
});
</script>
<? $cat = get_category($_POST['cat']); ?>
<a href="<?=get_term_link($cat)?>" class="MoreCatFooter">المزيد من <?=$cat->name?></a>