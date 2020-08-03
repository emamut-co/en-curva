<?php get_header();

$sticky = get_option( 'sticky_posts' );

$sliderArray = new WP_Query(
  array(
    'post__in'            => $sticky,
    'posts_per_page'      => -1,
    'orderby'             => 'rand',
    'ignore_sticky_posts' => 1,
    'tax_query' => array( array(
      'taxonomy' => 'post_format',
      'field' => 'slug',
      'terms' => array('post-format-aside', 'post-format-gallery', 'post-format-link', 'post-format-image', 'post-format-quote', 'post-format-status', 'post-format-audio', 'post-format-chat', 'post-format-video'),
      'operator' => 'NOT IN'
    ) )
  )
);

$first = true; ?>

<div class="row">
  <div class="col">
    <?php if ( isset($sticky[0]) ): ?>
    <div id="main-carousel" class="carousel slide carousel-fade" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php for ( $cont == 0; $cont < sizeof($sliderArray->posts); $cont++ ): ?>
        <li data-target="#main-carousel" data-slide-to="<?php echo $cont ?>" <?php if ( $cont == 0 ) echo 'class="active"' ?>></li>
        <?php endfor ?>
      </ol>
      <div class="carousel-inner">
        <?php while ( $sliderArray->have_posts() ) : $sliderArray->the_post(); ?>
        <div class="carousel-item<?php if($first) echo ' active' ?>">
          <?php the_post_thumbnail('large', ['class' => 'd-block mx-auto w-100 h-auto']) ?>
          <div class="carousel-caption d-none d-md-block">
            <a href="<?php the_permalink() ?>"><h1 class="text-800"><?php the_title() ?></h1></a>
          </div>
        </div>
          <?php $first = false;
        endwhile ?>
        <a class="carousel-control-prev" href="#main-carousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#main-carousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
    <?php endif ?>
  </div>
</div>

<div class="row bg-section-1">
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-8">
        <h4 class="subtitle mb-3">EN NUESTRAS SECCIONES</h4>
        <div class="card-columns" id="our-sections">
          <?php $allPostsArray = new WP_Query(
            array(
              'post_status'       => 'publish',
              'posts_per_page'    => 11,
              'order'             => 'DESC',
              'post__not_in'      => $sticky,
              'category__not_in'  => 8,
              'orderby'           => 'ID',
              'tax_query'         => array( array(
                'taxonomy'  => 'post_format',
                'field'     => 'slug',
                'terms'     => array( 'post-format-aside', 'post-format-gallery', 'post-format-link', 'post-format-image', 'post-format-quote', 'post-format-status', 'post-format-audio', 'post-format-chat', 'post-format-video' ),
                'operator'  => 'NOT IN'
              ) )
            )
          );

          $cont = 0;
          while ( $allPostsArray->have_posts() ) : $allPostsArray->the_post(); ?>
            <div class="card shadow">
              <?php the_post_thumbnail('large', ['class' => 'card-img-top']) ?>
              <div class="card-body">
                <?php $categories = get_the_category();
                if (!empty($categories)) {
                  $termID = $categories[0]->term_id;
                  $categoryColor = get_field('color_text', 'term_'.$termID);
                  $categoryURL = get_category_link( $category[0]->term_id );
                } ?>
                <a href="<?php echo esc_url( $categoryURL ); ?>" class="category" style="font-weight: bold; color: <?php echo $categoryColor; ?>"><?php echo $categories[0]->name ?></a>
                <a href="<?php the_permalink() ?>"><h5 class="card-title text-dark text-800"><?php the_title() ?></h5></a>
              </div>
            </div>
            <?php
            unset($allPostsArray->posts[$cont]);
            if($cont == 2) break;
            $cont ++;
          endwhile ?>
        </div>
      </div>
      <div class="col-md-4">
        <h4 class="subtitle mb-3">LAS MÁS LEIDAS HOY</h4>
        <?php $mostViewedArray = new WP_Query(
          array(
            'meta_key'        => 'post_views_count',
            'orderby'         => 'meta_value_num',
            'posts_per_page'  => 3,
            'tax_query'       => array( array(
              'taxonomy' => 'post_format',
              'field' => 'slug',
              'terms' => array('post-format-aside', 'post-format-gallery', 'post-format-link', 'post-format-image', 'post-format-quote', 'post-format-status', 'post-format-audio', 'post-format-chat', 'post-format-video'),
              'operator' => 'NOT IN'
            ) )
          )
        );

        while ( $mostViewedArray->have_posts() ): $mostViewedArray->the_post() ?>
          <div class="card shadow mb-3">
            <div class="row no-gutters">
              <div class="col-md-4" style="object-fit: cover; object-position: center">
                <?php the_post_thumbnail('thumbnail', ['class' => 'card-img my-auto']) ?>
              </div>
              <div class="col-md-8">
                <div class="card-body py-1">
                  <?php $categories = get_the_category();
                  if (!empty($categories)) {
                    $termID = $categories[0]->term_id;
                    $categoryColor = get_field('color_text', 'term_'.$termID);
                    $categoryURL = get_category_link( $category[0]->term_id );
                  } ?>
                  <a href="<?php echo esc_url( $categoryURL ); ?>" class="category" style="font-weight: bold; color: <?php echo $categoryColor; ?>"><?php echo $categories[0]->name ?></a>
                  <a href="<?php the_permalink() ?>"><h5 class="card-title text-dark text-800 mb-0"><?php the_title() ?></h5></a>
                  <small class="card-text"><?php echo get_the_date( 'l, j M Y' ); ?></small>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile ?>
        <img src="<?php echo get_template_directory_uri() ?>/images/ads-sample.png" alt="" class="img-fluid">
        <h4 class="subtitle mt-4 mb-3">SÍGUENOS EN REDES</h4>
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
    </div>
  </div>
