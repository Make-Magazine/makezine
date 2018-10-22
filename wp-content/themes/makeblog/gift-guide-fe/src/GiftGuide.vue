
<template>
   <div class="container">
      <div class="row">
         <div class="col-sm-12">Filters</div>
      </div>
      <div v-if="loading === true">Loading....</div>
      <GiftGuideItem v-for="post of posts" v-bind:key="post.id" v-bind:post="post" style="margin-bottom: 12px; overflow: hidden"></GiftGuideItem>

   </div>
</template>

<script>
const axios = require('axios');
const GiftGuideItem = require('./GiftGuideitem.vue')
module.exports = {
   data: function() {
      return {
         loading: false,
         posts: []
      }
   },
   created: function() {
      this.loading = true;
      axios.get('/wp-json/wp/v2/posts')
         .then(response => {
            console.log(response.data);
            this.posts = response.data;
            this.loading = false;
         })
   },
   components: {
      'GiftGuideItem': GiftGuideItem
   }
}
</script>
