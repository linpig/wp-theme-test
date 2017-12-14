<?php get_header();?>

<div id="content" class="container-fluid content">
  <div class="row m_b_40"   style="dispaly:flex;">
    <div class="col-sm-6 no_padding home_block_left" style="background:url('<?php echo do_shortcode('[ks_content_block id=24 only_img=yes]');?>');background-repeat: no-repeat; background-size: cover; ">
	<?php echo do_shortcode('[content_block id=24]');?>

    </div>
    <div class="col-sm-6 no_padding home_block_right">
	<div class="right_img"><img src="<?php echo do_shortcode('[ks_content_block id=27 only_img=yes]');?>"></div>
	<div class="right_img"><img src="<?php echo do_shortcode('[ks_content_block id=30 only_img=yes]');?>"></div>
    </div>
</div>

<div class="container m_b_40">
<div class="row">

	<div class="col-sm-6">
		<ul class="bxslider">
		<?php echo do_shortcode('[list-posts-home]');?>
		</ul>
	</div>


	<div class="col-sm-6">
		<ul class="case_list">
		<?php echo do_shortcode('[list-posts-right-block]');?>
		</ul>
	</div>
</div>
<!--/row-->
</div>
<!--/container-->

<!--技術服務區塊-->
<div class="container-fluid no_padding m_b_40">

	<div class="row">
		<?php echo do_shortcode('[ks_content_block id=61]');?>
	</div>

</div>

<!--/夥伴與客戶區塊-->
<div class="container p_and_c_wrap">
<h2 class="m_b_40">親愛的夥伴與客戶</h2>
 <ul class="p_and_c_list row">
<?php echo do_shortcode('[home_p_and_c_block]');?>
</ul>
<!--/row-->
</div>
<!--/container-->
</div>
<!--/content-->




<?php  get_footer(); ?>
