
var app = new Vue({
  el: '#app',
  data: {
    posts: [],
    filter: '',
    categories: [],
    catFilter:'',
    showFilter:'',
    openFilter1:true,
    closeFilter1:''
  },
  created: function() {
    // var self = this
    // axios.get('/wp-json/wp/v2/posts', {
    //
    //   })
    //   .then(function(response) {
    //     // 將所有data秀到posts裡面
    //     self.posts = response.data
    //
    //     // // self.posts = response.data
    //     // 根據sticky文章置頂來抓取
    //     // for (var i = 0; i < response.data.length; i++) {
    //     //   if(response.data[i].sticky==true){
    //     //     self.posts.push({
    //     //       id:response.data[i].id,
    //     //       content:response.data[i].content.rendered,
    //     //       title:response.data[i].title.rendered,
    //     //       link:response.data[i].link,
    //     //       tags:response.data[i].tags,
    //     //       date:response.data[i].date,
    //     //       fi_300x180:response.data[i].fi_300x180,
    //     //       fi_medium:response.data[i].fi_medium,
    //     //       cats:response.data[i].cats
    //     //     })
    //     //   }
    //     //
    //     // }
    //     //
    //     // var posts = self.posts
    //     // console.log(posts.featured_media);
    //   })
    this.getPosts()
    this.getCats()

  },
  watch: {
      catFilter: 'getPosts'
  },

  methods: {
    getPosts: function(){
      axios.get('/wp-json/wp/v2/posts?per_page=3')
        .then(response => response.data)
        .then(data => Vue.set(this, 'posts', data));
    },
    getCats: function(){
      axios.get('/wp-json/wp/v2/categories')
        .then(response => response.data)
        .then(data => Vue.set(this, 'categories', data));

    },
    openFilter: function(){
      this.showFilter=true
      this.closeFilter1=true
      this.openFilter1=false
    },
    closeFilter:function(){
      this.showFilter=false
      this.openFilter1=true
      this.closeFilter1=false

    }
  },
  computed: {
    // 針對post title.rendered 去做filter的動作
    postFilter(){
    		var self = this
    		return this.posts.filter(function(post){
    			return post.title.rendered.toLowerCase().includes(self.filter.toLowerCase());
    		});
    	},
      // catFilter(){
      //   return this.categories.filter(function(category){
      //
      //     return category.name;
      //   });
      // }
  }


})
