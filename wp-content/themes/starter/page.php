<?php
/*
 * Default Template
 */
?>

<?php get_header();?>

  <div class="default-page" id="internal-page">
    <div class="default-page-container">
      <div class="default-main">
        <h1><?php the_title();?></h1>

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <?php the_content();?>
        <?php endwhile; else : ?>
          <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
        <?php endif; ?>

      </div>

      <div class="default-sidebar">
        <?php wp_nav_menu( array('menu' => 'Sidebar Menu' )); ?>
      </div>
    </div>
  </div>

<?php get_footer();?>