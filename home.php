<?php

$context = Timber::get_context();
$homepage = Timber::get_post('home', 'HechingerPost');
$second_feature = $homepage->get_field('second_feature');

if (class_exists('TimberStream')) {
  $stream = new TimberStream('homepage');
  $context['posts'] = $stream->get_posts(array(), 'HechingerPost');
}

//TODO: filter out posts in homepage stream
$context['latest_posts'] = Timber::get_posts('HechingerPost');

if ( isset($second_feature) && is_array($second_feature) ) {
  $context['second_feature'] = new HechingerPost($second_feature[0]->ID);
} else {
  $context['second_feature'] = new HechingerPost($post->ID);
}

Timber::render('pages/home.twig', $context);
