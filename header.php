<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <!-- <header id="header"  class="container-fluid header" style="background:url('<?php echo do_shortcode('[ks_content_block id=10 only_img=yes]');?>');background-repeat: no-repeat; background-size: cover; ">
      <div class="row">
          <nav class="navbar">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><img src="<?php echo do_shortcode('[ks_content_block id=17 only_img=yes]');?>"></a>
              </div>
              <div class="collapse navbar-collapse" id="navbar">
                <?php
                      wp_nav_menu(array(
                        'theme_location'=>'primary',
                        'container' => 'ul',
                        'menu_class' => 'nav navbar-nav pc_menu'

                      )
                    );
                 ?>
              </div>
          </nav>
	<div class="menu_bg"></div>
        <div class="text-center header_banner"><img src="<?php echo do_shortcode('[ks_content_block id=15 only_img=yes]');?>">
        </div><a href="/" class="blog text-center"><img src="<?php echo do_shortcode('[ks_content_block id=19 only_img=yes]');?>"></a>
        </div>
    </header> -->
