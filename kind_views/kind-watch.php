<?php
/*
 * Watch Template
 *
 */

$kind = get_post_kind_slug(get_the_ID());
$mf2_post = new MF2_Post(get_the_ID());
$cite = $mf2_post->fetch();
if (!$cite) {
    return;
}
$author    = Kind_View::get_hcard(ifset($cite['author']));
$url       = $cite['url'];
$site_name = Kind_View::get_site_name($cite, $url);
$title     = Kind_View::get_cite_title($cite, $url);
$embed     = self::get_embed($url);
$duration  = $mf2_post->get('duration');
if (! $duration) {
    $duration = calculate_duration($mf2_post->get('dt-start'), $mf2_post->get('dt-end'));
}

?>

<section class="response p-watch-of h-cite">
<header>
<?php
if ( ! $embed ) {
	echo '<span class="kind">[<a href="/kind/'.$kind.'">'. $kind.'</a>]</span>';
	if ( $title ) {
		echo '<h2>'.$title.'</h2>';
	}
	if ( $author ) {
		echo ' ' . __( 'by', 'indieweb-post-kinds' ) . ' ' . $author;
	}
	if ( $site_name ) {
		echo __( ' from ', 'indieweb-post-kinds' ) . '<em>' . $site_name . '</em>';
	}
	if ( $duration ) {
		echo '(<data class="p-duration" value="' . $duration . '">' . Kind_View::display_duration( $duration ) . '</data>)';
	}
}
?>
</header>
<?php
if ( $cite ) {
	if ( $embed ) {
		echo sprintf( '<div class="e-summary">%1s</div>', $embed );
	} elseif ( array_key_exists( 'summary', $cite ) ) {
		echo sprintf( '<blockquote class="e-summary">%1s</blockquote>', $cite['summary'] );
	}
}

// Close Response
?>
</section>

<?php