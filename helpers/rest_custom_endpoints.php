<?php
add_action( 'rest_api_init', function () {
  register_rest_route( 'get_tags_in_use/v1', '/category/(?P<id>\d+)', array(
    'methods' => 'GET',
    'callback' => 'get_tags_in_use',
  ) );
} );

function get_tags_in_use(WP_REST_Request $request) {
  $category_ID = $request->get_param('id');
  $unique_related_tags    = array();

  $related = new WP_Query( array(
    'post_type'     => 'post',
    'posts_per_page'=> -1,
    'fields'        => 'ids',
    'cat '          => $category_ID,
  ) );

  if( $related->have_posts() ) {
    foreach( $related->posts as $post_id ) {
      $tags = wp_get_post_tags( $post_id );
      if( ! empty( $tags ) ) {
        foreach( $tags as $tag ) {
          if( empty( $unique_related_tags ) || ! array_key_exists( $tag->term_id, $unique_related_tags ) ) {
            $unique_related_tags[ $tag->term_id ] = $tag->name;
          }
        }
      }
    }

    wp_reset_postdata();
  }

  return $related->posts;
}