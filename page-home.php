<?php get_header();?>

<div id="content" class="container content">

  <h2><img class="img-responsive" src="/wp-content/themes/knockers/images/title.png" alt=""></h2>
  <div class="row">
      <div class="col-sm-6 mt15">
        <img class="img-responsive" src="/wp-content/themes/knockers/images/01.jpg" alt="">
      </div>
      <div class="col-sm-6 mt15">
        <img class="img-responsive" src="/wp-content/themes/knockers/images/02.jpg" alt="">
      </div>
      <div class="col-sm-6 mt15">
        <img class="img-responsive" src="/wp-content/themes/knockers/images/03.jpg" alt="">
      </div>
      <div class="col-sm-6 mt15">
        <img class="img-responsive" src="/wp-content/themes/knockers/images/04.jpg" alt="">
      </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <img class="img-responsive" src="/wp-content/themes/knockers/images/contact.png" alt="">
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <?php echo do_shortcode( '[contact-form-7 id="65" title="聯絡表單 1"]' );?>

    </div>
  </div>
</div>


<!--/content-->




<?php  get_footer(); ?>
