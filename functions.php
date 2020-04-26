
<?php
/**
*
* @ IonCube v8.3.3 Loader By DoraemonPT
* @ PHP 5.3
* @ Decoder version : 1.0.0.7
* @ Author     : DoraemonPT
* @ Release on : 09.05.2014
* @ Website    : http://EasyToYou.eu
*
**/

	class Post {
		function addComment($name, $id, $comment, $email) {
			$NOWords = explode( ',', get_option( 'noWords' ) );
			foreach ($NOWords as $wrd) {
				$comment = str_replace( $wrd, '', $comment );
			}

			$comments = (is_array( get_post_meta( $id, 'comments', true ) ) ? get_post_meta( $id, 'comments', true ) : array(  ));
			$comments[] = array( 'name' => $name, 'email' => $email, 'comment' => $comment );
			update_post_meta( $id, 'comments', $comments );
		}

		function list_comments($id) {
			return get_post_meta( $id, 'comments', true );
		}

		function comments_count($id) {
			return count( get_post_meta( $id, 'comments', true ) );
		}

		function views($id) {
			$views = (get_post_meta( $id, 'views', true ) == '' ? '0' : get_post_meta( $id, 'views', true ));
			return $views;
		}

		function likes($id) {
			$likes = (get_post_meta( $id, 'likes', true ) == '' ? '0' : get_post_meta( $id, 'likes', true ));
			return $likes;
		}

		function unlikes($id) {
			$unlike = (get_post_meta( $id, 'unlike', true ) == '' ? '0' : get_post_meta( $id, 'unlike', true ));
			return $unlike;
		}

		function watched($id) {
			$watched = (get_post_meta( $id, 'watched', true ) == '' ? '0' : get_post_meta( $id, 'watched', true ));
			return $watched;
		}

		function set_like($id) {
			if ($_COOKIE['liked_' . $id . ''] != 'yes') {
				update_post_meta( $id, 'likes', get_post_meta( $id, 'likes', true ) + 1 );
				setcookie( 'liked_' . $id . '', 'yes', time(  ) + 86400 * 30, '/' );

				if ($_COOKIE['nolikes_' . $id . ''] == 'yes') {
					update_post_meta( $id, 'unlike', get_post_meta( $id, 'unlike', true ) - 1 );
					setcookie( 'nolikes_' . $id . '', '', time(  ) + 86400 * 30, '/' );
					return null;
				}
			} 
else {
				if (get_post_meta( $id, 'likes', true ) == '0') {
					update_post_meta( $id, 'likes', '0' );
					setcookie( 'liked_' . $id . '', '', time(  ) + 86400 * 30, '/' );
					return null;
				}


				if ($_COOKIE['liked_' . $id . ''] == 'yes') {
					update_post_meta( $id, 'likes', get_post_meta( $id, 'likes', true ) - 1 );
					setcookie( 'liked_' . $id . '', '', time(  ) + 86400 * 30, '/' );
				}
			}

		}

		function set_watched($id) {
			if ($_COOKIE['watched_' . $id . ''] != 'yes') {
				update_post_meta( $id, 'watched', get_post_meta( $id, 'watched', true ) + 1 );
				setcookie( 'watched_' . $id . '', 'yes', time(  ) + 86400 * 30, '/' );
				return null;
			}


			if (get_post_meta( $id, 'watched', true ) == '0') {
				update_post_meta( $id, 'watched', '0' );
				setcookie( 'watched_' . $id . '', '', time(  ) + 86400 * 30, '/' );
				return null;
			}


			if ($_COOKIE['watched_' . $id . ''] == 'yes') {
				update_post_meta( $id, 'watched', get_post_meta( $id, 'watched', true ) - 1 );
				setcookie( 'watched_' . $id . '', '', time(  ) + 86400 * 30, '/' );
			}

		}

		function set_unlike($id) {
			if ($_COOKIE['nolikes_' . $id . ''] != 'yes') {
				update_post_meta( $id, 'unlike', get_post_meta( $id, 'unlike', true ) + 1 );
				setcookie( 'nolikes_' . $id . '', 'yes', time(  ) + 86400 * 30, '/' );

				if ($_COOKIE['liked_' . $id . ''] == 'yes') {
					update_post_meta( $id, 'likes', get_post_meta( $id, 'likes', true ) - 1 );
					setcookie( 'liked_' . $id . '', '', time(  ) + 86400 * 30, '/' );
					return null;
				}
			} 
else {
				if (get_post_meta( $id, 'unlike', true ) == '0') {
					update_post_meta( $id, 'unlike', '0' );
					setcookie( 'nolikes_' . $id . '', '', time(  ) + 86400 * 30, '/' );
					return null;
				}


				if ($_COOKIE['nolikes_' . $id . ''] == 'yes') {
					update_post_meta( $id, 'unlike', get_post_meta( $id, 'unlike', true ) - 1 );
					setcookie( 'nolikes_' . $id . '', '', time(  ) + 86400 * 30, '/' );
				}
			}

		}

		function set_views($id) {
			update_post_meta( $id, 'views', get_post_meta( $id, 'views', true ) + 1 );
		}

		function check_liked($id) {
			if ($_COOKIE['liked_' . $id . ''] == 'yes') {
				return 'active';
			}

		}

		function check_unliked($id) {
			if ($_COOKIE['nolikes_' . $id . ''] == 'yes') {
				return 'active';
			}

		}

		function check_watched($id) {
			if ($_COOKIE['watched_' . $id . ''] == 'yes') {
				return 'active';
			}

		}
	}

	function delete_directory($dirname) {
		if (is_dir( $dirname )) {
			$dir_handle = opendir( $dirname );
		}


		if (!$dir_handle) {
			return false;
		}


		if ($file = readdir( $dir_handle )) {
			if (( $file != '.' && $file != '..' )) {
				if (!is_dir( $dirname . '/' . $file )) {
					unlink( $dirname . '/' . $file );
				}

				delete_directory( $dirname . '/' . $file );
			}
		}

		closedir( $dir_handle );
		rmdir( $dirname );
		return true;
	}

	function delete_files($target) {
		if (is_dir( $target )) {
			$files = glob( $target . '*', GLOB_MARK );
			foreach ($files as $file) {
				delete_files( $file );
			}

			rmdir( $target );
			return null;
		}


		if (is_file( $target )) {
			unlink( $target );
		}

	}

	function add_scripts() {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-autocomplete' );
		wp_register_script( 'my-autocomplete', get_template_directory_uri(  ) . '/js/my-autocomplete.js', array( 'jquery', 'jquery-ui-autocomplete' ), '1.0', false );
		wp_localize_script( 'my-autocomplete', 'MyAutocomplete', array( 'url' => admin_url( 'admin-ajax.php' ) ) );
		wp_enqueue_script( 'my-autocomplete' );
	}

	function my_search() {
		$term = strtolower( $_GET['term'] );
		$suggestions = array(  );
		$loop = new WP_Query( 'post_type=post&posts_per_page=10&s=' . $term );

		while ($loop->have_posts(  )) {
			$loop->the_post(  );
			$suggestion = array(  );
			$suggestion['label'] = get_the_title(  );
			$suggestion['link'] = get_permalink(  );
			$suggestions[] = $suggestion;
		}

		wp_reset_query(  );
		$response = json_encode( $suggestions );
		echo $response;
		exit(  );
	}

	function create_series_category() {
		$labels_series_tags = array( 'name' => __( 'سنة الاصدار', 'YourColor', 'post type general name' ), 'all_items' => __( 'كل العناصر', 'YourColor', 'all items' ), 'add_new_item' => __( 'اضافة جديد', 'YourColor', 'adding a new item' ), 'new_item_name' => __( 'اضافة اسم جديد', 'YourColor', 'adding a new item' ) );
		register_taxonomy( 'release-year', 'post', array( 'hierarchical' => false, 'rewrite' => true, 'labels' => $labels_series_tags ) );
		$labels_series_tags = array( 'name' => __( 'الجودة', 'YourColor', 'post type general name' ), 'all_items' => __( 'كل العناصر', 'YourColor', 'all items' ), 'add_new_item' => __( 'اضافة جديد', 'YourColor', 'adding a new item' ), 'new_item_name' => __( 'اضافة اسم جديد', 'YourColor', 'adding a new item' ) );
		register_taxonomy( 'Quality', array( 'post', 'talkshows' ), array( 'hierarchical' => false, 'rewrite' => true, 'labels' => $labels_series_tags ) );
		$labels_series_tags = array( 'name' => __( 'انواع المسلسلات', 'YourColor', 'post type general name' ), 'all_items' => __( 'كل العناصر', 'YourColor', 'all items' ), 'add_new_item' => __( 'اضافة جديد', 'YourColor', 'adding a new item' ), 'new_item_name' => __( 'اضافة اسم جديد', 'YourColor', 'adding a new item' ) );
		register_taxonomy( 'tvshows_categories', 'tvshows', array( 'hierarchical' => false, 'rewrite' => true, 'labels' => $labels_series_tags ) );
		$labels_series_tags = array( 'name' => __( 'النوع', 'YourColor', 'post type general name' ), 'all_items' => __( 'كل العناصر', 'YourColor', 'all items' ), 'add_new_item' => __( 'اضافة جديد', 'YourColor', 'adding a new item' ), 'new_item_name' => __( 'اضافة اسم جديد', 'YourColor', 'adding a new item' ) );
		register_taxonomy( 'genre', 'post', array( 'hierarchical' => false, 'rewrite' => true, 'labels' => $labels_series_tags ) );
		$labels_series_tags = array( 'name' => __( 'المسلسلات', 'YourColor', 'post type general name' ), 'all_items' => __( 'كل العناصر', 'YourColor', 'all items' ), 'add_new_item' => __( 'اضافة جديد', 'YourColor', 'adding a new item' ), 'new_item_name' => __( 'اضافة اسم جديد', 'YourColor', 'adding a new item' ) );
		register_taxonomy( 'series', 'post', array( 'hierarchical' => false, 'rewrite' => true, 'labels' => $labels_series_tags ) );
		$labels_series_tags = array( 'name' => __( 'المواسم', 'YourColor', 'post type general name' ), 'all_items' => __( 'كل العناصر', 'YourColor', 'all items' ), 'add_new_item' => __( 'اضافة جديد', 'YourColor', 'adding a new item' ), 'new_item_name' => __( 'اضافة اسم جديد', 'YourColor', 'adding a new item' ) );
		register_taxonomy( 'seasons', 'post', array( 'hierarchical' => false, 'rewrite' => true, 'labels' => $labels_series_tags ) );
		$labels_series_tags = array( 'name' => __( 'السلاسل', 'YourColor', 'post type general name' ), 'all_items' => __( 'كل العناصر', 'YourColor', 'all items' ), 'add_new_item' => __( 'اضافة جديد', 'YourColor', 'adding a new item' ), 'new_item_name' => __( 'اضافة اسم جديد', 'YourColor', 'adding a new item' ) );
		$labels_ads_tags = array( 'name' => __( 'المخرجين', 'YourColor', 'post type general name' ), 'all_items' => __( 'كل المخرجين', 'YourColor', 'all items' ), 'add_new_item' => __( 'اضافة مخرج جديد', 'YourColor', 'adding a new item' ), 'new_item_name' => __( 'اسم مخرج جديد', 'YourColor', 'adding a new item' ) );
		register_taxonomy( 'director', 'post', array( 'hierarchical' => false, 'rewrite' => true, 'labels' => $labels_ads_tags ) );
		$labels_ads_tags = array( 'name' => __( 'الكاتبين', 'YourColor', 'post type general name' ), 'all_items' => __( 'كل الكاتبين', 'YourColor', 'all items' ), 'add_new_item' => __( 'اضافة كاتب جديد', 'YourColor', 'adding a new item' ), 'new_item_name' => __( 'اسم كاتب جديد', 'YourColor', 'adding a new item' ) );
		register_taxonomy( 'country', 'post', array( 'hierarchical' => false, 'rewrite' => true, 'labels' => $labels_ads_tags ) );
		$labels_ads_tags = array( 'name' => __( 'الممثلين', 'YourColor', 'post type general name' ), 'all_items' => __( 'كل الممثلين', 'YourColor', 'all items' ), 'add_new_item' => __( 'اضافة ممثل جديد', 'YourColor', 'adding a new item' ), 'new_item_name' => __( 'اسم ممثل جديد', 'YourColor', 'adding a new item' ) );
		register_taxonomy( 'star', 'post', array( 'hierarchical' => false, 'rewrite' => true, 'labels' => $labels_ads_tags ) );
		register_taxonomy( 'movseries', 'post', array( 'hierarchical' => false, 'rewrite' => true, 'labels' => $labels_series_tags ) );
		register_post_type( 'tvshows', array( 'labels' => array( 'name' => __( 'المسلسلات', 'YourColor' ), 'singular_name' => __( 'المسلسلات', 'YourColor' ), 'add_new' => __( 'اضافة عنصر', 'YourColor' ), 'add_new_item' => __( 'اضافة عنصر جديد', 'YourColor' ), 'edit' => __( 'تعديل', 'YourColor' ), 'edit_item' => __( 'تعديل', 'YourColor' ), 'new_item' => __( 'عنصر جديد', 'YourColor' ), 'view' => __( 'مشاهدة العنصر', 'YourColor' ), 'view_item' => __( 'مشاهدة العنصر', 'YourColor' ), 'search_items' => __( 'بحث فى العناصر', 'YourColor' ), 'not_found' => __( 'لا يوجد عناصر مضافة', 'YourColor' ), 'not_found_in_trash' => __( 'لا يوجد عناصر مضافة', 'YourColor' ), 'parent' => __( 'المسلسلات', 'YourColor' ) ), 'public' => true, 'show_ui' => true, 'publicly_queryable' => true, 'show_in_nav_menus' => false, 'exclude_from_search' => false, 'hierarchical' => false, 'rewrite' => array( 'slug' => '', 'with_front' => false ), 'supports' => array( 'title', 'thumbnail', 'editor', 'tag', 'comments' ) ) );
		$labels_series_tags = array( 'name' => __( 'الممثلين', 'YourColor', 'post type general name' ), 'all_items' => __( 'كل العناصر', 'YourColor', 'all items' ), 'add_new_item' => __( 'اضافة جديد', 'YourColor', 'adding a new item' ), 'new_item_name' => __( 'اضافة اسم جديد', 'YourColor', 'adding a new item' ) );
		register_taxonomy( 'tvcast', 'tvshows', array( 'hierarchical' => false, 'rewrite' => true, 'labels' => $labels_series_tags ) );
		$labels_series_tags = array( 'name' => __( 'شركة الانتاج', 'YourColor', 'post type general name' ), 'all_items' => __( 'كل العناصر', 'YourColor', 'all items' ), 'add_new_item' => __( 'اضافة جديد', 'YourColor', 'adding a new item' ), 'new_item_name' => __( 'اضافة اسم جديد', 'YourColor', 'adding a new item' ) );
		register_taxonomy( 'tvstudio', 'tvshows', array( 'hierarchical' => false, 'rewrite' => true, 'labels' => $labels_series_tags ) );
		$labels_series_tags = array( 'name' => __( 'قناة العرض', 'YourColor', 'post type general name' ), 'all_items' => __( 'كل العناصر', 'YourColor', 'all items' ), 'add_new_item' => __( 'اضافة جديد', 'YourColor', 'adding a new item' ), 'new_item_name' => __( 'اضافة اسم جديد', 'YourColor', 'adding a new item' ) );
		register_taxonomy( 'tvnetworks', 'tvshows', array( 'hierarchical' => false, 'rewrite' => true, 'labels' => $labels_series_tags ) );
		$labels_series_tags = array( 'name' => __( 'سنة الاصدار', 'YourColor', 'post type general name' ), 'all_items' => __( 'كل العناصر', 'YourColor', 'all items' ), 'add_new_item' => __( 'اضافة جديد', 'YourColor', 'adding a new item' ), 'new_item_name' => __( 'اضافة اسم جديد', 'YourColor', 'adding a new item' ) );
		register_taxonomy( 'tvyear', 'tvshows', array( 'hierarchical' => false, 'rewrite' => true, 'labels' => $labels_series_tags ) );
		register_post_type( 'episodes', array( 'labels' => array( 'name' => __( 'حلقات المسلسلات', 'YourColor' ), 'singular_name' => __( 'حلقات المسلسلات', 'YourColor' ), 'add_new' => __( 'اضافة عنصر', 'YourColor' ), 'add_new_item' => __( 'اضافة عنصر جديد', 'YourColor' ), 'edit' => __( 'تعديل', 'YourColor' ), 'edit_item' => __( 'تعديل', 'YourColor' ), 'new_item' => __( 'عنصر جديد', 'YourColor' ), 'view' => __( 'مشاهدة العنصر', 'YourColor' ), 'view_item' => __( 'مشاهدة العنصر', 'YourColor' ), 'search_items' => __( 'بحث فى العناصر', 'YourColor' ), 'not_found' => __( 'لا يوجد عناصر مضافة', 'YourColor' ), 'not_found_in_trash' => __( 'لا يوجد عناصر مضافة', 'YourColor' ), 'parent' => __( 'حلقات المسلسلات', 'YourColor' ) ), 'public' => true, 'show_ui' => true, 'publicly_queryable' => true, 'show_in_nav_menus' => false, 'exclude_from_search' => false, 'hierarchical' => false, 'rewrite' => array( 'slug' => '', 'with_front' => false ), 'supports' => array( 'title', 'thumbnail', 'editor', 'tag', 'comments' ) ) );
		$labels_series_tags = array( 'name' => __( 'المخرجين', 'YourColor', 'post type general name' ), 'all_items' => __( 'كل العناصر', 'YourColor', 'all items' ), 'add_new_item' => __( 'اضافة جديد', 'YourColor', 'adding a new item' ), 'new_item_name' => __( 'اضافة اسم جديد', 'YourColor', 'adding a new item' ) );
		register_taxonomy( 'episodedirector', 'episodes', array( 'hierarchical' => false, 'rewrite' => true, 'labels' => $labels_series_tags ) );
		$labels_series_tags = array( 'name' => __( 'سنوات الاصدار', 'YourColor', 'post type general name' ), 'all_items' => __( 'كل العناصر', 'YourColor', 'all items' ), 'add_new_item' => __( 'اضافة جديد', 'YourColor', 'adding a new item' ), 'new_item_name' => __( 'اضافة اسم جديد', 'YourColor', 'adding a new item' ) );
		register_taxonomy( 'episodeyear', 'episodes', array( 'hierarchical' => false, 'rewrite' => true, 'labels' => $labels_series_tags ) );
		$labels_series_tags = array( 'name' => __( 'الممثلين', 'YourColor', 'post type general name' ), 'all_items' => __( 'كل العناصر', 'YourColor', 'all items' ), 'add_new_item' => __( 'اضافة جديد', 'YourColor', 'adding a new item' ), 'new_item_name' => __( 'اضافة اسم جديد', 'YourColor', 'adding a new item' ) );
		register_taxonomy( 'episodegueststar', 'episodes', array( 'hierarchical' => false, 'rewrite' => true, 'labels' => $labels_series_tags ) );
		flush_rewrite_rules(  );
	}

	function add_external_link_admin_submenu() {
		global $submenu;

		$permalink = admin_url( 'edit-tags.php' ) . '?taxonomy=category';
		$submenu['options-general.php'][] = array( 'Manage', 'manage_options', $permalink );
	}

	function ads_sizes() {
		$sizes = array(  );
		$sizes['250×300'] = '250×300';
		$sizes['160×600'] = '160×600';
		$sizes['728×90'] = '728×90';
		$sizes['Pop_up'] = 'بوب اب';
		return $sizes;
	}

	function get_ads($size) {
		if (( wp_is_mobile(  ) && $size == '728×90' )) {
			$size = '250×300';
		}

		global $post;

		query_posts( array( 'post_type' => 'ads', 'orderby' => 'rand', 'meta_query' => array( array( 'key' => 'size', 'comapre' => '==', 'value' => $size ) ), 'posts_per_page' => ($size == 'Pop_up' ? 0 - 1 : 1) ) );

		if (have_posts(  )) {
			while (have_posts(  )) {
				the_post(  );

				if (!wp_is_mobile(  )) {
					echo get_post_meta( $post->ID, 'code', true );
					continue;
				}

				echo get_post_meta( $post->ID, 'code_mobile', true );
			}
		}

		wp_reset_query(  );
	}

	function register_my_custom_menu_page_comments() {
		add_menu_page( 'تنبيهات التعليقات', 'تنبيهات التعليقات', 'administrator', 'commentsNotifications', 'options_pageCom', 0 );
	}

	function options_pageCom() {
		echo '<h2>اخر 100 مقال تم التعليق عليه</h2>
';
		echo '<s';
		echo 'tyle type="text/css">
div.table {
    width: 99%;
    background: #fff;
    margin-bottom: 10px;
    padding: 10px;
    box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.26);
}
.tableList {
    width: 100%;
}

