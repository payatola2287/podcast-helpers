<?php
/*
 *  Plugin Name: Website Helper Functions
 *  Description: helper functions that built the podcast elements of the website. This only includes the shortcodes used to build the podcast pages: the podcast list, the podcast pages sidebar. Please use this as the site is currently using a parent theme. The purpose of this plugin is to add modifications for the site due to lack of child theme.
 * Author: Slapshot Studio Dev Team
 * Author URI: http://slapshotstudio.com
 */

/*
 * @function sv_banner
 * @desc this displays the banner.
 */
function sv_banner( $atts ){
  $s_atts = shortcode_atts( array(
    'link' => '#',
    'link_text' => 'Read More',
    'background_image' => '',
    'title' => '',
    'hide_title' => true
  ),$atts );
  extract( $s_atts );
  ob_start();
  ?>
    <figure class="sv-banner">
      <?php if( $hide_title ): ?>
        <h3 class="sv-banner-title" >
          <?php echo $title; ?>
        </h3>
      <?php endif; ?>
      <a href="<?php echo $link; ?>" class="sv-banner-button" title="<?php echo $title; ?>">
        <span class="sv-banner-button-text"><?php echo $link_text; ?></span>
      </a>
    </figure>
  <?php
  return ob_get_clean();
}
/*
 * @function sv_search
 * @desc this displays the search form. This form is limited to podcasts only.
 */
function sv_podcast_search( $atts ){
  $s_atts = shortcode_atts( array(
    'placeholder' => 'Search...'
  ),$atts );
  extract( $s_atts );
  ob_start();
  ?>
    <form name="search" id="search" method="get" action="<?php home_url(); ?>" _lpchecked="1">
  		<input name="s" type="text" placeholder="<?php echo $placeholder; ?>" value="">
  		<input type="hidden" name="post_type" value="podcasts">
  		<a class="submit"><i class="entypo-search"></i></a>
  	</form>
  <?php
  return ob_get_clean();
}

function sv_podcasts_list( $atts ){
  $s_atts = shortcode_atts( array(
    'per_page' => 5,
    'post_type' => 'episode'
  ),$atts );
  extract( $s_atts );
  $q_query_args = array(
    'posts_per_page' => $per_page,
    'post_type' => $post_type,
    'paged' => ( get_query_var('page') ) ? get_query_var('page') : 1
  );
  $q_query = new WP_Query(
    $q_query_args
  );
  ob_start();
  if( $q_query->have_posts() ):
    ?>
      <div class="podcast-wrapper">
        <ul class="podcasts-list">
          <?php while( $q_query->have_posts() ): $q_query->the_post(); ?>
            <li class="podcast-wrapper" id="podcast-<?php get_the_ID(); ?>">
              <?php the_title(); ?>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
      <div class="podcasts-pagination-wrapper">
        <?php the_posts_pagination( array( 'mid_size' => 2 ) ); ?>
      </div>
    <?php
  else:
    ?>
    <h3 class="notice">
      No Episodes yet...
    </h3>
    <?php
  endif;
  wp_reset_postdata();
  return ob_get_clean();
}

//add_shortcode( 'sv_search','sv_podcast_search' );
//add_shortcode( 'sv_banner','sv_banner' );
add_shortcode( 'sv_podcasts_list','sv_podcasts_list' );
