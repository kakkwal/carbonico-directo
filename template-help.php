<?php // Template Name: Help

use Timber\Timber;

$context = Timber::context();
$context['post'] = Timber::get_post();

$args = [
    'post_type'      => 'products',
    'posts_per_page' => -1,
];
$context['listProducts'] = Timber::get_posts($args);

Timber::render('pages/help.twig', $context);

