<?php
/*
  Quote Template
*/

$kind = get_post_kind_slug( get_the_ID() );
$meta = new Kind_Meta( get_the_ID() );
$author = Kind_View::get_hcard( $meta->get_author() );
$cite = $meta->get_cite();
$site_name = Kind_View::get_site_name( $meta->get_cite(), $meta->get_url() );
$title = Kind_View::get_cite_title( $meta->get_cite(), $meta->get_url() );
$embed = self::get_embed( $meta->get_url() );
$rsvp = $meta->get( 'rsvp' );

$type = 'u-bookmark-of';
?>
<section class="h-cite <?php echo $type; ?> ">
<header>

<?php
if ( $kind == 'bookmark' ) {
	echo '<a class="u-bookmark-of" href="' . $meta->get_url() . '"></a>';
}
if( ! $embed ) {
	if ( $title ) {
		echo $title;
	}
	if ( $author ) {
		echo ' ' . __( 'by', 'indieweb-post-kinds' ) . ' ' . $author;
	}
	if ( $site_name ) {
		echo '<em>(<span class="p-publication">' . $site_name . '</span>)</em>';
	}
	if ( in_array( $kind, array( 'jam', 'listen', 'play', 'read', 'watch' ) ) ) {
		$duration = $meta->get_duration();
		if ( $duration ) {
			echo '(' . __( 'Duration: ', 'indieweb-post-kinds' ) . '<span class="p-duration">' . $duration . '</span>)';
		}
	}
}
?>
</header>
<?php
if ( $cite ) {
	if ( $embed ) {
		echo sprintf( '<blockquote class="e-summary">%1s</blockquote>', $embed );
	} else if ( array_key_exists( 'summary', $cite ) ) {
		echo sprintf( '<blockquote class="e-summary">%1s</blockquote>', $cite['summary'] );
	}
}
// Close Response
?>
</section>

<?php
