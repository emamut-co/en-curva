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
          <?php get_template_part( 'partials/sidebar', 'template' ); ?>
          <?php if ( is_active_sidebar( 'custom-side-bar' ) )
            dynamic_sidebar( 'custom-side-bar' ); ?>
        </div>
      </div>
    <?php endwhile ?>
  <?php endif ?>
  </div>
  <div class="row bg-orange justify-content-center py-1 py-md-4 mt-4">
    <div class="col-md-6 py-2 py-md-5">
      <h5 class="text-800">¡NEWSLETTER PARA AVENTUREROS!</h5>
      <p class="font-lato">Suscríbete al boletín En Curva para noticias, eventos y mucho más</p>
      <?php echo do_shortcode('[contact-form-7 html_id="newsletter-form" html_class="form-inline" title="Newsletter form 1"]') ?>
      <small id="emailHelp" class="form-text text-muted">Al suscribirte aceptas la <span class="font-weight-bold"><a href="#" class="text-dark mt-2">Política de Privacidad de En Curva</a></span></small>
    </div>
  </div>

<?php get_footer() ?>