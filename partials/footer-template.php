<footer class="py-5">
  <div class="container">
    <div class="row justify-content-between border-bottom border-secondary pb-4">
      <div class="col-md-6 text-center text-md-left">
        <a href="<?php echo get_site_url() ?>" class="d-block"><?php echo theme_get_custom_logo(); ?></a>
      </div>
      <div class="col-md-6 text-center text-md-right">
        <ul class="list-inline mx-auto mt-4 mt-md-0">
          <li class="list-inline-item">
            <span class="fa-stack fa-1x">
              <i class="far fa-circle fa-stack-2x"></i>
              <i class="fab fa-facebook-f fa-stack-1x"></i>
            </span>
          </li>
          <li class="list-inline-item">
            <span class="fa-stack fa-1x">
              <i class="far fa-circle fa-stack-2x"></i>
              <i class="fab fa-twitter fa-stack-1x"></i>
            </span>
          </li>
          <li class="list-inline-item">
            <span class="fa-stack fa-1x">
              <i class="far fa-circle fa-stack-2x"></i>
              <i class="fab fa-youtube fa-stack-1x"></i>
            </span>
          </li>
          <li class="list-inline-item">
            <span class="fa-stack fa-1x">
              <i class="far fa-circle fa-stack-2x"></i>
              <i class="fab fa-instagram fa-stack-1x"></i>
            </span>
          </li>
        </ul>
      </div>
    </div>
    <div class="row pt-3 pt-md-5">
      <div class="col">
        <nav class="navbar navbar-expand-md navbar-light bg-light" role="navigation">
          <div class="container">
            <?php wp_nav_menu( array(
              'theme_location'    => 'footer',
              'depth'             => 1,
              'container'         => 'div',
              'container_id'      => 'footer-menu',
              'menu_class'        => 'nav navbar-nav mx-auto',
              'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
              'walker'            => new WP_Bootstrap_Navwalker()
            ) ); ?>
          </div>
        </nav>
      </div>
    </div>
  </div>
</footer>