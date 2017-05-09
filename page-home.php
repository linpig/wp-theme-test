<?php get_header();?>
<h2>shortcode list</h2>
<div class="row">
  <?php echo do_shortcode( '[list-posts-home]' ); ?>
</div>
<div class="row">
  <div id="app">

      <div class="container">
        <h4>Filter by Name123</h4>
        <input type="text" name="" v-model="filter">

        <!-- <div class="by-category clearfix">
          <h4>Filter by Category</h4>
          <div class="radio-wrap">
            <input type="radio" value="" v-model="catFilter">
            <label for="">All</label>
          </div>

          <div class="radio-wrap" v-for="category in categories" v-if="category.name != '未分類'">
                           <input type="radio" :value="category.id" :id="category.id" :name="category.name" v-model="catFilter" >
                           <label :for='category.id'>{{ category.name }}</label>
                       </div>
        </div> -->
      </div>
      <h1 class="text-center">Vue.js抓取WordPress api</h1>
      <div  class="wrap row">
          <article v-for="post in postFilter " class="col-sm-4 post" >

            <a :href="post.link"><img :src="post.fi_medium" alt=""><h1>{{post.title.rendered}}</h1></a>
            <small v-for="category in post.cats">
              {{category.name}}
            </small>
            <span>{{post.date}}</span>
            <p v-html="post.content.rendered"></p>
          </article>
      </div>
  </div>


<div class="col-xs-12 col-sm-4">
  <?php get_sidebar();?>
</div>
<?php  get_footer(); ?>