</div>

<div class="row bg-gray justify-content-center my-5">
  <div class="col-md-6 py-5">
    <h5 class="text-800">¡NEWSLETTER PARA AVENTUREROS!</h5>
    <p class="font-lato">Suscríbete al boletín En Curva para noticias, eventos y mucho más</p>
    <?php echo do_shortcode('[contact-form-7 html_id="newsletter-form" html_class="form-inline" title="Newsletter form 1"]') ?>
    <small id="emailHelp" class="form-text text-muted">Al suscribirte aceptas la <span class="font-weight-bold"><a href="#" class="text-dark mt-2">Política de Privacidad de En Curva</a></span></small>
  </div>
</div>

<?php
  $blogArray = new WP_Query(
    array(
      'cat'             => 8,
      'posts_per_page'  => 1
    )
  );
?>

<div class="row">
  <?php while ( $blogArray->have_posts() ): $blogArray->the_post(); $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' ); ?>
  <div class="col position-relative" id="blog-section" style="background: url('<?php echo $thumbnail[0]  ?>')">
    <div class="text-center p-5 caption">
      <?php $categories = get_the_category();
        if (!empty($categories)) {
          $termID = $categories[0]->term_id;
          $categoryColor = get_field('color_text', 'term_'.$termID);
          $categoryURL = get_category_link( $category[0]->term_id );
        } ?>
      <a href="<?php echo esc_url( $categoryURL ); ?>" class="category" style="font-weight: bold; color: <?php echo $categoryColor; ?>"><?php echo $categories[0]->name ?></a>
      <h1 class="text-800 mt-3"><?php the_title() ?></h1>
      <p class="mt-3"><strong>Con:</strong> <?php the_author() ?></p>
    </div>
  </div>
  <?php endwhile ?>
</div>

<div class="row bg-dark bg-section-2">
  <div class="container">
    <div class="row mt-5 pt-5">
      <div class="col">
        <h4 class="subtitle text-white mt-4 mb-3">TE PODRÍA INTERESAR</h4>
      </div>
    </div>
    <div class="row my-5 justify-content-between">
      <?php $cont = 1;
      while ( $allPostsArray->have_posts() ) : $allPostsArray->the_post(); ?>
        <div class="col-5 mx-4 my-3">
          <div class="card bg-transparent border-0 mb-3">
            <div class="row no-gutters">
              <?php if($cont % 2 == 0): ?>
              <div class="col-md-8">
                <div class="card-body text-white py-1">
                  <?php $categories = get_the_category();
                  if (!empty($categories)) {
                    $termID = $categories[0]->term_id;
                    $categoryColor = get_field('color_text', 'term_'.$termID);
                    $categoryURL = get_category_link( $category[0]->term_id );
                  } ?>
                  <a href="<?php echo esc_url( $categoryURL ); ?>" class="category" style="font-weight: bold; color: <?php echo $categoryColor; ?>"><?php echo $categories[0]->name ?></a>
                  <a href="<?php the_permalink() ?>"><h5 class="card-title text-white text-800 mb-0"><?php the_title() ?></h5></a>
                  <small class="card-text"><?php echo get_the_date( 'l, j M Y' ); ?></small>
                </div>
              </div>
              <div class="col-md-4" style="object-fit: cover; object-position: center">
                <?php the_post_thumbnail('thumbnail', ['class' => 'card-img rounded-circle my-auto']) ?>
              </div>
              <?php else: ?>
              <div class="col-md-4" style="object-fit: cover; object-position: center">
                <?php the_post_thumbnail('thumbnail', ['class' => 'card-img rounded-circle my-auto']) ?>
              </div>
              <div class="col-md-8">
                <div class="card-body text-white py-1">
                  <?php $categories = get_the_category();
                  if (!empty($categories)) {
                    $termID = $categories[0]->term_id;
                    $categoryColor = get_field('color_text', 'term_'.$termID);
                    $categoryURL = get_category_link( $category[0]->term_id );
                  } ?>
                  <a href="<?php echo esc_url( $categoryURL ); ?>" class="category" style="font-weight: bold; color: <?php echo $categoryColor; ?>"><?php echo $categories[0]->name ?></a>
                  <a href="<?php the_permalink() ?>"><h5 class="card-title text-white text-800 mb-0"><?php the_title() ?></h5></a>
                  <small class="card-text"><?php echo get_the_date( 'l, j M Y' ); ?></small>
                </div>
              </div>
              <?php endif;
              $cont ++ ?>
            </div>
          </div>
        </div>
      <?php endwhile ?>
    </div>
  </div>
</div>

<div class="row bg-orange justify-content-center py-5">
  <div class="col-md-6 py-5">
    <h5 class="text-800">¡NEWSLETTER PARA AVENTUREROS!</h5>
    <p class="font-lato">Suscríbete al boletín En Curva para noticias, eventos y mucho más</p>
    <?php echo do_shortcode('[contact-form-7 html_id="newsletter-form" html_class="form-inline" title="Newsletter form 1"]') ?>
    <small id="emailHelp" class="form-text text-muted">Al suscribirte aceptas la <span class="font-weight-bold"><a href="#" class="text-dark mt-2">Política de Privacidad de En Curva</a></span></small>
  </div>
</div>

<?php get_footer() ?>
