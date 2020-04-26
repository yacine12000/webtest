<?php

// Template Name: aaa

get_header(); ?>

<?php if (function_exists('get_highest_rated')): ?>
    <ul>
        <?php get_highest_rated(); ?>
    </ul>
<?php endif; ?>