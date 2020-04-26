<? if( array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER) ) { ?>
<? $ajax = 1; ?>
<? }else { ?>
<? $ajax = 0; ?>
<? } ?>
<?php if(!$ajax) { ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" class="wp-toolbar"  dir="rtl" lang="ar">
<head>
<?=add_meta_tags()?>
<link rel="shortcut icon" href="http://cimaclub.com/favicon.ico" type="image/x-icon"> 
<? if( is_single() ) { ?>
<meta name="keywords" content="<? foreach ((is_array(get_the_terms($post->ID, 'post_tag', ''))) ? get_the_terms($post->ID, 'post_tag', '') : array() as $tag) { ?><?=$tag->name?>, <? } ?>" />
<meta property="og:type" content="article" />
<meta property="og:title" content="<? the_title(); ?>" />
<meta property="og:url" content="<? the_permalink(); ?>" />
<? wp_reset_query(); ?>
<meta property="og:description" content="<?=wp_trim_words(get_the_content(), 25, '')?>" />
<meta property="article:published_time" content="<?=date('d-m-Y', strtotime($post->post_date))?>T<?=date('H:i:s', strtotime($post->post_date))?>" />
<meta property="article:modified_time" content="<?=date('d-m-Y', strtotime($post->post_date))?>T<?=date('H:i:s', strtotime($post->post_date))?>" />
<meta property="og:site_name" content="Cimaclub" />
<meta property="og:locale" content="ar_AR" />
<? if( has_post_thumbnail() ) { ?>
<?
$image_attributes = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'col');
if ( $image_attributes ) : ?>
<meta property="og:image" content="<?php echo $image_attributes[0]; ?>" />
<meta property="og:image:width" content="<?php echo $image_attributes[1]; ?>" />
<meta property="og:image:height" content="<?php echo $image_attributes[2]; ?>" />
<meta name="twitter:image" content="<?php echo $image_attributes[0]; ?>" />
<meta name="twitter:card" content="summary_large_image" />
<?php endif; ?>
<? }else { ?>
<meta property="og:image" content="<?=get_post_meta($post->ID, 'poster_url', true)?>" />
<meta property="og:image:width" content="185" />
<meta property="og:image:height" content="278" />
<meta name="twitter:image" content="<?=get_post_meta($post->ID, 'poster_url', true)?>" />
<meta name="twitter:card" content="summary_large_image" />
<? } ?>
<? } ?>
<meta http-equiv="Content-Language" content="ar-eg"/>
<meta http-equiv="Cache-Control" content="no-cache"/>
<meta http-equiv="Pragma" content="no-cache"/>
<meta http-equiv="Expires" content="0" />
<meta name="Expires" content="0"/>
<meta name="rating" content="General"/>
<meta name="robots" content="index, follow"/>
<meta name="robots" content="NOODP,NOYDIR"/>
<meta name="revisit-after" content="1 hour"/>
<meta name="distribution" content="Global"/>
<meta name="classification" content="All"/>
<meta name="googlebot" content="archive"/>
<meta name="resource-type" content="document"/>
<meta charset="UTF-8">
<?php wp_head(); ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="text/javascript" src="<?=get_template_directory_uri()?>/js/jquery-1.8.2.min.js?v=1.1">
</script>
<script type="text/javascript" src="<?=get_template_directory_uri()?>/js/owl.carousel.min.js?v=1.1">
</script>
<? if( wp_is_mobile() ) { ?>
<script type="text/javascript" src="<?=get_template_directory_uri()?>/js/yourcolorMobile.js?v=1.1">
</script>
<? }else { ?>
<script type="text/javascript" src="<?=get_template_directory_uri()?>/js/yourcolor.js?v=1.1">
</script>
<? } ?>
<script src="<?=get_template_directory_uri()?>/js/segment.min.js?v=1.1">
</script>
<script src="<?=get_template_directory_uri()?>/js/d3-ease.v0.6.js?v=1.1">
</script>
<script src="<?=get_template_directory_uri()?>/js/letters.js?v=1.1">
</script>
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="<?=get_template_directory_uri()?>/css/font-awesome.min.css" />
<? if( wp_is_mobile() ) { ?>
<link rel="stylesheet" type="text/css" href="<?=get_template_directory_uri()?>/styleMobile.css" />
<? }else { ?>
<link rel="stylesheet" type="text/css" href="<?=get_template_directory_uri()?>/style.css" />
<? } ?>
<style>
.ui-widget-content > li.ui-state-focus {
  background: rgb(65, 167, 214);
  color: #262b36;
}
.ui-widget-content > li {
  color: white;
  font-size: 16px;
  padding: 9px 12px 7px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.16);
  font-weight: bold;
}
.ui-widget-content {
  display: block !important;
  top: 40px !important;
  left: <?=(wp_is_mobile()) ? '92px' : '122px';
  ?> !important;
  background: rgba(60, 67, 84, 0.95);
  position: fixed !important;
  z-index: 9999;
  width: 210px !important;
  list-style: none;
  box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.68);
  border-radius: 4px;
}
</style>
</head>
<body dir="rtl" class="demo-1">


  <?php echo get_ads('Pop_up')?>
  <form action="<?=home_url()?>" method="GET" id="searchForm">
  	<div onClick="$('#searchForm').removeClass('active');" style="height:100%;"></div>
    <input type="text" name="s" id="s" placeholder="ابحث بالاسم او بالكود او بالممثل" />
    <button type="submit">بحث
    </button>
  </form>
  <div class="allSiteCo">
    <div class="topBarHeader">
      <div class="container">
        <div class="search">
          <i class="fa fa-search" onClick="$('#searchForm').addClass('active');"></i>
        </div>


