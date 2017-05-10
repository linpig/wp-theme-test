<?php
  function knockers_script_enqueue() {
    //引入css
    wp_enqueue_style('bootstrapcss', get_template_directory_uri() . '/css/bootstrap.min.css', array(),'1.0.0','all');
    wp_enqueue_style('kkcss', get_template_directory_uri() . '/css/knockers.css', array(),'1.0.0','all');
    // 引入js
    wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery-1.11.3.min.js', array(),'1.0.0',true);
    wp_enqueue_script('vuejs', get_template_directory_uri() . '/js/vue.min.js', array(),'1.0.0',true);
    wp_enqueue_script('axiosjs', get_template_directory_uri() . '/js/axios.min.js', array(),'1.0.0',true);
    wp_enqueue_script('vueaxiosjs', get_template_directory_uri() . '/js/vue-axios.min.js', array(),'1.0.0',true);
    wp_enqueue_script('router', get_template_directory_uri() . '/js/vue-router.min.js', array(),'1.0.0',true);
    wp_enqueue_script('bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array(),'1.0.0',true);
    wp_enqueue_script('customjs', get_template_directory_uri() . '/js/knockers.js', array(),'1.0.0',true);

  }
  // 執行引入css js
add_action('wp_enqueue_scripts','knockers_script_enqueue');
// 建立menu
function knockers_theme_setup() {
  add_theme_support('menus');
  register_nav_menu( 'primary', 'Primary Navigation' );
  register_nav_menu( 'secondary', 'Footer Navigation' );
}
// 執行建立menu funcu
add_action('init', 'knockers_theme_setup');
//建立外觀背景
add_theme_support('custom-background');
// 建立外觀頁首
add_theme_support( 'custom-header' );
// 建立特色圖片
add_theme_support( 'post-thumbnails' );
// 建立文章格式
add_theme_support('post-formats',array('aside','image','video'));
add_theme_support('html5',array('search-form'));

// 建立widget sidebar
function knockers_widget_setup(){

  register_sidebar(
    array(
      'name' => 'Sidebar',
      'id'   => 'sidebar-1',
      'class' => 'custom',
      'description' => 'Standard Sidebar',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' =>'</aside>',
      'before_title' =>'<h1 class="widget-title">',
      'after_title'  =>'</h1>',

    )

);

}
add_action('widgets_init','knockers_widget_setup');

if( function_exists('add_image_size')) {
  add_image_size('300x180' ,300 ,180,true);
}



add_filter( 'wp_title', 'wpdocs_hack_wp_title_for_home' );

/**
 * Customize the title for the home page, if one is not set.
 *
 * @param string $title The original title.
 * @return string The title to use.
 */
function wpdocs_hack_wp_title_for_home( $title )
{
  if ( empty( $title ) && ( is_home() || is_front_page() ) ) {
    $title = __( 'Home', 'textdomain' ) . ' | ' . get_bloginfo( 'description' );
  }
  return $title;
}



/*
|------------------------
| Prepare REST
|------------------------

*/

// 定義新的圖片欄位，並將它變成data

function prepare_rest($data,$post,$request) {
  $_data= $data->data;
  // Thumbnails
  $thumbnail_id = get_post_thumbnail_id( $post->ID );
  $thumbnail300x180 = wp_get_attachment_image_src( $thumbnail_id, '300x180' );
  $thumbnailMedium = wp_get_attachment_image_src( $thumbnail_id, 'medium' );
  //Categories
  $cats = get_the_category($post->ID);

  $_data['fi_300x180']= $thumbnail300x180[0];
  $_data['fi_medium']= $thumbnailMedium[0];
  $_data['cats']=$cats;
  $data->data = $_data;

  return $data;

}

add_filter('rest_prepare_post', 'prepare_rest', 10,3);


add_shortcode( 'list-posts-home', 'home_post_listing_shortcode' );
function home_post_listing_shortcode( $atts ) {
// $url = get_the_post_thumbnail_url($post->ID);
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'post',
        'color' => 'blue',
        'posts_per_page' => -1,
        'order' => 'DSC',
        'orderby' => 'title',
        'tag'=>'專案A,專案B'

    ) );
    if ( $query->have_posts() ) { ?>
        <ul class="info-listing list-unstyled">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <li class="col-sm-4" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <p><?php the_tags(); ?></p>

            </li>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </ul>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
