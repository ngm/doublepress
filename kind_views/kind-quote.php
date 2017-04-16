<?php
/*
  Quote Template
*/

$kind = get_post_kind_slug( get_the_ID() );
$meta = new Kind_Meta( get_the_ID() );

$cite = $meta->get_cite();
$url = $meta->get_url();
$embed = self::get_embed($url);

$context['quotation_url'] = $url;
$context['title'] = Kind_View::get_cite_title( $cite, $url );
$context['author'] = Kind_View::get_hcard( $meta->get_author() );
$context['by'] = __( 'by', 'indieweb-post-kinds' );
$context['site_name'] = Kind_View::get_site_name( $cite, $url );

$context['cite'] = $cite;
$context['embed'] = $embed;

if ($embed) {
    $context['showEmbed'] = true;
} else if ( array_key_exists( 'summary', $cite ) ) {
    $context['showCiteSummary'] = true;
}

Timber::render('kind-quote.twig', $context);
?>
