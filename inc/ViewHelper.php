<?php

class ViewHelper{
  public static function post_grid(){
    $post_query = new WP_Query( array(
      'per_page' => 6,
      'post_type' => 'post'
    ) );
    if( $post_query->have_posts() ){
      ?>
      <div class="post-grid-wrapper">
          <?php while( $post_query->have_posts() ){
            $post_query->the_post();
            self::post_grid_item();
          } ?>
      </div>
      <?php
    }
    wp_reset_postdata();
  }
  public static function post_grid_item(){
    ?>
      <div class="grid-item" id="grid-<?php echo get_the_ID(); ?>">
        <figure class="grid-item-thumbnail">
          <?php the_post_thumbnail( get_the_ID(),'full',array( 'class'=>'grid-image' ) ); ?>
        </figure>
        <date class="grid-item-pub-date">
          <?php echo get_the_date(); ?>
        </date>
        <h3 class="grid-item-title"><a class="grid-item-title-link" href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h3>
      </div>
    <?php
  }
}
