
<template>
   <div>
      <div class="filter-container">
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  Filters
               </div>
            </div>
         </div>
      </div>
      <div class="container">
         <div v-if="loading === true"><h2>Loading....</h2></div>
         <GiftGuideItem v-for="post of posts" v-bind:key="post.id" v-bind:post="post" style="margin-bottom: 12px; overflow: hidden"></GiftGuideItem>
      </div>
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

<style lang="css">
   .filter-container {
      background-color: #005E9A;
      color: #fff;
      padding: 12px 0;
   }
</style>

