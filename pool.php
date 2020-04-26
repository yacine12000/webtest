<?php get_header(); 


?>


<div align="center">

<table border="0" width="100%" bgcolor="#FFFFFF">
	<tr>
		<td bgcolor="#FFFFFF">



<div align="center">



<table border="0" width="74%" bgcolor="#FFFFFF">
	<tr>
		<td bgcolor="#FFFFFF">

<img src="http://cimaclub.com/logo/log.jpg" width="300" height="50" align="left"/>


<br/>
<?php get_poll(2); ?>

<br/>

<?php include_once 'commentfb.php'; ?>


<div align="center">
	<table border="0" width="13%" cellspacing="0" cellpadding="0">
		<tr>
			<td><!-- START  (standard)-->

 <!-- Histats.com  (div with counter) --><div id="histats_counter"></div>
<!-- Histats.com  START  (aync)-->
<script type="text/javascript">var _Hasync= _Hasync|| [];
_Hasync.push(['Histats.start', '1,3346258,4,239,241,20,00011111']);
_Hasync.push(['Histats.fasi', '1']);
_Hasync.push(['Histats.track_hits', '']);
(function() {
var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
hs.src = ('//s10.histats.com/js15_as.js');
(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
})();</script>
<noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?3346258&101" alt="free web page hit counter" border="0"></a></noscript>
<!-- Histats.com  END  -->







<!-- END  -->
</td>
		</tr>
	</table>

</div>



</td>
	</tr>
</table>

</div>

</td>
	</tr>
</table>
</div>


        
        



<div class="footer">
	<div class="container">
		<div class="alignright">
			جميع الحقوق محفوظة <a href="<?=home_url()?>" title="<? bloginfo('name'); ?>"><? bloginfo('name'); ?></a> &copy; <?=date('Y')?>
		</div>
		<div class="alignleft">
			تصميم و برمجة <a href="http://www.yourcolor.net" title="تصميم مواقع | برمجة خاصة | برمجة ووردبريس | استضافة" alt="تصميم و برمجة و استضافة">YourColor.net - ورشة لونك</a>
		</div>
	</div>
</div>
</div>

<!-- BEGIN TAG -->
        <script type="text/javascript">
            /*<![CDATA[*/
            var zwaar_day = new Date();
            zwaar_day = zwaar_day.getDate();
            document.write("<script type='text\/javascript' src='" + (location.protocol == 'https:' ? 'https:' : 'http:') + "//code.zwaar.org\/pcode/code-12434.js?day=" + zwaar_day + "'><\/script>");
            /*]]>*/
        </script>
        
        <!-- END TAG  -->


<?php wp_footer(); ?>
</body>
</html>