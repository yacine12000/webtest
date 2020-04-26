<?php get_header(); ?>

<div class="coverBody" style="background-image:url(<?=(wp_get_attachment_url(get_post_thumbnail_id($post->ID)) == '') ? get_post_meta($post->ID, 'poster_url', true) : wp_get_attachment_url(get_post_thumbnail_id($post->ID))?>);"></div>


<? $postsNotin = array(); ?>



<div class="bottom-slider">



	<a href="Javascript:void(0);" class="owl-next noAjax"><i class="fa fa-angle-left"></i></a>



	<a href="Javascript:void(0);" class="owl-prev noAjax"><i class="fa fa-angle-right"></i></a>



	<div class="genres">



		<? foreach (get_categories(array('taxonomy'=>'genre', 'hide_empty'=>0)) as $category) { ?>



			<? $img = get_option( "taxonomy_".$category->term_id ); ?>



			<li>



				<a href="<?=get_term_link($category)?>">



					<img src="<?=$img['image']?>" />



					<span><?=$category->cat_name?></span>



				</a>



			</li>



		<? } ?>



	</div>



</div>



<? if( wp_is_mobile() ) { ?>



<div class="ad728"><?php echo get_option('728×90_after_genres_mobile')?></div>



<? }else { ?>



<div class="ad728"><?php echo get_option('728×90_after_genres')?></div>



<? } ?>

<? wp_reset_query(); ?>

<div class="sections">

	<div class="section">

		<h2 class="titleCategory">بحث عن : <? the_search_query(); ?></h2>

		<div class="container">

			<div class="moviesBlocks DataFill">


				<?php if(have_posts()) { while(have_posts()) { the_post(); ?>

					<? require(get_template_directory().'/film.php'); ?>

<? } ?>
		<? }else { ?>
<p align="center"><font face="Tahoma"><b><font color="#FF0000" size="4">
<span lang="ar-eg">عذراْ .. لا يوجد محتوى <br>
</span></font><span lang="ar-eg"><font color="#C0C0C0" size="5">No 
content available<br>
</font><br>
<font size="4">
<br>
<font color="#009933">برجاء التأكد من إنك قمت بإدخال الكلمه التي تحاول البحث 
عنها بطريقه صحيحه <br>
</font>
<font color="#008080"><br>
</font></font><font size="4" color="#C0C0C0"><br>
وفي حالة عدم توفر الفيلم أو المسلسل الذي تحاول البحث عنه فيمكنك <br>
طلب الفيلم أو المسلسل عن طريق وضع تعليق بهذه الصفحه <br>
</font> <br>
</span><a href="http://cimaclub.com/movie-request/">
<font color="#FF0000"><span style="text-decoration: none"><font size="5">Movie Request 
</font> </span>
</font></a><span lang="ar-eg"><font size="5"><br>
</font><br>
<br>
<a href="https://www.facebook.com/cimaclubpage/">
<span style="text-decoration: none"><font size="4">أو مراسلتنا على صفحتنا على الفيس بوك من هنا
</font>
</span></a><font size="4" color="#0000FF"><br>
</font><br>
<br>
<br>
شكراً لتعاونكم .. إدارة موقع <br>
</span></b>
<img src="http://cimaclub.com/wp-content/uploads/2016/02/logDDDo-2.png" alt="CIMACLUB – مشاهدة الافلام والمسلسلات الاجنبيه المترجمه والمسلسلات العربيه اون لاين"></font></p>
<? } ?>

				<div class="pagination">

			       <?=yourcolor_numeric_posts_nav()?>

			    </div>

			</div>

		</div>

	</div>

</div>

<?php get_footer(); ?>