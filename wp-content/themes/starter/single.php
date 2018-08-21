<?php
/*
 * Template for single blog posts.
 */
?>

<!--

  1) copy page.php into here
  2) place this code in the main content div

      <h1><?php the_title();?></h1>
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      <p class="blog-time">Posted in <?php the_category(',');?> on <?php the_time('F j, Y'); ?></p>
      <?php the_content();?>

      <?php endwhile; else : ?>
      <p><?php ( 'Sorry, no posts matched your criteria.' ); ?></p>
      <?php endif; ?>

  3) add this code to the sidebar div

      <?php dynamic_sidebar( 'blog-sidebar' ); ?>

  4) style appropriately (add classes and css)

-->