<div class="right-social">
<ul class="social_media">
<li><a href="https://www.facebook.com" class="facebook" target="_blank" rel="nofollow">Facebook</a></li>
<li><a href="https://plus.google.com/" class="googleplus" target="_blank" rel="nofollow">Googleplus</a></li>
<li><a href="https://twitter.com/" class="twitter" target="_blank" rel="nofollow">Twitter</a></li>
                </ul>
            </div>



<span id="tmz">
<img src="" alt=""/>
  </span>


      </div>
    </div>
  </div>


  <header>
    <div class="container">
      <a class="link link--ilin" href="<?=home_url()?>">
        <span>Club
        </span>
        <span>Cima
        </span>
      </a>
      <div class="MainMenu">
        <?php 
wp_nav_menu ( array(  
'theme_location'  => 'main-menu',  
'menu_class'      => 'nav navbar-nav menu-master',  
'echo'            => true,  
'fallback_cb'     => 'wp_page_menu',  
'before'          => '',  
'after'           => '',  
'container'           => '',  
'link_before'     => '',  
'link_after'      => '',  
'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',  
'depth'           => 0,  
'walker'          => '' 
) );  
?>
      </div>
    </div>
  </header>
  <div class="main-content">
    <? }else { ?>
    <script>
      /////////////////////////////////
      // carouFredSel
      /////////////////////////////////
      $(function() {
        $(".slides").owlCarousel({
          items: 6,
          stopOnHover: true,
          autoPlay: 10000,
          addClassActive: true,
          navigationText : ["prev","next"],
        }
                                );
        var owl2 = $(".slides").data('owlCarousel');
        $('.slides-next').click(function(){
          owl2.prev();
        }
                               );
        $('.slides-prev').click(function(){
          owl2.next();
        }
                               );
        $(".genres").owlCarousel({
          items: 8,
          stopOnHover: true,
          autoPlay: 10000,
          navigationText : ["prev","next"],
        }
                                );
        var owl = $(".genres").data('owlCarousel');
        $('.owl-next').click(function(){
          owl.prev();
        }
                            );
        $('.owl-prev').click(function(){
          owl.next();
        }
                            );
      }
       );
    </script>
    <? } ?>