<br>
<div id="fb-root"></div>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?php if($lang = get_option('fb_idioma')) { echo $lang; } else { echo 'ar_AR'; } ?>/sdk.js#xfbml=1&appId=<?php if($appid = get_option('fb_id')) { echo $appid; } else { echo "209955335852854"; } ?>&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<div class="fb-comments" data-href="<?php the_permalink() ?>" data-width="100%" data-numposts="5" data-order-by="reverse_time"></div>
</div>