<?php

// Template Name: tst

get_header(); ?>

<div class="coverBody" style="background-image:url(<?=(wp_get_attachment_url(get_post_thumbnail_id($post->ID)) == '') ? get_post_meta($post->ID, 'poster_url', true) : wp_get_attachment_url(get_post_thumbnail_id($post->ID))?>);"></div>

<div class="slider">

	<a href="javascript:void(0);" class="slides-next"><i class="fa fa-angle-left"></i></a>

	<a href="javascript:void(0);" class="slides-prev"><i class="fa fa-angle-right"></i></a>

	<ul class="slides">

		<? query_posts(array('post_type'=>'post', 'posts_per_page'=>30, 'meta_key'=>'pin')); ?>

		<? if(have_posts()) { while(have_posts()) { the_post(); ?>

			<? require(get_template_directory().'/film.php'); ?>

		<? } } ?>

	</ul>

</div>

<? $postsNotin = array(); ?>



<? if( wp_is_mobile() ) { ?>



<div class="ad728"><?php echo get_option('728×90_after_genres_mobile')?></div>



<? }else { ?>



<div class="ad728"><?php echo get_option('728×90_after_genres')?></div>



<? } ?>

<? wp_reset_query(); ?>

<script type="text/javascript">



$(document).ready(function(){



	$('.title ul li').click(function(){

		$('html, body').animate({

			scrollTop: $(".moviesBlocks.DataFill").offset().top - 80

		 }, 500);

		$('.title ul li').removeClass('active');



		$(this).addClass('active');



		$('.moviesBlocks.DataFill').addClass('loadedAjax').html('<div class="loader loader--style8" title="7"> <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="30px" viewBox="0 0 24 30" style="enable-background:new 0 0 50 50;" xml:space="preserve"> <rect x="0" y="9.99974" width="10" height="16.0005" fill="#333" opacity="0.2"> <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0s" dur="0.6s" repeatCount="indefinite"></animate> <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0s" dur="0.6s" repeatCount="indefinite"></animate> <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0s" dur="0.6s" repeatCount="indefinite"></animate> </rect> <rect x="8" y="13.49974" width="10" height="21.0005" fill="#333" opacity="0.2"> <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate> <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate> <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate> </rect> <rect x="16" y="11.00026" width="10" height="25.9995" fill="#333" opacity="0.2"> <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate> <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate> <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate> </rect> </svg> </div>');

		type = $(this).data('filter');

		$.ajax({



			url: '<?=get_template_directory_uri()?>/filter/'+$(this).data('filter')+'.php',



			type:'GET',



			success: function(msg) {

				$('.moviesBlocks.DataFill').html(msg);

				$('.pagination a').each(function(els, el){

					if( $(el).text() == '&laquo;' ) {

						$(el).attr("href", '<?=home_url()?>?page=<?=$_GET['page']+1?>&type='+type+'');

					}else {

						$(el).attr("href", '<?=home_url()?>?page='+$(el).text()+'&type='+type+'');

					}

				});

			}



		});



	});

	$('.sideBarMoviess').height($(window).height());

});

$(window).scroll(function(){

	if( $(window).scrollTop() > $(".INDEXBloCKS").offset().top ) {

		$(".INDEXBloCKS .title").addClass('fixed');

		$('.sideBarMoviess').addClass('fixed');

	}

	if( $(window).scrollTop() < $(".INDEXBloCKS").offset().top ) {

		$(".INDEXBloCKS .title").removeClass('fixed');

		$('.sideBarMoviess').removeClass('fixed');

	}

});

$(window).resize(function(){

	$('.sideBarMoviess').height($(window).height());

});

</script>

<div class="sections">



	<div class="section">

		<h2 class="titleCategory"><? the_title(); ?></h2>

		<div class="container">



			<div class="moviesBlocks DataFill">



				<? $postsNotin = array(); ?>



				<? query_posts(array('post_type'=>'post', 'meta_key' => 'pin', 'posts_per_page'=>-1)); ?>



				<? $blo = 1; if(have_posts()) { while(have_posts()) { the_post(); ?>



					<? $postsNotin[] = $post->ID; ?>



				<? } } ?>



				<? query_posts(array('post_type'=>'post', 'meta_key' => 'pin_normal', 'posts_per_page'=>-1)); ?>



				<? $blo = 1; if(have_posts()) { while(have_posts()) { the_post(); ?>



					<? $postsNotin[] = $post->ID; ?>



				<? } } ?>



				<?php



				//Fix homepage pagination



				if ( array_key_exists('page', $_GET) ) { $paged = $_GET['page']; } else {$paged = 1; }



					$loop = 0;



					$temp = $wp_query;  // re-sets query



					$wp_query = null;   // re-sets query

					if( $_GET['type'] == 'commented' ) {

						$args = array('post_type'=>'post', 'meta_key'=>'comments', 'orderby'=>'meta_value_num', 'paged'=>$paged, 'posts_per_page'=>54);

					}else if( $_GET['type'] == 'featured' ) {

						$args = array('post_type'=>'post', 'meta_key'=>'views', 'paged'=>$paged, 'orderby'=>'meta_value_num', 'posts_per_page'=>54);

					}else if( $_GET['type'] == 'mostlike' ) {

						$args = array('post_type'=>'post', 'meta_key'=>'likes', 'paged'=>$paged, 'orderby'=>'meta_value_num', 'posts_per_page'=>54);

					}else if( $_GET['type'] == 'topratings' ) {

						$args = array('post_type'=>'post', 'meta_key'=>'ratings_average', 'paged'=>$paged, 'orderby'=>'meta_value_num', 'posts_per_page'=>54);

					}else if( $_GET['type'] == 'pin' ) {

						$args = array('post_type'=>'post', 'meta_key'=>'pin_normal_numeric', 'paged'=>$paged, 'orderby'=>'meta_value_num', 'meta_query' => array(array('key' => 'pin_normal', 'value' => 'on', 'compare' => '=='), ), 'posts_per_page'=>54);

					}else {

						$args = array( 'post_type'=>'post', 'post__not_in'=>array_values($postsNotin), 'posts_per_page'=>54, 'paged' => $paged);

					}



					$wp_query = new WP_Query();



					$wp_query->query( $args );



					while ($wp_query->have_posts()) : $wp_query->the_post(); 



				?>



					<? require(get_template_directory().'/film.php'); ?>



				<? endwhile; ?>



				<div class="pagination">



			       <?php paginate(); ?>



			       <?



			       $wp_query = null;



			       $wp_query = $temp; // Reset



			       ?>



			    </div>

			</div>

		</div>



	</div>

</div>



<?php get_footer(); ?>