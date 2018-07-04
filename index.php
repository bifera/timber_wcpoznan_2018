<?php

$context = Timber::get_context();
$context['posts'] = new Timber\PostQuery();

$args = [
    'posts_per_page' => 3,
    'category_name' => 'news'
];

$context['news'] = Timber::get_posts( $args );

Timber::render( 'views/templates/index.twig', $context );
