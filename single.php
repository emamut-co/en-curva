<?php get_header() ?>

  <div class="container w-75 px-5">
    <div class="row mt-5 pt-4">
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <div class="col">
            <span><?php the_category(' | ') ?></span>
            <h1 class="title"><?php the_title() ?></h1>
          </div>
          <div class="row mt-2">
            <div class="col">
              <?php the_post_thumbnail('large', ['class' => 'd-block mx-auto img-fluid']) ?>
            </div>
          </div>
        <?php endwhile ?>
      <?php endif ?>
    </div>
  </div>

<?php get_footer() ?>