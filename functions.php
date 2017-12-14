<?php
  function knockers_script_enqueue() {
    //引入css
    wp_enqueue_style('bootstrapcss', get_template_directory_uri() . '/css/bootstrap.min.css', array(),'1.0.0','all');
    wp_enqueue_style('bxslidercss', get_template_directory_uri() . '/js/bxslider/jquery.bxslider.css', array(),'1.0.0','all');
    wp_enqueue_style('kkcss', get_template_directory_uri() . '/css/knockers.css', array(),'1.0.0','all');
    // 引入js
    wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery-1.11.3.min.js', array(),'1.0.0',true);
    wp_enqueue_script('bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array(),'1.0.0',true);
 wp_enqueue_script('matchheightjs', get_template_directory_uri() . '/js/jquery-match-height.js', array(),'1.0.0',true);    
 wp_enqueue_script('bxsliderjs', get_template_directory_uri() . '/js/bxslider/jquery.bxslider.min.js', array(),'1.0.0',true);
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

//首頁左邊slidr區塊
add_shortcode( 'list-posts-home', 'home_post_listing_shortcode' );
function home_post_listing_shortcode( $atts ) {
// $url = get_the_post_thumbnail_url($post->ID);
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'post',
        'color' => 'blue',
        'posts_per_page' => 6,
        'order' => 'DSC',
        'orderby' => 'title',
	'category_name' =>'featured-case',

    ) );
    if ( $query->have_posts() ) { ?>
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <li class="bxslider_item" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<img src="<?php the_post_thumbnail_url(); ?>"/>
                <h2><?php the_title(); ?></h2>
                <p><?php the_content();?></p>

            </li>
            <?php endwhile;
            wp_reset_postdata(); ?>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
// 首頁右邊作品區塊
add_shortcode( 'list-posts-right-block', 'home_rigth_post_listing_shortcode' );
function home_rigth_post_listing_shortcode( $atts ) {
// $url = get_the_post_thumbnail_url($post->ID);
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'post',
        'color' => 'blue',
        'posts_per_page' => 4,
        'order' => 'DSC',
        'orderby' => 'title',
        'category_name' =>'featured-case',

    ) );
    if ( $query->have_posts() ) { ?>
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <li class="mt15  right_block_item row" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="col-sm-4  item_img"><img src="<?php the_post_thumbnail_url(); ?>"/></div>
                <div class="item_content col-sm-8" >
		<h2><?php the_title(); ?></h2>
                <p><?php the_content();?></p>
		</div>

            </li>
            <?php endwhile;
            wp_reset_postdata(); ?>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
//首頁下方夥伴與客戶區塊
add_shortcode( 'home_p_and_c_block', 'home_p_and_c_post_listing_shortcode' );
function home_p_and_c_post_listing_shortcode( $atts ) {
// $url = get_the_post_thumbnail_url($post->ID);
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'post',
        'color' => 'blue',
        'posts_per_page' => -1,
        'order' => 'DSC',
        'orderby' => 'title',
        'category_name' =>'p-and-c',

    ) );
    if ( $query->have_posts() ) { ?>
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <li class="col-sm-2 col-xs-6 mt15" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="p_and_c_img"><img class="img-circle img-responsive" src="<?php the_post_thumbnail_url(); ?>"/></div>
            </li>
            <?php endwhile;
            wp_reset_postdata(); ?>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}




// code生成post
function wporg_custom_post_type()
{
    register_post_type('wporg_product',
                       [
                           'labels'      => [
                               'name'          => __('Products'),
                               'singular_name' => __('Product'),
                           ],
                           'public'      => true,
                           'has_archive' => true,
                       ]
    );
}
add_action('init', 'wporg_custom_post_type');

// code 建立分類
function wporg_register_taxonomy_course()
{
    $labels = [
        'name'              => _x('Courses', 'taxonomy general name'),
'singular_name'     => _x('Course', 'taxonomy singular name'),
'search_items'      => __('Search Courses'),
'all_items'         => __('All Courses'),
'parent_item'       => __('Parent Course'),
'parent_item_colon' => __('Parent Course:'),
'edit_item'         => __('Edit Course'),
'update_item'       => __('Update Course'),
'add_new_item'      => __('Add New Course'),
'new_item_name'     => __('New Course Name'),
'menu_name'         => __('Course'),
];
$args = [
'hierarchical'      => true, // make it hierarchical (like categories)
'labels'            => $labels,
'show_ui'           => true,
'show_admin_column' => true,
'query_var'         => true,
'rewrite'           => ['slug' => 'course'],
];
register_taxonomy('course', ['wporg_product'], $args);
}
add_action('init', 'wporg_register_taxonomy_course');


//改寫content block & only_img
function knockers_custom_post_widget_shortcode($atts) {
        extract(shortcode_atts(array(
                'id' => '',
                'slug' => '',
                'class' => 'content_block',
                'suppress_content_filters' => 'yes',
                'title' => 'no',
                'title_tag' => 'h3',
                'only_img' => 'no',
        ), $atts));

        if ($slug) {
                $block = get_page_by_path($slug, OBJECT, 'content_block');
                if ($block) {
                        $id = $block->ID;
                }
        }

        $content = "";

        if ($id != "") {
                $args = array(
                        'post__in' => array($id),
                        'post_type' => 'content_block',
                );

                $content_post = get_posts($args);

                foreach ($content_post as $post):
                        $content .= '<div class="' . esc_attr($class) . '" id="custom_post_widget-' . $id . '">';
                        if ($title === 'yes') {
                                $content .= '<' . esc_attr($title_tag) . '>' . $post->post_title . '</' . esc_attr($title_tag) . '>';
                        }
                        if ($suppress_content_filters === 'no') {
                                $content .= apply_filters('the_content', $post->post_content);
                        } else {
                                if (has_shortcode($post->post_content, 'content_block') || has_shortcode($post->post_content, 'ks_content_block')) {
                                        $content .= $post->post_content;
                                } else {
                                        $content .= do_shortcode($post->post_content);
                                }
                        }
                        $content .= '</div>';
                endforeach;
        }
        if ($only_img == "yes") {
                $featured_image = get_the_post_thumbnail_url($id, 'full');
                return $featured_image ? $featured_image : $content;
        }
        return $content;
}
add_shortcode('ks_content_block', 'knockers_custom_post_widget_shortcode');
