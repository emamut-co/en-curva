<?php get_header();

$do_not_duplicate = array();
$sticky = get_option( 'sticky_posts' );

$sliderArray = new WP_Query(
  array(
    'post__in'            => $sticky,
    'posts_per_page'      => -1,
    'orderby'             => 'rand',
    'ignore_sticky_posts' => 1
  )
);

$lastPostsArray = new WP_Query(
  array(
    'post_status'    => 'publish',
    'posts_per_page' => 3,
    'order'          =>'DESC',
    'post__not_in'   => $sticky,
    'orderby'        =>'ID'
  )
);

$mostViewedArray = new WP_Query(
  array(
    'meta_key' => 'post_views_count',
    'orderby' => 'meta_value_num',
    'posts_per_page' => 3
  )
  );

$first = true; ?>

<div class="row">
  <div class="col">
    <?php if ( isset($sticky[0]) ): ?>
    <div id="main-carousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php for ( $cont == 0; $cont < sizeof($sliderArray->posts); $cont++ ): ?>
        <li data-target="#main-carousel" data-slide-to="<?php echo $cont ?>" <?php if ( $cont == 0 ) echo 'class="active"' ?>></li>
        <?php endfor ?>
      </ol>
      <div class="carousel-inner">
        <?php while ( $sliderArray->have_posts() ) : $sliderArray->the_post(); $do_not_duplicate[] = get_the_ID(); ?>
        <div class="carousel-item<?php if($first) echo ' active' ?>">
          <?php the_post_thumbnail('large', ['class' => 'd-block mx-auto w-100 h-auto']) ?>
          <div class="carousel-caption d-none d-md-block">
            <a href="<?php the_permalink() ?>"><h1 class="text-black"><?php the_title() ?></h1></a>
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
<div class="container">
  <div class="row mt-5">
    <div class="col-md-8">
      <h4 class="subtitle mb-3">EN NUESTRAS SECCIONES</h4>
      <div class="card-columns" id="our-sections">
        <?php $first = true;
        while ( $lastPostsArray->have_posts() ) : $lastPostsArray->the_post(); $do_not_duplicate[] = get_the_ID(); ?>
          <div class="card">
            <?php the_post_thumbnail('large', ['class' => 'card-img-top']) ?>
            <div class="card-body">
              <?php $categories= get_the_category();
              if (!empty($categories)) {
                $termID = $categories[0]->term_id;
                $categoryColor = get_field('color_text', 'term_'.$termID);
                $categoryURL = get_category_link( $category[0]->term_id );
              } ?>
              <a href="<?php echo esc_url( $categoryURL ); ?>" class="category" style="font-weight: bold; color: <?php echo $categoryColor; ?>"><?php echo $categories[0]->name ?></a>
              <a href="<?php the_permalink() ?>"><h5 class="card-title text-dark text-black"><?php the_title() ?></h5></a>
            </div>
          </div>
          <?php $first = false;
        endwhile ?>
      </div>
    </div>
    <div class="col-md-4">
      <h4 class="subtitle mb-3">LAS MÁS LEIDAS HOY</h4>
      <?php while ( $mostViewedArray->have_posts() ): $mostViewedArray->the_post() ?>
      <div class="card mb-3">
        <div class="row no-gutters">
          <div class="col-md-4">
            <?php the_post_thumbnail(array(100, 70), ['class' => 'card-img my-auto']) ?>
          </div>
          <div class="col-md-8">
            <div class="card-body py-1">
              <?php $categories= get_the_category();
              if (!empty($categories)) {
                $termID = $categories[0]->term_id;
                $categoryColor = get_field('color_text', 'term_'.$termID);
                $categoryURL = get_category_link( $category[0]->term_id );
              } ?>
              <a href="<?php echo esc_url( $categoryURL ); ?>" class="category" style="font-weight: bold; color: <?php echo $categoryColor; ?>"><?php echo $categories[0]->name ?></a>
              <a href="<?php the_permalink() ?>"><h5 class="card-title text-dark text-black mb-0"><?php the_title() ?></h5></a>
              <small class="card-text"><?php echo get_the_date( 'l, j M Y' ); ?></small>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile ?>
    </div>
  </div>
</div>

<?php get_footer() ?>