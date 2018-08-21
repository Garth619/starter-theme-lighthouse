<?php get_header();?>


  <div id="internal-page-container" class="clearfix">
    <div class="internal-main">
      <h1 class="internal-page-title"><?php the_title();?></h1>

      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php the_content();?>
      <?php endwhile; else : ?>
        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
      <?php endif; ?>
    </div>

    <div class="internal-sidebar">
      <?php wp_nav_menu( array('menu' => 'Sidebar Menu' )); ?>
    </div>
  </div>


<?php get_footer();?>