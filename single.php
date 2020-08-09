<?php get_header() ?>

  <div class="container">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <div class="row mt-5 pt-4">
        <div class="col">
          <span class="text-dark" style="font-weight: bold;"><?php the_category(' | ') ?></span>
          <h1 class="title"><?php the_title() ?></h1>
          <span class="text-muted"><?php echo get_the_date( 'l, j M Y' ); ?></span>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-12">
          <?php the_post_thumbnail('large', ['class' => 'w-100']) ?>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-md-8" id="the-content">
          <?php the_content() ?>
        </div>
        <div class="col-md-4">
          <?php get_template_part( 'partials/sidebar', 'template' );
          if ( is_active_sidebar( 'custom-side-bar' ) )
            dynamic_sidebar( 'custom-side-bar' ); ?>
        </div>
      </div>
    <?php endwhile ?>
  <?php endif ?>
  </div>

<?php get_footer() ?>