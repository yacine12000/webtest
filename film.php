<div class="movie">
	<a href="<? the_permalink(); ?>">
		<div class="topbarMovie">
			<span class="views"><i class="fa fa-eye"></i> <?=(get_post_meta($post->ID, 'views', true) == '') ? '0' : get_post_meta($post->ID, 'views', true)?></span>
			<span class="category"><i class="fa fa-film"></i> <? foreach (array_slice((is_array(get_the_terms($post->ID, 'category', ''))) ? get_the_terms($post->ID, 'category', '') : array(), 0, 1) as $person) { ?><?=$person->name?><? } ?></span>
		</div>
		<? if( get_post_type() == 'episodes' ) { ?>
			<? if( has_post_thumbnail() ) { ?>
				<?
				$image_attributes = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'col');
				if ( $image_attributes ) : ?>
				    <img alt="<? the_title(); ?>" src="<?php echo $image_attributes[0]; ?>" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" />
				<?php endif; ?>
			<? }else { ?>
				<img src="<?=get_post_meta($post->ID, 'poster_serie', true)?>" alt="<? the_title(); ?>" />
			<? } ?>
		<? }else { ?>
			<? if( has_post_thumbnail() ) { ?>
				<?
				$image_attributes = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'col');
				if ( $image_attributes ) : ?>
				    <img alt="<? the_title(); ?>" src="<?php echo $image_attributes[0]; ?>" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" />
				<?php endif; ?>
			<? }else { ?>
				<img src="<?=get_post_meta($post->ID, 'poster_url', true)?>" alt="<? the_title(); ?>" />
			<? } ?>
		<? } ?>
		<? if( get_post_meta($post->ID, 'pin', true) == 'on' ) { ?>
        <span class="ribbon">مثبت</span>
		<? }else if( get_post_meta($post->ID, 'ribbon', true) != '' ) { ?>
        <span class="ribbon"><?=get_post_meta($post->ID, 'ribbon', true)?></span>
		<? } ?>
		<div class="boxcontentFilm">
			<h2><? the_title(); ?></h2>
			<p><?=wp_trim_words(get_the_content(), 20, '...')?></p>
			<div class="posterContent"></div>
		</div>
		<i class="fa fa-star StarLabels"><span><?=get_post_meta($post->ID, 'imdbRating', true)?></span></i>
	</a>
</div>

<? $type = ''; ?>