<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php wp_title(''); ?></title>
    <?php wp_head(); ?>
  </head>
  <?php
      if(is_front_page() ):
        $knockers_classes = array('knockers-class','my-class');
      else:
        $knockers_classes = array('no-knockers-class');
      endif;

  ?>
  <body <?php body_class( $knockers_classes );?>>
    <header class="container">
      <div class="row">
        <div class="">
          <nav class="navbar navbar-default">
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">knockers Theme</a>
              </div>
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php
                      wp_nav_menu(array(
                        'theme_location'=>'primary',
                        'container' => 'ul',
                        'menu_class' => 'nav navbar-nav navbar-right'

                      )
                    );
                 ?>
              </div>
            </div>
          </nav>
        </div>
        <!-- <div class="search-form-container">
          <?php get_search_form(); ?>


        </div> -->
        <div class="header_image ">
          <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width;?>" alt="" />
        </div>
      </div>
    </header>
