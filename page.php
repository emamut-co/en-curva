<?php get_header(); ?>

<div class="container">
  <div class="row">
    <div class="col mt-5 pt-4">
      <h1 class="title"><?php the_title(); ?></h1>
    </div>
  </div>
  <div class="row">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="col-md-8">
        <?php the_content(); ?>
      </div>
      <div class="col-md-4">
        <?php get_template_part( 'partials/sidebar', 'template' ); ?>
        <?php if ( is_active_sidebar( 'custom-side-bar' ) )
          dynamic_sidebar( 'custom-side-bar' ); ?>
      </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</div>

<?php get_footer(); ?>