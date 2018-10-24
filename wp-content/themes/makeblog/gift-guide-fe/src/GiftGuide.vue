
<template>
   <div class="gift-guide">
      <div class="filter-container">
         <div class="container">
            <div class="row">
               <div class="col-sm-12 filters">
                  <span><label>Filter By: </label></span>
                  <span>
                     <label for="category-select" class="sr-only sr-only-focusable">Categories</label>
                     <select name="category-select" id="category-select" v-model="filter_cat_model" v-on:change="filterChange">
                        <option v-for="option in categories" v-bind:key="option.value" v-bind:value="option.value">
                           {{ option.text }} {{ option.value }}
                        </option>
                     </select>
                  </span>
                  <span>
                     <label for="recipient-select" class="sr-only sr-only-focusable">Recipients</label>
                     <select name="recipient-select" id="recipient-select" v-model="filter_recip_model" v-on:change="filterChange">
                        <option v-for="option in recipients" v-bind:key="option.value" v-bind:value="option.value">
                           {{ option.text }} {{ option.value }}
                        </option>
                     </select>
                  </span>
                  <span>
                     <label for="sort-select" class="">Sort By</label>
                     <select name="sort-select" id="sort-select" v-model="sort_by_model" v-on:change="sortChange">
                        <option v-for="option in sort" v-bind:key="option.value" v-bind:value="option.value">
                           {{ option.text }}
                        </option>
                     </select>
                  </span>
                  <span>
                     <label for="sort-select" class="sr-only sr-only-focusable">Sort Dir</label>
                     <select name="sort-select" id="sort-select" v-model="sort_dir_model" v-on:change="sortChange">
                        <option v-for="option in sortDirDynamic()" v-bind:key="option.value" v-bind:value="option.value">
                           {{ option.text }}
                        </option>
                     </select>
                  </span>
               </div>
            </div>
         </div>
      </div>

      <div class="container item-list">
         <div v-if="loading === true"><h2>Loading....</h2></div>
         <p>{{ postsDisplayed() }} Results</p>
         <transition-group name="list" tag="div">
            <GiftGuideItem v-for="post in visiblePosts" v-bind:key="post._id" v-bind:post="post"></GiftGuideItem>
         </transition-group>
         <button class="btn btn-blue btn-load-more" v-if="showLoadButton()" v-on:click="loadMore">Load More</button>
      </div>
   </div>
</template>

<script>

const axios = require('axios');
const GiftGuideItem = require('./GiftGuideitem.vue');
const SortMethods = require('./sortMethods.js');

module.exports = {
   data: function() {
      return {
         loading: true,
         filter_cat_model: '',
         filter_recip_model: '',
         sort_by_model: '',
         sort_dir_model: '',
         filters: {},
         categories: [],
         recipients: [],
         sort: [
            {
               "value": "0",
               "text": "Name"
            },
            {
               "value": "1",
               "text": "Price"
            },
         ],
         sortDir: {
            "0" : [ // for "Name"
               {
                  "value": "0",
                  "text": "A to Z"
               },
               {
                  "value": "1",
                  "text": "Z to A"
               }
            ],
            "1" : [ // for "Price"
               {
                  "value": "0",
                  "text": "Low to High"
               },
               {
                  "value": "1",
                  "text": "High to Low"
               }
            ]
         },
         origPosts: [], // this is our internal, complete list; it doesn't get displayed
         posts: [], // this is a mutable copy of the list that gets filtered & sorted
         visiblePosts: [], // this is the visble posts
         postLimit: 12
      }
   },
   created: function() {
      var _self = this;
      this.loading = true;
            _self.filter_cat_model = 0;
            _self.filter_recip_model = 0;
            _self.sort_by_model = 0;
            _self.sort_dir_model = 0;
      //axios.get('/wp-json/wp/v2/posts')
      axios.get('/wp-content/themes/makeblog/gift-guide-fe/src/categories.json')
         .then(function (response) {
            //console.log(response.data);
            _self.categories = response.data.categories;
            _self.loading = false;
            //console.log( _self.categories);
         })
         .catch(function (error) {
            console.log(error);
            _self.loading = false;
         });

      axios.get('/wp-content/themes/makeblog/gift-guide-fe/src/recipients.json')
         .then(function (response) {
            //console.log(response.data);
            _self.recipients = response.data.recipients;
            _self.loading = false;
            //console.log( _self.recipients);
         })
         .catch(function (error) {
            console.log(error);
            _self.loading = false;
         });

      axios.get('/wp-content/themes/makeblog/gift-guide-fe/src/gift_guide_json.json')
         .then(function (response) {
            //console.log(response.data);
            _self.origPosts = response.data;
            _self.posts = _self.origPosts;
            _self.loading = false;
            _self.sortPosts('name','asc');
            _self.showPosts();
         })
         .catch(function (error) {
            console.log(error);
            _self.loading = false;
         });
   },
   components: {
      'GiftGuideItem': GiftGuideItem
   },
   methods : {
      sortPosts: function(mode, dir) {
         //this.origPosts.sort(SortMethods[mode][dir]);
         this.posts.sort(SortMethods[mode][dir]);
      },
      sortChange: function() {
         var mode = {
            0: 'name',
            1: 'price'
         }
         var dir = {
            0: 'asc',
            1: 'desc'
         }
         //console.log(mode[this.sort_by_model], dir[this.sort_dir_model]);
         this.sortPosts(mode[this.sort_by_model], dir[this.sort_dir_model]);
         this.showPosts();
      },
      filterChange: function() {
         //console.log(this.filter_cat_model, this.filter_recip_model);
         var _self = this,
            filteredPosts;
         // If both category and recipient have '0', just show the whole (original) list
         if(_self.filter_cat_model === 0 && _self.filter_recip_model === 0) {
            this.posts = this.origPosts;
         } else {
            filteredPosts = this.origPosts.filter(function(obj) {
               // this is the case for all categories, but a specific recipient
               if(_self.filter_cat_model === 0 && _self.filter_recip_model > 0) {
                  return obj.item_recipients.indexOf(_self.filter_recip_model) > -1;
               }
               // this is the case for all recipients, but a specific category
               else if(_self.filter_cat_model > 0 && _self.filter_recip_model === 0) {
                  return obj.item_categories.indexOf(_self.filter_cat_model) > -1;
               }
               // this is the case for a specific category, and a specific recipient
               else {
                  return obj.item_categories.indexOf(_self.filter_cat_model) > -1 && obj.item_recipients.indexOf(_self.filter_recip_model) > -1;
               }
            });
            this.posts = filteredPosts;
            this.showPosts();
         }
      },
      showPosts: function() {
         this.visiblePosts = this.posts.slice(0,this.postLimit);
      },
      postsDisplayed: function() {
         return this.visiblePosts.length;
      },
      showLoadButton: function() {
         return this.visiblePosts.length < this.posts.length;
      },
      loadMore: function() {
         this.postLimit += 12;
         this.showPosts();
      },
      sortDirDynamic: function() {
         return this.sortDir[this.sort_by_model];
      }
   }
}
</script>



<style>
.list-item {
  display: inline-block;
  margin-right: 10px;
}
.list-enter-active, .list-leave-active {
  transition: all 1s;
}
.list-enter, .list-leave-to /* .list-leave-active below version 2.1.8 */ {
  opacity: 0;
  transform: translateY(30px);
}
.list-move {
  transition: transform 1s;
}
</style>
