
<?php
/*
 * Photo Template
 *
 */

$meta = new Kind_Meta( get_the_ID() );
$photos = get_attached_media( 'image', get_the_ID() );
$cite = $meta->get_cite();
$url = $meta->get_url();
$embed = self::get_embed( $meta->get_url() );
?>
<?php
/*echo Kind_Taxonomy::get_before_kind( 'photo' );*/
if ( isset( $cite['name'] ) ) {
?>
<section class="response">
<header>
<?php
	echo sprintf( '<span class="p-name">%1s</a>', $cite['name'] );
?>
</header>
</section>
<?php
}
?>
<?php
if ( $photos && ! has_post_thumbnail( get_the_ID() ) ) {
	echo gallery_shortcode(
		array(
			'id' => get_the_ID(),
			'size' => 'large',
			'columns' => 1,
			'link' => 'file',
		)
	);
} else {
	if ( $embed ) {
		echo sprintf( '<blockquote class="e-summary">%1s</blockquote>', $embed );
	}
}
?>
<?php
