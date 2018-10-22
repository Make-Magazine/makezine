
<template>
   <div>
      <div class="filter-container">
         <div class="container">
            <div class="row">
               <div class="col-sm-12 filters">
                  <span><label>Filter By: </label></span>
                  <span>
                     <label for="category-select" class="sr-only sr-only-focusable">Categories</label>
                     <select name="category-select" id="category-select">
                        <option value="">All Categories</option>
                        <option value="">Welding</option>
                        <option value="">Tech</option>
                        <option value="">Lasers</option>
                     </select>
                  </span>
                  <span>
                     <label for="recipient-select" class="sr-only sr-only-focusable">Recipients</label>
                     <select name="recipient-select" id="recipient-select">
                        <option value="">All Recipients</option>
                        <option value="">Kids</option>
                        <option value="">Digital Fabricators</option>
                     </select>
                  </span>
                  <span>
                     <label for="sort-select" class="">Sort By</label>
                     <select name="sort-select" id="sort-select">
                        <option value="">Price</option>
                        <option value="">Name</option>
                     </select>
                  </span>
                  <span>
                     <label for="sort-select" class="sr-only sr-only-focusable">Sort Dir</label>
                     <select name="sort-select" id="sort-select">
                        <option value="">High to Low</option>
                        <option value="">Low to High</option>
                     </select>
                  </span>
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
