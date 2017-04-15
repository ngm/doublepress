<?php
/*
  Quote Template
*/

$kind = get_post_kind_slug( get_the_ID() );
$meta = new Kind_Meta( get_the_ID() );
$context['author'] = Kind_View::get_hcard( $meta->get_author() );
$cite = $meta->get_cite();
$context['site_name'] = Kind_View::get_site_name( $meta->get_cite(), $meta->get_url() );
$context['title'] = Kind_View::get_cite_title( $meta->get_cite(), $meta->get_url() );
$embed = self::get_embed( $meta->get_url() );
$context['embed'] = $embed;
$context['meta_url'] = $meta->get_url();
$context['by'] = __( 'by', 'indieweb-post-kinds' );
$context['cite'] = $cite;

if ($embed) {
    $context['quoteText'] = $embed;
} else if ( array_key_exists( 'summary', $cite ) ) {
    $context['quoteText'] = $cite['summary'];
}

Timber::render('kind-quote.twig', $context);

?>

