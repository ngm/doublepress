<?php
/**
 * Based on this post: https://www.smashingmagazine.com/2012/04/random-redirection-in-wordpress/
 */

$args = array(
    'numberposts' => 1,
    'orderby' => 'rand'
);

$random_post = get_posts ( $args );

foreach ($random_post as $post)
{
    wp_redirect(get_permalink($post->ID));
    exit;
}

?>