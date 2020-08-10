<div class="card mb-4 border-0">
  <div class="row no-gutters">
    <div class="col-md-4">
      <?php the_post_thumbnail(array(450), array('class' => 'card-img')) ?>
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <p class="card-text category" style="font-weight: bold; color: <?php echo $color_text; ?>"><?php echo single_cat_title( '', false ) ?></p>
        <h5 class="card-title text-dark text-800"><?php echo the_title() ?></h5>
        <p class="card-text"><?php echo the_excerpt() ?></p>
      </div>
    </div>
  </div>
</div>