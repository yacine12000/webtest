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
<div class="CoverIntroMovie tvShowCoVER">
	<div class="backdrop-wrap"><div class="backdrop" style="background-image:url(<?=(wp_get_attachment_url(get_post_thumbnail_id($post->ID)) == '') ? get_post_meta($post->ID, 'poster_url', true) : wp_get_attachment_url(get_post_thumbnail_id($post->ID))?>);"></div></div>
	<div class="container">
		<? if( has_post_thumbnail() ) { ?>
			<? the_post_thumbnail(); ?>
		<? }else { ?>
			<img src="<?=get_post_meta($post->ID, 'poster_url', true)?>" alt="<? the_title(); ?>" />
		<? } ?>
		<div class="titleCover">
			<h2><? the_title(); ?></h2>
			<span class="quality">
				<?=get_post_meta($post->ID, 'episode_run_time', true)?> دقيقة
			</span>
			<em></em>
			<span class="category">
				<? foreach (array_slice((is_array(get_the_terms($post->ID, 'tvshows_categories', ''))) ? get_the_terms($post->ID, 'tvshows_categories', '') : array(), 0, 1) as $person) { ?><a href="<?=get_term_link($person)?>"><?=$person->name?></a><? } ?>
			</span>
			<em></em>
			<span class="genre">
				<?=get_post_meta($post->ID, 'status', true)?>
			</span>
		</div>
		<div class="contentFilm">
			<? the_content(); ?>
		</div>
		<? if( !$_GET['season'] ) { ?>
			<? if( get_post_meta($post->ID, 'serie_vote_average', true) != '' ) { ?>
			<div class="score">
	            <div class="rank"><?php $values = get_post_meta($post->ID, 'serie_vote_average', true); echo $values; ?></div>
	            <div class="stars">
	                <span class="abc-c">
	                    <span class="abc-r" style="width: <?php $values = get_post_meta($post->ID, 'serie_vote_average', true); echo $values[0]*10; ?>%;"></span>
	                </span>
	                <div class="views"><?php $values = get_post_meta($post->ID, 'serie_vote_average', true); echo $values; ?> / 10 &nbsp;<i>|</i>&nbsp; <?php $values = get_post_meta($post->ID, 'serie_vote_count', true); echo $values; ?> <?php _e('votes', 'mundothemes'); ?> </div>
	            </div>
	        </div>
			<? } ?>
		<? } ?>
	</div>
	<a href="javascript:void(0);" class="viewMovie label2 noAjax">
		<i><?=get_post_meta($post->ID, 'number_of_seasons', true)?></i>
		<span>عدد المواسم</span>
	</a>
	<a href="javascript:void(0);" class="viewMovie noAjax">
		<i><?=get_post_meta($post->ID, 'number_of_episodes', true)?></i>
		<span>عدد الحلقات</span>
	</a>
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
<div class="SectionFullyCover">
	<ul class="tabs">
		<div class="w1200">
			<li class="active" data-filter="about"><i class="fa fa-film"></i> معلومات</li>
			<? if( !empty($imagenes) ) { ?>
			<li data-filter="photos"><i class="fa fa-picture-o"></i> صور عنهُ</li>
			<? } ?>
			<li data-filter="episodes"><i class="fa fa-bars"></i> حلقات المسلسل</li>
		</div>
	</ul>
	<div class="w1200Single TVSHOWSLIST">
		<div id="TabsContents">
			<div class="tab active" data-tab="about">
				<ul class="listActorsss">
					<? if( get_post_meta($post->ID, 'first_air_date', true) != '' ) { ?>
					<li>
						<span>تاريخ بداية المسلسل : </span>
						<?=get_post_meta($post->ID, 'first_air_date', true)?>
					</li>
					<? } ?>
					<? if( get_post_meta($post->ID, 'last_air_date', true) != '' ) { ?>
					<li>
						<span>تاريخ اخر حلقة : </span>
						<?=get_post_meta($post->ID, 'last_air_date', true)?>
					</li>
					<? } ?>
					<? if( get_post_meta($post->ID, 'popularity', true) != '' ) { ?>
					<li>
						<span>نسبة الشعبية : </span>
						<?=get_post_meta($post->ID, 'popularity', true)?>
					</li>
					<? } ?>
					<? $arr = (is_array(get_the_terms($post->ID, 'tvstudio', ''))) ? get_the_terms($post->ID, 'tvstudio', '') : array(); ?>
					<? if(!empty($arr)) { ?>
					<li>
						<span>شركة الانتاج : </span>
						<? foreach ((is_array(get_the_terms($post->ID, 'tvstudio', ''))) ? get_the_terms($post->ID, 'tvstudio', '') : array() as $person) { ?><a href="<?=get_term_link($person)?>"><?=$person->name?></a><? } ?>
					</li>
					<? } ?>
					<? $arr = (is_array(get_the_terms($post->ID, 'tvnetworks', ''))) ? get_the_terms($post->ID, 'tvnetworks', '') : array(); ?>
					<? if(!empty($arr)) { ?>
					<li>
						<span>قناة العرض : </span>
						<? foreach ((is_array(get_the_terms($post->ID, 'tvnetworks', ''))) ? get_the_terms($post->ID, 'tvnetworks', '') : array() as $person) { ?><a href="<?=get_term_link($person)?>"><?=$person->name?></a><? } ?>
					</li>
					<? } ?>
					<? $arr = (is_array(get_the_terms($post->ID, 'tvcast', ''))) ? get_the_terms($post->ID, 'tvcast', '') : array(); ?>
					<? if(!empty($arr)) { ?>
					<li>
						<span>الممثلين : </span>
						<? foreach ((is_array(get_the_terms($post->ID, 'tvcast', ''))) ? get_the_terms($post->ID, 'tvcast', '') : array() as $person) { ?><a href="<?=get_term_link($person)?>"><?=$person->name?></a><? } ?>
					</li>
					<? } ?>
					<? $arr = (is_array(get_the_terms($post->ID, 'tvyear', ''))) ? get_the_terms($post->ID, 'tvyear', '') : array(); ?>
					<? if(!empty($arr)) { ?>
					<li>
						<span>سنة الاصدار : </span>
						<? foreach ((is_array(get_the_terms($post->ID, 'tvyear', ''))) ? get_the_terms($post->ID, 'tvyear', '') : array() as $person) { ?><a href="<?=get_term_link($person)?>"><?=$person->name?></a><? } ?>
					</li>
					<? } ?>
				</ul>
			</div>
			<div class="tab" data-tab="photos">
				<div class="photosFilm">
					<? $imagenes = array_filter($imagenes); ?>
					<? foreach ($imagenes as $img) { ?>
						<img onClick="photoFilm(this);" src="<?=$img?>" alt="<? the_title(); ?>" />
					<? } ?>
				</div>
			</div>
			<script>
			$(document).ready(function(){
				$('.episodes > .seasons > .season:nth-child(2)').addClass('active');
				$('.episodes > .episodes > .episode[data-season='+$('.episodes > .seasons > .season:nth-child(2)').data('filter')+']').show();
				$('.episodes > .seasons > .season').click(function(){
					$('.episodes > .seasons > .season').removeClass('active');
					$('.episodes > .episodes > .episode').hide();
					$('.episodes > .episodes > .episode[data-season='+$(this).data('filter')+']').show();
					$(this).addClass('active');
				});
			});
			</script>
			<div class="tab" data-tab="episodes">
				<div class="episodes">
					<div class="seasons">
						<h2>المواسم</h2>
						<? $i2 = 1; $i3 = 0; for ($x2 = 0; $x2 <= get_post_meta($post->ID, 'number_of_seasons', true)-1; $x2++) { ?>
							<div class="season" data-filter="<?=$i2?>">
								الموسم <?=$i2?>
							</div>
						<? $i2++;} ?>
					</div>
					<div class="episodes">
						<? $i2 = 1; $i3 = 0; for ($x2 = 0; $x2 <= get_post_meta($post->ID, 'number_of_seasons', true)-1; $x2++) { ?>
							<? $i = 1; for ($x = 0; $x <= get_post_meta($post->ID, 'number_of_episodes', true)-1; $x++) { ?>
								<? $psslug = explode('-'.$i2.'x', get_post_meta($post->ID, 'temporadas_'.$i3.'_episodios_'.$x.'_slug', true)); ?>
								<? if( $psslug[1] ) { ?>
									<?php
									$the_slug = get_post_meta($post->ID, 'temporadas_'.$i3.'_episodios_'.$x.'_slug', true);
									$args = array(
									  'name'        => $the_slug,
									  'post_type'   => 'episodes',
									  'numberposts' => 1
									);
									$my_posts = get_posts($args);
									foreach ($my_posts as $episode) { ?>
									<div data-season="<?=$i2?>" class="episode">
										<a href="<?=get_permalink($episode->ID); ?>">
											<?=$psslug[1]?>
											<span>الحلقة</span>
										</a>
									</div>
									<? } ?>
								<? } ?>
							<? } ?>
						<? $i2++; $i3++; } ?>
					</div>
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
	<?php $catsEmpty = get_the_terms( $post->ID, 'tvnetworks', '' ); ?>

	<?php $yearsEmpty = get_the_terms( $post->ID, 'tvshows_categories', '' ); ?>

	<?php $genresEmpty = get_the_terms( $post->ID, 'tvyear', '' ); ?>
	<div class="columnsBackground">
		<div class="columns HalFColumns <?=(!empty($catsEmpty)) ? 'catsS' : ''?> <?=(!empty($yearsEmpty)) ? 'yearsS' : ''?> <?=(!empty($genresEmpty)) ? 'genresS' : ''?>">


			<?php $tags = get_the_terms( $post->ID, 'tvnetworks', '' ); ?>

			<?php foreach( (is_array($tags)) ? $tags : array() as $tag ) { ?>

		        <? $ctslg = $tag->term_id; ?>

		        <? $ctnme = $tag->name; ?>

		        <? $catSLG = $tag->term_id; ?>

		        <? $ctlnk = get_term_link($tag); ?>

		    <?php } ?>

		    <? if( !empty($ctnme) ) { ?>

			<div class="column">

				<div class="title">

					<h2><a href="<?=$ctlnk?>">يعرض على قناة <?=$ctnme?></a></h2>

				</div>

				<div class="moviesBlocks">

					<? query_posts(array('post_type'=>'tvshows', 'orderby'=>'rand', 'posts_per_page'=>6)); ?>

					<? if(have_posts()) { while(have_posts()) { the_post(); ?>

						<? require(get_template_directory().'/film.php'); ?>

					<? } } wp_reset_query(); ?>

				</div>

			</div>

			<? } ?>

			<? unset($ctnme); ?>

			<?php $tags = get_the_terms( $post->ID, 'tvshows_categories', '' ); ?>

			<?php foreach( (is_array($tags)) ? $tags : array() as $tag ) { ?>

		        <? $ctslg = $tag->slug; ?>

		        <? $ctnme = $tag->name; ?>

		        <? $ctlnk = get_term_link($tag); ?>

		    <?php } ?>

		    <? if( !empty($ctnme) ) { ?>

			<div class="column">

				<div class="title">

					<h2><a href="<?=$ctlnk?>">مسلسلات <?=$ctnme?></a></h2>

				</div>

				<div class="moviesBlocks">

					<? query_posts(array('post_type'=>'tvshows', 'orderby'=>'rand', 'tvshows_categories'=>$ctslg, 'posts_per_page'=>6)); ?>

					<? if(have_posts()) { while(have_posts()) { the_post(); ?>

						<? require(get_template_directory().'/film.php'); ?>

					<? } } wp_reset_query(); ?>

				</div>

			</div>

			<? } ?>

			<? unset($ctnme); ?>

		</div>
	</div>
	<div class="cover" style="background-image:url(<?=(wp_get_attachment_url(get_post_thumbnail_id($post->ID)) == '') ? get_post_meta($post->ID, 'poster_url', true) : wp_get_attachment_url(get_post_thumbnail_id($post->ID))?>);"></div>
</div>
<?php get_footer(); ?>