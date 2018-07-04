<?php
$context = Timber::get_context();
$context['post'] = Timber::get_post();

Timber::render( ['views/templates/single.twig'], $context );

?>
