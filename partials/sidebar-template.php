<h4 class="subtitle mb-3">LAS MÁS LEIDAS HOY</h4>
<?php $mostViewedArray = new WP_Query(
  array(
    'meta_key'        => 'post_views_count',
    'orderby'         => 'meta_value_num',
    'posts_per_page'  => 2,
    'tax_query'       => array( array(
      'taxonomy' => 'post_format',
      'field' => 'slug',
      'terms' => array('post-format-aside', 'post-format-gallery', 'post-format-link', 'post-format-image', 'post-format-quote', 'post-format-status', 'post-format-audio', 'post-format-chat', 'post-format-video'),
      'operator' => 'NOT IN'
    ) )
  )
);?>

<ul class="list-unstyled">
  <?php while ( $mostViewedArray->have_posts() ): $mostViewedArray->the_post() ?>
    <li class="media mb-3">
      <?php the_post_thumbnail(array(100), ['class' => 'mr-3']) ?>
      <div class="media-body">
        <?php $categories = get_the_category();
        if (!empty($categories)) {
          $termID = $categories[0]->cat_ID;
          $categoryColor = get_field('color_text', 'term_' . $termID);
          $categoryURL = get_category_link( $termID );
        } ?>
        <a href="<?php echo esc_url( $categoryURL ); ?>" class="category" style="font-weight: bold; color: <?php echo $categoryColor; ?>"><?php echo $categories[0]->name ?></a>
        <a href="<?php the_permalink() ?>"><h5 class="card-title text-dark text-800 mb-0"><?php the_title() ?></h5></a>
        <small class="card-text"><?php echo get_the_date( 'l, j M Y' ); ?></small>
      </div>
    </li>
  <?php endwhile ?>
</ul>


<div class="d-none d-md-block text-center">
  <img src="<?php echo get_template_directory_uri() ?>/images/ads-sample.png" alt="" class="img-fluid">
</div>

<a class="d-block d-md-none text-dark text-center mt-4" data-toggle="collapse" href="#more-most-viewed" role="button" aria-expanded="false" aria-controls="more-most-viewed" id="remove-collapse">
  VER MÁS HISTORIAS <br>
  <i class="fas fa-chevron-down fa-2x text-orange"></i>
</a>

<div class="collapse" id="more-most-viewed">
  Aqui
</div>

<h4 class="subtitle mt-5 mb-3">SÍGUENOS EN REDES</h4>
<div class="text-center text-md-left">
  <ul class="list-inline" id="rrss-icons">
    <li class="list-inline-item px-0">
      <span class="fa-stack fa-1x">
        <i class="far fa-circle fa-stack-2x"></i>
        <i class="fab fa-facebook-f fa-stack-1x"></i>
      </span>
    </li>
    <li class="list-inline-item px-0">
      <span class="fa-stack fa-1x">
        <i class="far fa-circle fa-stack-2x"></i>
        <i class="fab fa-twitter fa-stack-1x"></i>
      </span>
    </li>
    <li class="list-inline-item px-0">
      <span class="fa-stack fa-1x">
        <i class="far fa-circle fa-stack-2x"></i>
        <i class="fab fa-youtube fa-stack-1x"></i>
      </span>
    </li>
    <li class="list-inline-item px-0">
      <span class="fa-stack fa-1x">
        <i class="far fa-circle fa-stack-2x"></i>
        <i class="fab fa-instagram fa-stack-1x"></i>
      </span>
    </li>
  </ul>
</div>