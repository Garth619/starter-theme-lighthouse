<!DOCTYPE html>
<html lang="en-US">

<head>

  <!-- Title -->
  <title><?php bloginfo('name'); ?></title>

  <!-- Meta Stuff -->
  <meta charset="utf-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="Content-Style-Type" content="text/css">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <meta name = "format-detection" content = "telephone=no">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png">

  <!-- Fonts -->
  <link rel="preload" href="<?php echo get_stylesheet_directory_uri(); ?>/fonts/.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?php echo get_stylesheet_directory_uri(); ?>/fonts/.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?php echo get_stylesheet_directory_uri(); ?>/fonts/.woff2" as="font" type="font/woff2" crossorigin>

  <!-- WordPress Header Hook - Prints scripts or data in the head tag on the front end -->
  <?php wp_head(); ?>

  <!-- Schema -->
  <?php the_field('schema_code', 'option'); ?>

  <!-- Analytics -->
  <?php the_field('analytics_code', 'option'); ?>

</head>

	<body <?php body_class(); ?> >

    <header>
      <!-- Add site header here -->
    </header>





