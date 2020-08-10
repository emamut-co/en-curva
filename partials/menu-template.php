<div class="container-md px-0 fixed-top">
  <nav class="navbar navbar-expand-lg navbar-light bg-light" role="navigation" id="navbar-primary">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar-collapse" aria-controls="main-navbar-collapse" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'your-theme-slug' ); ?>">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="<?php echo get_site_url() ?>"><?php echo theme_get_custom_logo(); ?></a>
    <?php wp_nav_menu( array(
      'theme_location'    => 'primary',
      'depth'             => 2,
      'container'         => 'div',
      'container_class'   => 'collapse navbar-collapse',
      'container_id'      => 'main-navbar-collapse',
      'menu_class'        => 'nav navbar-nav ml-auto',
      'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
      'walker'            => new WP_Bootstrap_Navwalker()
    ) ); ?>
  </nav>
</div>