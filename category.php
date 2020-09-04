<?php get_header();

$background_image = get_field('background_image', $term);
$color_text = get_field('color_text', $term);

$category = get_category( get_query_var( 'cat' ) ); ?>
  <div class="row">
    <div class="col text-center" style="background-image: url(<?php echo $background_image['url'] ?>); border-bottom: .3rem solid <?php echo $color_text ?>" id="category-header">
      <p class="text-orange">Lo que hay de nuevo en</p>
      <span class="h1 text-white text-800">
        <?php echo $category->cat_name; ?>
      </span>
    </div>
  </div>

  <div class="row">
    <div class="container">
      <div class="row mt-4">
        <?php $term = get_queried_object();
        $color_text = get_field('color_text', $term); ?>
        <blog-component id="<?php echo $category->cat_ID ?>" color="<?php echo $color_text ?>" name="<?php echo $category->cat_name; ?>"></blog-component>
        <div class="col-md-4">
          <?php get_template_part( 'partials/sidebar', 'template' ); ?>
          <?php if ( is_active_sidebar( 'custom-side-bar' ) )
            dynamic_sidebar( 'custom-side-bar' ); ?>
        </div>
      </div>
    </div>
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
<script>
  categoryID = <?php echo $category->cat_ID; ?>
</script>