.tableList th {background: #23282D;padding: 12px;color: white;box-shadow: 0px 0px 0px 1px #DADADA;}
.tableList td {background: #F7F7F7;padding: 12px;box-shadow: 0px 0px 0px 1px #DADADA;}
';
		echo '
</style>
';

		if ($_POST['deletes']) {
			echo '	';
			foreach ($_POST['dels'] as $id => $del) {
				echo '		';
				$comments = (is_array( get_post_meta( $id, 'comments', true ) ) ? get_post_meta( $id, 'comments', true ) : array(  ));
				echo '		';
				foreach ($del as $coms) {
					echo '			';
					unset( $comments[$coms] );
					echo '		';
				}

				echo '		';
				update_post_meta( $id, 'comments', array_filter( $comments ) );
				echo '	';
			}
		}

		echo '<form action="" method="POST">
';
		query_posts( array( 'post_type' => 'post', 'meta_key' => 'comments', 'posts_per_page' => 100 ) );

		if (have_posts(  )) {
			while (have_posts(  )) {
				the_post(  );
				global $post;

				echo '<s';
				echo 'cript type="text/javascript">
jQuery(document).ready(function($){
    $(\'#selectAll';
				echo $post->ID;
				echo '\').toggle(function(){
        $(\'.select';
				echo $post->ID;
				echo '\').attr(\'checked\',\'checked\');
    },function(){
        $(\'.select';
				echo $post->ID;
				echo '\').removeAttr(\'checked\');
   });
})
</script>
<div class="table">
	<h2>';
				the_title(  );
				echo '</h2>
	<table class="tableList">
		<thead>
			<th style="width: 12px;"><input type="checkbox" id="selectAll';
				echo $post->ID;
				echo '"></th>
			<th>الاسم</th>
			<th>التعليق</th>
			<th>البريد الالكتروني</th>
		</thead>
		<tbody>
			';
				foreach ((is_array( get_post_meta( $post->ID, 'comments', true ) ) ? get_post_meta( $post->ID, 'comments', true ) : array(  )) as $k => $comment) {
					echo '				';

					if ($comment['comment'] != '') {
						echo '					<tr>
						<td><input type="checkbox" value="';
						echo $k;
						echo '" name="dels[';
						echo $post->ID;
						echo '][';
						echo $k;
						echo ']" class="select';
						echo $post->ID;
						echo '"></td>
						<td>';
						echo $comment['name'];
						echo '</td>
						<td>';
						echo $comment['comment'];
						echo '</td>
						<td>';
						echo $comment['email'];
						echo '</td>
					</tr>
				';
					}

					echo '			';
				}

				echo '		</tbody>
	</table>
</div>
';
			}
		}

		echo '<input type="hidden" name="deletes" value="1" />
<button type="submit" style="border: 0;bottom: 0;right: 160px;z-index: 22000;position: fixed;height: 61px;width: calc(100% - 160px);background: #C10202;color: white;font-weight: bold;font-size: 16px">حذف الأن</button>
</form>
';
	}

	function dez_schema_breadcrumb() {
		global $post;

		$schema_link = 'http://data-vocabulary.org/Breadcrumb';
		$home = 'الرئيسية';
		$delimiter = ' &raquo; ';
		$homeLink = get_bloginfo( 'url' );

		if (( is_home(  ) || is_front_page(  ) )) {
			return null;
		}

		echo '<div id="mpbreadcrumbs">';

		if (!is_single(  )) {
			echo 'انت هنا: ';
		}

		echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . $homeLink . '">' . '<span itemprop="title">' . $home . '</span>' . '</a></span>' . $delimiter . ' ';

		if (get_page_by_path( 'blog' )) {
			if (!is_page( 'blog' )) {
				echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_permalink( get_page_by_path( 'blog' ) ) . '">' . '<span itemprop="title">Blog</span></a></span>' . $delimiter . ' ';
			}
		}


		if (is_category(  )) {
			$thisCat = get_category( get_query_var( 'cat' ), false );

			if ($thisCat->parent != 0) {
				$category_link = get_category_link( $thisCat->parent );
				echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . $category_link . '">' . '<span itemprop="title">' . get_cat_name( $thisCat->parent ) . '</span>' . '</a></span>' . $delimiter . ' ';
			}

			$category_id = get_cat_ID( single_cat_title( '', false ) );
			$category_link = get_category_link( $category_id );
			echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . $category_link . '">' . '<span itemprop="title">' . single_cat_title( '', false ) . '</span>' . '</a></span>';
		} 
else {
			if (( is_single(  ) && !is_attachment(  ) )) {
				if (get_post_type(  ) != 'post') {
					$post_type = get_post_type_object( get_post_type(  ) );
					$slug = $post_type->rewrite;
					echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . $homeLink . '/' . $slug['slug'] . '">' . '<span itemprop="title">' . $post_type->labels->singular_name . '</span>' . '</a></span>';
					echo ' ' . $delimiter . ' ' . get_the_title(  );
				} 
else {
					$category = get_the_category(  );

					if ($category) {
						foreach ($category as $cat) {
							echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_category_link( $cat->term_id ) . '">' . '<span itemprop="title">' . $cat->name . '</span>' . '</a></span>' . $delimiter . ' ';
						}
					}

					echo get_the_title(  );
				}
			} 
else {
				if (( ( ( !is_single(  ) && !is_page(  ) ) && get_post_type(  ) != 'post' ) && !is_404(  ) )) {
					$post_type = get_post_type_object( get_post_type(  ) );
					echo $post_type->labels->singular_name;
				} 
else {
					if (is_attachment(  )) {
						$parent = get_post( $post->post_parent );
						$cat = get_the_category( $parent->ID );
						$cat = $cat[0];
						echo get_category_parents( $cat, TRUE, ' ' . $delimiter . ' ' );
						echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_permalink( $parent ) . '">' . '<span itemprop="title">' . $parent->post_title . '</span>' . '</a></span>';
						echo ' ' . $delimiter . ' ' . get_the_title(  );
					} 
else {
						if (( is_page(  ) && !$post->post_parent )) {
							$get_post_slug = $post->post_name;
							$post_slug = str_replace( '-', ' ', $get_post_slug );
							echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_permalink(  ) . '">' . '<span itemprop="title">' . ucfirst( $post_slug ) . '</span>' . '</a></span>';
						} 
else {
							if (( is_page(  ) && $post->post_parent )) {
								$parent_id = $post->post_parent;
								$breadcrumbs = array(  );

								while ($parent_id) {
									$page = get_page( $parent_id );
									$breadcrumbs[] = '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_permalink( $page->ID ) . '">' . '<span itemprop="title">' . get_the_title( $page->ID ) . '</span>' . '</a></span>';
									$parent_id = $page->post_parent;
								}

								$breadcrumbs = array_reverse( $breadcrumbs );
								$i = 12;

								while ($i < count( $breadcrumbs )) {
									echo $breadcrumbs[$i];

									if ($i != count( $breadcrumbs ) - 1) {
										echo ' ' . $delimiter . ' ';
									}

									++$i;
								}

								echo $delimiter . '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_permalink(  ) . '">' . '<span itemprop="title">' . the_title_attribute( 'echo=0' ) . '</span>' . '</a></span>';
							} 
else {
								if (is_tag(  )) {
									$tag_id = get_term_by( 'name', single_cat_title( '', false ), 'post_tag' );

									if ($tag_id) {
										$tag_link = get_tag_link( $tag_id->term_id );
									}

									echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . $tag_link . '">' . '<span itemprop="title">' . single_cat_title( '', false ) . '</span>' . '</a></span>';
								} 
else {
									if (is_author(  )) {
										global $author;

										$userdata = get_userdata( $author );
										echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_author_posts_url( $userdata->ID ) . '">' . '<span itemprop="title">' . $userdata->display_name . '</span>' . '</a></span>';
									} 
else {
										if (is_404(  )) {
											echo 'Error 404';
										} 
else {
											if (is_search(  )) {
												echo 'Search results for "' . get_search_query(  ) . '"';
											} 
else {
												if (is_day(  )) {
													echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . '<span itemprop="title">' . get_the_time( 'Y' ) . '</span>' . '</a></span>' . $delimiter . ' ';
													echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . '<span itemprop="title">' . get_the_time( 'F' ) . '</span>' . '</a></span>' . $delimiter . ' ';
													echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ) . '">' . '<span itemprop="title">' . get_the_time( 'd' ) . '</span>' . '</a></span>';
												} 
else {
													if (is_tax( 'seasons' )) {
														$arrow = get_term_by( 'slug', $_GET['season'], 'series' );
														echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_term_link( $arrow ) . '">' . '<span itemprop="title">' . $arrow->name . '</span>' . '</a></span>' . $delimiter . ' ';
														echo single_cat_title(  );
													} 
else {
														if (is_tax(  )) {
															echo single_cat_title(  );
														} 
else {
															if (is_month(  )) {
																echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . '<span itemprop="title">' . get_the_time( 'Y' ) . '</span>' . '</a></span>' . $delimiter . ' ';
																echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . '<span itemprop="title">' . get_the_time( 'F' ) . '</span>' . '</a></span>';
															} 
else {
																if (is_year(  )) {
																	echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . '<span itemprop="title">' . get_the_time( 'Y' ) . '</span>' . '</a></span>';
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}


		if (get_query_var( 'paged' )) {
			if (( ( ( ( ( ( is_category(  ) || is_day(  ) ) || is_month(  ) ) || is_year(  ) ) || is_search(  ) ) || is_tag(  ) ) || is_author(  ) )) {
				echo ' (';
			}

			echo __( 'Page' ) . ' ' . get_query_var( 'paged' );

			if (( ( ( ( ( ( is_category(  ) || is_day(  ) ) || is_month(  ) ) || is_year(  ) ) || is_search(  ) ) || is_tag(  ) ) || is_author(  ) )) {
				echo ')';
			}
		}

		echo '</div>';
	}

	function paginate() {
	global $wp_query, $wp_rewrite;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

	$pagination = array(
	    'base' => @add_query_arg('page','%#%'),
	    'format' => '',
	    'total' => $wp_query->max_num_pages,
	    'current' => $current,
	    'show_all' => false,
	    'type' => 'list',
	    'next_text' => '&laquo;',
	    'prev_text' => '&raquo;'
	    );

	if( $wp_rewrite->using_permalinks() )
	    $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 'page', get_pagenum_link( 1 ) ) ) . '?page=%#%/', 'paged' );

	if( !empty($wp_query->query_vars['s']) )
	    $pagination['add_args'] = array( 's' => get_query_var( 's' ) );

	echo paginate_links( $pagination );
	}

	function basic_wp_seo() {
		global $page;
		global $paged;
		global $post;

		$title_custom = get_post_meta( $post->ID, 'mm_seo_title', true );
		$url = ltrim( esc_url( $_SERVER['REQUEST_URI'] ), '/' );
		$name = get_bloginfo( 'name', 'display' );
		$title = trim( wp_title( '', false ) );
		$cat = single_cat_title( '', false );
		$tag = single_tag_title( '', false );
		$search = get_search_query(  );

		if (( is_home(  ) || is_front_page(  ) )) {
			$seo_title = $name;
		} 
else {
			if (is_singular(  )) {
				$seo_title = $title;
			} 
else {
				if (is_tag(  )) {
					$seo_title = 'ارشيف كلمة: ' . $tag;
				} 
else {
					if (is_category(  )) {
						$seo_title = 'ارشيف قسم: ' . $cat;
					} 
else {
						if (is_archive(  )) {
							$seo_title = $title;
						} 
else {
							if (is_search(  )) {
								$seo_title = 'بحث: ' . $search;
							} 
else {
								if (is_404(  )) {
									$seo_title = '404 - تعذر الوصول: ' . $url;
								} 
else {
									$seo_title = $name;
								}
							}
						}
					}
				}
			}
		}

		$output .= '		' . '<title>' . esc_attr( $seo_title . $page_number ) . '</title>' . '
';
		return $output;
	}

	function yourcolor_numeric_posts_nav() {
		if (is_singular(  )) {
			return null;
		}

		global $wp_query;

		if ($wp_query->max_num_pages <= 1) {
			return null;
		}

		$paged = (get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1);
		$max = intval( $wp_query->max_num_pages );

		if (1 <= $paged) {
			$links[] = $paged;
		}


		if (3 <= $paged) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}


		if ($paged + 2 <= $max) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}

		echo '<div class="navigation"><ul>' . '
';

		if (get_previous_posts_link(  )) {
			printf( '<li>%s</li>' . '
', get_previous_posts_link(  ) );
		}


		if (!in_array( 1, $links )) {
			$class = (1 == $paged ? ' class="active"' : '');
			printf( '<li%s><a href="%s">%s</a></li>' . '
', $class, esc_url( get_pagenum_link( 1 ) ), '1' );

			if (!in_array( 2, $links )) {
				echo '<li>…</li>';
			}
		}

		sort( $links );
		foreach ((array)$links as $link) {
			$class = ($paged == $link ? ' class="active"' : '');
			printf( '<li%s><a href="%s">%s</a></li>' . '
', $class, esc_url( get_pagenum_link( $link ) ), $link );
		}


		if (!in_array( $max, $links )) {
			if (!in_array( $max - 1, $links )) {
				echo '<li>…</li>' . '
';
			}

			$class = ($paged == $max ? ' class="active"' : '');
			printf( '<li%s><a href="%s">%s</a></li>' . '
', $class, esc_url( get_pagenum_link( $max ) ), $max );
		}


		if (get_next_posts_link(  )) {
			printf( '<li>%s</li>' . '
', get_next_posts_link(  ) );
		}

		echo '</ul></div>' . '
';
	}

	function pippin_taxonomy_add_new_meta_field() {
		echo '	<div class="form-field">
		<label for="term_meta[image]">';
		_e( 'الصورة', 'pippin' );
		echo '</label>
		<input type="text" name="term_meta[image]" id="term_meta[image]" value="">
	</div>
';
	}

	function pippin_taxonomy_add_new_meta_field_2() {
		echo '	<div class="form-field">
		<label for="term_meta[image]">';
		_e( 'الصورة', 'pippin' );
		echo '</label>
		<input type="text" name="term_meta[image]" id="term_meta[image]" value="">
	</div>
';
	}

	function pippin_taxonomy_edit_meta_field($term) {
		$t_id = $term->term_id;
		$term_meta = get_option( '' . 'taxonomy_' . $t_id );
		echo '	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[image]">';
		_e( 'الصورة', 'pippin' );
		echo '</label></th>
		<td>
			<input type="text" name="term_meta[image]" id="term_meta[image]" value="';
		echo (esc_attr( $term_meta['image'] ) ? esc_attr( $term_meta['image'] ) : '');
		echo '">
		</td>
	</tr>
';
	}

	function save_taxonomy_custom_meta($term_id) {
		if (isset( $_POST['term_meta'] )) {
			$t_id = $term_id;
			$term_meta = get_option( '' . 'taxonomy_' . $t_id );
			$cat_keys = array_keys( $_POST['term_meta'] );
			foreach ($cat_keys as $key) {

				if (isset( $_POST['term_meta'][$key] )) {
					$term_meta[$key] = $_POST['term_meta'][$key];
					continue;
				}
			}

			update_option( '' . 'taxonomy_' . $t_id, $term_meta );
		}

	}

	function pippin_get_image_id($image_url) {
		global $wpdb;

		$attachment = $wpdb->get_col( $wpdb->prepare( '' . 'SELECT ID FROM ' . $wpdb->posts . ' WHERE guid=\'%s\';', $image_url ) );
		return $attachment[0];
	}

	function wp_postratings_schema_itemtype($itemtype) {
		return 'itemscope itemtype="http://schema.org/Movies"';
	}

	function YC_admin_style2() {
		echo '	';
		echo '<s';
		echo 'cript type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
    ';
		echo '<s';
		echo 'cript>
    jQuery(document).ready(function($) {
        $(\'.cmb2-id-imdb\').html(\'<button onClick="get_data();return false;" class="button button-success button-large">استخراج البيانات من IMDB</button>\');
    });
    function get_data(id) {
		if( $(\'#imdb_id\').val() != \'\' ) {
			$(\'.cmb2-id-imdb\').append(\'<div class="progtess-imdb" style="height: 20px;width: 300px;background: #e';
		echo 'ee;"><div style="height: 100%;width: 50px;background: rgb(35, 40, 45);" class="bar"></div></div>\');
			$.ajax({
				url: \'';
		echo get_template_directory_uri(  );
		echo '/imdb/get_data.php\',
				type:\'GET\',
				data:\'id=\'+$("#imdb_id").val()+\'&pid=\'+$(\'#post_ID\').val()+\'\',
				xhr: function() {
					var xhr = new window.XMLHttpRequest();
					xhr.upload.addEventListener("progress", function(evt) {
						if (evt.lengthComputable) {
							var percentComplete = evt.loaded / evt.total*100;
							$(\'.progtess-imdb .bar\').css({"width":percentComplete+\'%\'});
	';
		echo '					}
				   }, false);
			
		
				   xhr.addEventListener("progress", function(evt) {
					   if (evt.lengthComputable) {
						   var percentComplete = evt.loaded / evt.total*100;
						   $(\'.progtess-imdb .bar\').css({"width":percentComplete+\'%\'});
					   }
				   }, false);
			
				   return xhr;
				},
				success: function(msg) {
					$(\'body\').append(msg);
					$(\'.progtess';
		echo '-imdb\').remove();
				},
				error: function(){
					$(\'.progtess-imdb\').remove();
					$(\'.cmb2-id-imdb\').append(\'';
		echo '<s';
		echo 'trong class="sdasdprogress" style="color:red;">حدث خطأ اثناء السحب ...</strong>\');
				}
			});
		}
    }
    </script>
    ';
	}

	function register_my_custom_menu_page() {
		add_menu_page( 'الاعدادات', 'الاعدادات', 'administrator', 'YC_panel', 'options_page', 0 );
	}

	function options_page() {
		echo '	';

		if (array_key_exists( 'action', $_POST )) {
			echo '		';
			update_option( 'recentitmsBanner', stripslashes( $_POST['recentitmsBanner'] ) );
			echo '		';
			update_option( 'redirectBanner', stripslashes( $_POST['redirectBanner'] ) );
			echo '		';
			update_option( '728×90_after_genres', stripslashes( $_POST['728×90_after_genres'] ) );
			echo '		';
			update_option( '728×90_after_coverContent', stripslashes( $_POST['728×90_after_coverContent'] ) );
			echo '		';
			update_option( 'recentitmsBanner_mobile', stripslashes( $_POST['recentitmsBanner_mobile'] ) );
			echo '		';
			update_option( 'redirectBanner_mobile', stripslashes( $_POST['redirectBanner_mobile'] ) );
			echo '		';
			update_option( '728×90_after_genres_mobile', stripslashes( $_POST['728×90_after_genres_mobile'] ) );
			echo '		';
			update_option( '728×90_after_coverContent_mobile', stripslashes( $_POST['728×90_after_coverContent_mobile'] ) );
			echo '
		';
			update_option( 's_title_home', stripslashes( $_POST['s_title_home'] ) );
			echo '		';
			update_option( 's_description_home', stripslashes( $_POST['s_description_home'] ) );
			echo '		';
			update_option( 's_tags_home', stripslashes( $_POST['s_tags_home'] ) );
			echo '		';
			update_option( 's_404', stripslashes( $_POST['s_404'] ) );
			echo '


	';
		}

		echo '	';
		echo '<s';
		echo 'tyle type="text/css">
	.form-control + h2 {
	    text-align: center;
	    font-size: 25px;
	}
	.form-control {
	    background: #fff;
	    margin-top: 7px;
	    padding: 12px;
	    box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.22);
	}

	.form-control label {
	    font-weight: bold;
	    font-size: 15px;
	    float: right;
	    display: inline-block;
	    width: 170px;
	}

	.form-cont';
		echo 'rol textarea {
	    width: calc(100% - 170px);
	    height: 110px;
	}
	</style>
	<form method="post">
		<div class="form-control">
			<label for="recentitmsBanner">بانر تحت الاحدث</label>
			<textarea name="recentitmsBanner" id="recentitmsBanner" class="form-control">';
		echo get_option( 'recentitmsBanner' );
		echo '</textarea>
		</div>
		<div class="form-control">
			<label for="redirectBanner">بانر صفحة التحويل</label>
			<textarea name="redirectBanner" id="redirectBanner" class="form-control">';
		echo get_option( 'redirectBanner' );
		echo '</textarea>
		</div>
		<div class="form-control">
			<label for="728×90_after_genres">بانر تحت السليدر</label>
			<textarea name="728×90_after_genres" id="728×90_after_genres" class="form-control">';
		echo get_option( '728×90_after_genres' );
		echo '</textarea>
		</div>
		<div class="form-control">
			<label for="728×90_after_coverContent">بانر تحت الكفر</label>
			<textarea name="728×90_after_coverContent" id="728×90_after_coverContent" class="form-control">';
		echo get_option( '728×90_after_coverContent' );
		echo '</textarea>
		</div>
		<h2>للموبايل</h2>
		<div class="form-control">
			<label for="recentitmsBanner_mobile">بانر تحت الاحدث</label>
			<textarea name="recentitmsBanner_mobile" id="recentitmsBanner_mobile" class="form-control">';
		echo get_option( 'recentitmsBanner_mobile' );
		echo '</textarea>
		</div>
		<div class="form-control">
			<label for="redirectBanner_mobile">بانر صفحة التحويل</label>
			<textarea name="redirectBanner_mobile" id="redirectBanner_mobile" class="form-control">';
		echo get_option( 'redirectBanner_mobile' );
		echo '</textarea>
		</div>
		<div class="form-control">
			<label for="728×90_after_genres_mobile">بانر تحت السليدر</label>
			<textarea name="728×90_after_genres_mobile" id="728×90_after_genres_mobile" class="form-control">';
		echo get_option( '728×90_after_genres_mobile' );
		echo '</textarea>
		</div>
		<div class="form-control">
			<label for="728×90_after_coverContent_mobile">بانر تحت الكفر</label>
			<textarea name="728×90_after_coverContent_mobile" id="728×90_after_coverContent_mobile" class="form-control">';
		echo get_option( '728×90_after_coverContent_mobile' );
		echo '</textarea>
		</div>
		<h2>الارشفة</h2>
		<div class="form-control">
			<label for="s_title_home">عنوان الصفحة الرئيسية</label>
			<input name="s_title_home" id="s_title_home" value="';
		echo get_option( 's_title_home' );
		echo '" />
		</div>
		<div class="form-control">
			<label for="s_description_home">وصف الصفحة الرئيسية</label>
			<textarea name="s_description_home" id="s_description_home" class="form-control">';
		echo get_option( 's_description_home' );
		echo '</textarea>
		</div>
		<div class="form-control">
			<label for="s_tags_home">وسوم الصفحة الرئيسية</label>
			<input name="s_tags_home" id="s_tags_home" value="';
		echo get_option( 's_tags_home' );
		echo '" />
		</div>
		<div class="form-control">
			<label for="s_404">عنوان صفحة الخطأ</label>
			<input name="s_404" id="s_404" value="';
		echo get_option( 's_404' );
		echo '" />
		</div>
        <input class="button button-primary button-large" type="submit" name="action" value="حفظ">
        <input type="hidden" name="action" value="save">
	</form>
';
	}

	add_action( 'wp_enqueue_scripts', 'add_scripts' );
	add_action( 'wp_ajax_my_search', 'my_search' );
	add_action( 'wp_ajax_nopriv_my_search', 'my_search' );
	add_action( 'init', 'create_series_category', 0 );
	add_action( 'admin_menu', 'add_external_link_admin_submenu' );

	add_action( 'init', 'register_ads_post_type' );
	function register_ads_post_type() {
		register_post_type( 'ads', array( 'labels' => array( 'name' => __( 'ادارة الاعلانات' ), 'singular_name' => __( 'ادارة الاعلانات' ), 'add_new' => __( 'اضافة اعلان' ), 'add_new_item' => __( 'اضافة اعلان جديد' ), 'edit' => __( 'تعديل' ), 'edit_item' => __( 'تحرير الاعلان' ), 'new_item' => __( 'اعلان جديد' ), 'view' => __( 'مشاهدة الاعلان' ), 'view_item' => __( 'مشاهدة الاعلان' ), 'search_items' => __( 'بحث فى الاعلانات' ), 'not_found' => __( 'لا يوجد اعلانات' ), 'not_found_in_trash' => __( 'لا يوجد اعلانات فى سلة المهملات' ), 'parent' => __( 'الاعلان الرئيسي' ) ), 'public' => false, 'show_ui' => true, 'publicly_queryable' => true, 'show_in_nav_menus' => false, 'exclude_from_search' => false, 'hierarchical' => false, 'menu_position' => 5, 'rewrite' => array( 'slug' => 'ads' ), 'supports' => array( 'title' ) ) );
		flush_rewrite_rules(  );
	}

	add_action( 'admin_menu', 'register_my_custom_menu_page_comments' );


	if (!function_exists( 'yourcolor_setup' )) {
		function yourcolor_setup() {
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'post-thumbnails' );
			add_image_size( 'categos', 150, 125, false );
			add_image_size( 'block', 188, 280, false );
			add_image_size( 'og', 400, 400, false );
			add_image_size( 'cover', 1200, 400, false );
			register_nav_menus( array( 'main-menu' => __( 'القائمة الاساسية', 'YourColor' ), 'footer-menu' => __( 'القائمة الفوتر', 'YourColor' ), 'top-menu' => __( 'القائمة العلوية', 'YourColor' ) ) );
		}
	}

	add_action( 'after_setup_theme', 'yourcolor_setup' );
	require_once( get_template_directory(  ) . '/CustomMetaBox/functions.php' );
	require_once( get_template_directory(  ) . '/CustomMetaBox/CMB2.php' );
	add_action( 'genre_add_form_fields', 'pippin_taxonomy_add_new_meta_field', 10, 2 );
	add_action( 'series_add_form_fields', 'pippin_taxonomy_add_new_meta_field_2', 10, 2 );
	add_action( 'movseries_add_form_fields', 'pippin_taxonomy_add_new_meta_field_2', 10, 2 );
	add_action( 'genre_edit_form_fields', 'pippin_taxonomy_edit_meta_field', 10, 2 );
	add_action( 'movseries_edit_form_fields', 'pippin_taxonomy_edit_meta_field', 10, 2 );
	add_action( 'series_edit_form_fields', 'pippin_taxonomy_edit_meta_field', 10, 2 );
	add_action( 'edited_genre', 'save_taxonomy_custom_meta', 10, 2 );
	add_action( 'create_genre', 'save_taxonomy_custom_meta', 10, 2 );
	add_action( 'edited_series', 'save_taxonomy_custom_meta', 10, 2 );
	add_action( 'create_series', 'save_taxonomy_custom_meta', 10, 2 );
	add_action( 'edited_movseries', 'save_taxonomy_custom_meta', 10, 2 );
	add_action( 'create_movseries', 'save_taxonomy_custom_meta', 10, 2 );
	add_filter( 'wp_postratings_schema_itemtype', 'wp_postratings_schema_itemtype' );
	require_once( get_template_directory(  ) . '/seo/machine.php' );
	add_action( 'admin_enqueue_scripts', 'YC_admin_style2' );
	add_action( 'admin_menu', 'register_my_custom_menu_page' );
?>