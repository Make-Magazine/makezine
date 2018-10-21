
<template>
   <div>
      <div>Filters</div>
      <div>
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
         posts: []
      }
   },
   created: function() {
      axios.get('/wp-json/wp/v2/posts')
         .then(response => {
            console.log(response.data);
            this.posts = response.data
         })
   },
   components: {
      'GiftGuideItem': GiftGuideItem
   }
}
</script>
