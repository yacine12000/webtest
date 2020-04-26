<? $comments = new post(); ?>

<?

if( array_key_exists('sendcomment', $_POST) ) { ?>

<?

$comments->addComment($_POST['nameUser'], $post->ID, $_POST['comment'], $_POST['email']);

?>

<? header('Location: '.get_the_permalink().''); ?>

<? } ?>

<?php get_header(); ?>
<? update_post_meta($post->ID, 'views', get_post_meta($post->ID, 'views', true)+1); ?>
<? $imagenes = explode('
', get_post_meta($post->ID, 'imagenes', true)); ?>
<script>
$(document).ready(function(e) {
    $('.showTrailer').click(function(){
        $('.modalTrailer').toggle();
        $('.modalTrailer *').attr('autoplay', '');
    });
    $('.modalTrailerClose').click(function(){
        $('.modalTrailer').hide();
    });
});
</script>
<div class="modalTrailer" style="display:none;">
    <div class="modalTrailerClose"></div>
    <?=get_post_meta($post->ID, 'Trailer', true)?>
</div>
<div class="CoverIntroMovie">
	<div class="backdrop-wrap"><div class="backdrop" style="background-image:url(<?=(wp_get_attachment_url(get_post_thumbnail_id($post->ID)) == '') ? get_post_meta($post->ID, 'poster_serie', true) : wp_get_attachment_url(get_post_thumbnail_id($post->ID))?>);"></div></div>
	<div class="container">
		<? if( has_post_thumbnail() ) { ?>
			<? the_post_thumbnail(); ?>
		<? }else { ?>
			<img src="<?=get_post_meta($post->ID, 'poster_serie', true)?>" alt="<? the_title(); ?>" />
		<? } ?>
		<div class="titleCover">
			<h2><? the_title(); ?> - <?=get_post_meta($post->ID, 'name', true)?></h2>
			<span class="quality">
				<? foreach ((is_array(get_the_terms($post->ID, 'episodeyear', ''))) ? get_the_terms($post->ID, 'episodeyear', '') : array() as $person) { ?><a href="<?=get_term_link($person)?>"><?=$person->name?></a><? } ?>
			</span>
			<em></em>
			<span class="year"><?=get_post_meta($post->ID, 'air_date', true)?></span>
		</div>
		<div class="contentFilm">
			<? the_content(); ?>
		</div>
	</div>
	<? query_posts(array('name'=>get_post_meta($post->ID, 'serie', true), 'posts_per_page'=>1, 'post_type'=>'tvshows')); ?>
	<? if(have_posts()) { while(have_posts()) { the_post(); ?>
	<a href="<?=get_permalink($post->ID); ?>" class="viewMovie">
		<i class="fa fa-angle-left" style="
    padding-left: 0;
    font-size: 80px;
    padding-right: 5px;
    padding-top: 11px;
"></i>
		<span>رجوع للمسلسل</span>
	</a>
	<? } } wp_reset_query(); ?>
</div>
<div class="breadcrumbs">
	<div class="container">
		<?=dez_schema_breadcrumb()?>
		<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('.tabs > div > li').click(function(){
		$('.tabs > div > li').removeClass('active');
		$(this).addClass('active');
		$('#TabsContents > .tab').removeClass('active');
		$('#TabsContents > .tab[data-tab='+$(this).data('filter')+']').addClass('active');
	});
});
</script>
<ul class="tabs">
	<div class="w1200">
		<li data-filter="watch" class="active"><i class="fa fa-play"></i> سيرفرات لمشاهدة</li>
		<li data-filter="download"><i class="fa fa-download"></i> سيرفرات التحميل</li>
		<? if( !empty($imagenes) ) { ?>
		<li data-filter="photos"><i class="fa fa-picture-o"></i> صور عنهُ</li>
		<? } ?>
	</div>
</ul>
<? $servers = array(); ?>
<? for ($x = 0; $x <= 15; $x++) { ?> 
	<?php $servers[] = get_post_meta($post->ID, 'player_'.$x.'_embed_player', true); ?>
<? } ?>
<?php $servers = array_filter($servers); ?>
<script>
$(document).ready(function(){
	$('.serversList > li').click(function(){
		$(".serversList > li").removeClass('active');
        $(this).addClass('active');
        $.ajax({
            url: '<?php echo get_template_directory_uri()?>/servers/serverEpisode.php',
            data: 'q=<?php echo $post->ID?>&i='+$(this).data('server')+'',
            success: function(msg) {
                $(".embedServer").html(msg);
            }
        });
	});
});
</script>
<div class="w1200Single">
	<div id="TabsContents">
		<div class="tab active" data-tab="watch">
			<div class="serversEmbed">
				<ul class="serversList">
					<h2>سيرفرات المشاهدة</h2>
					<? $i = 1; foreach ( $servers as $server) { ?>
						<li <?=($i == 1) ? 'class="active"' : ''?> data-server="<?=$i?>">سيرفر <?=$i?></li>
					<? $i++; } ?>
				</ul>
				<div class="embedServer">
					<? foreach ( array_slice($servers, 0, 1) as $server) { ?>
						<?=$server?>
					<? } ?>
				</div>
			</div>
		</div>
		<div class="tab" data-tab="photos">
			<div class="photosFilm">
				<? $imagenes = array_filter($imagenes); ?>
				<? foreach ($imagenes as $img) { ?>
					<img onClick="photoFilm(this);" src="<?=$img?>" alt="<? the_title(); ?>" />
				<? } ?>
			</div>
		</div>
		<div class="tab" data-tab="download">
			<div class="downloadsList">
				<? $yourcolor_downloads = get_post_meta($post->ID, 'download', true); ?>
				<? if( !empty($yourcolor_downloads) ) { ?>
					<? foreach ($yourcolor_downloads as $download) { ?>
					    <li>
					    	<a target="_blank" href="<?=$download['link']?>">
					    		<i class="fa fa-download"></i>
					    		<span class="name"><?=$download['name']?></span>
					    		<span class="quality"><?=$download['quality']?></span>
					    		<span class="size"><?=$download['size']?></span>
					    	</a>
					    </li>
					<? } ?>
				<? }else { ?>
					<? for ($x = 0; $x <= get_post_meta($post->ID, 'ddw', true)-1; $x++) { ?>
						<? $url = get_post_meta($post->ID, 'ddw_'.$x.'_op1'); ?>
						<? $name = get_post_meta($post->ID, 'ddw_'.$x.'_op2'); ?>
						<? $quality = get_post_meta($post->ID, 'ddw_'.$x.'_op3'); ?>
						<? $size = get_post_meta($post->ID, 'ddw_'.$x.'_op4'); ?>
					    <li>
					    	<a href="<?=$url[0]?>">
					    		<i class="fa fa-download"></i>
					    		<span class="name"><?=$name[0]?></span>
					    		<span class="quality"><?=$quality[0]?></span>
					    		<span class="size"><?=$size[0]?></span>
					    	</a>
					    </li>
					<? } ?>
				<? } ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function photoFilm(img) {
	$('body').append('<div onClick="$(this).remove();" class="photoFilm"><div><img src="'+$(img).attr('src')+'" alt="<? the_title(); ?>" /></div></div>');
}
</script>
<script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>
<?php get_footer(); ?>