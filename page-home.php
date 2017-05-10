<?php get_header();?>

<div class="container">
  <div class="row">
    <h2>shortcode list</h2>
    <?php echo do_shortcode( '[list-posts-home]' ); ?>
  </div>

    <div id="app" >


          <div class="filter_wrap" >
            <div class="filter" v-if="showFilter">
              <h4>Filter by Name</h4>
              <input type="text" name="" v-model="filter">
            </div>

            <div class="container">
              <a @click="openFilter" v-if="openFilter1"  class="btn btn-primary open">開啟</a>
              <a @click="closeFilter" v-if="closeFilter1" class="btn btn-danger closef">關閉</a>
            </div>

          </div>


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

        <h1 class="text-center">Vue.js抓取WordPress api</h1>
        <div  class="wrap">
            <article v-for="post in postFilter " class="col-sm-4 post" >

              <a :href="post.link"><img :src="post.fi_medium" alt=""><h1>{{post.title.rendered}}</h1></a>
              <small v-for="category in post.cats">
                {{category.name}}
              </small>
              <span>{{post.date}}</span>
              <p v-html="post.excerpt.rendered"></p>
            </article>
        </div>
  </div>
  <div class="">
    <?php get_sidebar();?>
  </div>
</div>





<?php  get_footer(); ?>
