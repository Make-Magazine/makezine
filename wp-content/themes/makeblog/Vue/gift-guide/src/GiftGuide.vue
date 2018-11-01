<template>
   <div ref="giftGuide" class="gift-guide hidden">
      <div class="filter-container">
         <div class="container">
            <div class="row">
               <div class="col-sm-12 filters">
                  <span><label>Filter By: </label></span>
                  <span class="select-container">
                     <label for="category-select" class="sr-only sr-only-focusable">Categories</label>
							<v-select 
							   name="category-select" id="category-select"
								v-model="filter_cat_model" 
								v-on:input="filterChange"
								item-value="label"
								:searchable="false" 
								:options="returnCategories"
								:selected="option == '0'"
								label="label"
								placeholder="label">
								<option :value="0">All Categories</option>
							</v-select> <!-- placeholder isn't working either -->
                  </span>
                  <span class="select-container">
                     <label for="recipient-select" class="sr-only sr-only-focusable">Recipients</label>
							<v-select 
							   name="recipient-select" id="recipient-select"
								v-model="filter_recip_model" 
								v-on:input="filterChange" 
								:searchable="false"
								:options="returnRecipients"></v-select>
                  </span>
						<label for="sort-select" class="">Sort By: </label>
						<span class="select-container">
							<v-select 
								name="sort-select" id="sort-select"
								v-model="sort_by_model" 
								v-on:input="sortChange" 
								:searchable="false"
								:options="returnSortBy"></v-select>
					   </span>
               </div>
            </div>
         </div>
      </div>

      <div ref="itemList" class="container item-list">
		   <div class="row">
            <div class="col-sm-12 secondary-filters">
         		 <p>{{ postsAvailable() }} Items <span v-if="loading === true">
						 <transition appear>
							<span class="initial-loading-indicator"> Loading... <i class="fa fa-spinner"></i></span>
						 </transition>
                </span></p>
				</div>
			</div>
         <transition-group name="list" tag="div">
            <div v-for="(post, index) in visiblePosts" v-bind:key="post.item_id" class="item-list-inner">
               <GiftGuideItem v-bind:post="post"></GiftGuideItem>
               <div v-if="insertAd(index)" class="dynamic-ad">
                  <div class="js-ad scroll-load" data-size="[[728,90],[970,90],[320,50]]" data-size-map="[[[1000,0],[[728,90],[970,90]]],[[800,0],[[728,90]]],[[0,0],[[320,50]]]]" data-pos="btf"></div>
               </div>
            </div>
         </transition-group>
         <div v-if="initialRender && postsAvailable() < 1">Sorry, no items match the filters you've chosen.</div>
         <!-- <button ref="loadMoreBtn" class="btn btn-blue btn-load-more" v-if="showLoadButton()" v-on:click="loadMore">Load More</button> -->
      </div>
   </div>
</template>

<script>

const axios = require('axios');
import Vue from 'vue'
import vSelect from 'vue-select'
Vue.component('v-select', vSelect)
const GiftGuideItem = require('./GiftGuideitem.vue');
const SortMethods = require('./sortMethods.js');
require('./stickyFilters.js');

module.exports = {
   data: function() {
      return {
         loading: true,
         filter_cat_model: [],
         filter_recip_model: [],
         sort_by_model: '',
         sort_dir_model: '',
         categories: [],
         recipients: [],
         sort: [
            {
               "value": "0",
               "text": "Default"
            },
            {
               "value": "1",
               "text": "Price High - Low"
            },
            {
               "value": "2",
               "text": "Price Low - High"
            },
            {
               "value": "3",
               "text": "A - Z"
            },
            {
               "value": "4",
               "text": "Z - A"
            },
         ],
         origPosts: [], // this is our internal, complete list; it doesn't get displayed
         currentPosts: [], // this is a mutable copy of the list that gets filtered & sorted
         visiblePosts: [], // this is the visble posts NOTE (ts): this only applies for lazy-loading posts (not images), which is shut off now; so visible and current are now the same
         initialRender: false,
         postLimitInterval: 3,
         postLimit: 3,
         doAds: false,
         adFreq: 0
      }
   },
   created: function() {
      var _self = this;
      this.loading = true;
      _self.filter_cat_model.value = 0;
      _self.filter_recip_model.value = 0;
      _self.sort_by_model = 0;
      _self.sort_dir_model = 0;
      //axios.get('/wp-content/themes/makeblog/gift-guide-fe/src/categories.json')
		
      axios.get('/wp-json/wp/v2/gift_guide_category/')
         .then(function (response) {
            //console.log(response.data);
            var catsParsed = [
               {
                  'value': 0,
                  'text': "All Categories"
               }
            ];
            response.data.forEach(function(el) {
               var thisCat = {
                  'value': el.id,
                  'text': el.name
               };
               catsParsed.push(thisCat);
            });
            _self.categories = catsParsed;
         })
         .catch(function (error) {
            console.log(error);
            _self.loading = false;
         });
      //axios.get('/wp-content/themes/makeblog/gift-guide-fe/src/recipients.json')
      axios.get('/wp-json/wp/v2/gift_guide_recipient/')
         .then(function (response) {
            //console.log(response.data);
            var recipsParsed = [
               {
                  'value': 0,
                  'text': "All Recipients"
               }
            ];
            response.data.forEach(function(el) {
               var thisCat = {
                  'value': el.id,
                  'text': el.name
               };
               recipsParsed.push(thisCat);
            });
            _self.recipients = recipsParsed;
         })
         .catch(function (error) {
            console.log(error);
            _self.loading = false;
         });

      //axios.get('/wp-content/themes/makeblog/gift-guide-fe/src/gift_guide_json.json')
      axios.get('/wp-json/gift-guide/v1/items/')
         .then(function (response) {
            //console.log(response.data);
            _self.origPosts = response.data;
            _self.currentPosts = _self.origPosts;
            //_self.sortPosts('name','asc');
            _self.showPosts();
         })
         .catch(function (error) {
            console.log(error);
            _self.loading = false;
         });
   },
   mounted: function() {
      this.$refs.giftGuide.classList.remove('hidden');
      this.setupDynAds();
      //window.addEventListener('scroll', this.onScroll);
   },
   components: {
      'GiftGuideItem': GiftGuideItem
   },
	computed: {
	   returnCategories: function() {
		   return( this.categories.map(cat => ({label: unescape(cat.text), value: cat.value})) );
	   },
		returnRecipients: function() {
		   return( this.recipients.map(rec => ({label: unescape(rec.text), value: rec.value})) );
		},
		returnSortBy: function() {
		   return( this.sort.map(sor => ({label: unescape(sor.text), value: sor.value})) );
		},
	},
   methods : {
      sortPosts: function(mode) {
         this.loading = true;
         this.clearDynamicAds();
         var mode = {
            0: SortMethods['default'],
            1: SortMethods['price']['desc'],
            2: SortMethods['price']['asc'],
            3: SortMethods['name']['asc'],
            4: SortMethods['name']['desc']
         }
         this.currentPosts.sort(mode[this.sort_by_model.value]);
         this.showPosts();
      },
      sortChange: function() {
         this.sortPosts();
      },
      filterChange: function() {
         this.loading = true;
         this.clearDynamicAds();
         //console.log(this.filter_cat_model.value, this.filter_recip_model.value);
         var _self = this,
            filteredPosts;
         // If both category and recipient have '0', just show the whole (original) list
         if(_self.filter_cat_model.value === 0 && _self.filter_recip_model.value === 0) {
            this.currentPosts = this.origPosts;
         } else {
            filteredPosts = this.origPosts.filter(function(obj) {
               // this is the case for all categories, but a specific recipient
               if(_self.filter_cat_model.value === 0 && _self.filter_recip_model.value > 0) {
                  if(obj.item_recipients) {
                     return obj.item_recipients.indexOf(_self.filter_recip_model.value ) > -1;
                  }
               }
               // this is the case for all recipients, but a specific category
               else if(_self.filter_cat_model.value > 0 && _self.filter_recip_model.value  === 0) {
                  if(obj.item_categories) {
                     return obj.item_categories.indexOf(_self.filter_cat_model.value) > -1;
                  }
               }
               // this is the case for a specific category, and a specific recipient
               else {
                  if(obj.item_categories && obj.item_recipients) {
                     return obj.item_categories.indexOf(_self.filter_cat_model.value) > -1 && obj.item_recipients.indexOf(_self.filter_recip_model.value ) > -1;
                  }
               }
            });
            //console.log('showPosts: ', 'Orig: ', this.origPosts, 'Cur: ', this.currentPosts, 'Vis: ', this.visiblePosts);
            this.currentPosts = filteredPosts;
         }
         this.showPosts();
      },
      showPosts: function() {
         var _self = this;
         //this.visiblePosts = this.currentPosts.slice(0,this.postLimit); // if lazy loading whole items
         this.visiblePosts = this.currentPosts; // this will load all available items; images are lazy-loaded however
            //console.log('showPosts: ', 'Orig: ', this.origPosts, 'Cur: ', this.currentPosts, 'Vis: ', this.visiblePosts);
         setTimeout(function(){
            // Manufacturing a slight delay before hiding the working indicator so it doesn't flicker
            _self.loading = false;
            if(!_self.initialRender) {
               _self.initialRender = true;
            }
         },600);
         if(_self.initialRender) {
            this.refreshAds();
         }
      },
      postsAvailable: function() {
         return this.currentPosts.length;
      },
      postsDisplayed: function() {
         return this.visiblePosts.length;
      },
      showLoadButton: function() {
         return this.visiblePosts.length < this.currentPosts.length;
      },
      loadMore: function() {
         if(this.visiblePosts < this.currentPosts) {
            //console.log('Load more!');
            this.postLimit += this.postLimitInterval;
            this.showPosts();
         }
      },
      getItemsHeight: function() {
         return this.$refs.itemList.clientHeight;
      },
      onScroll: function() {
         
         // var scrollPos = this.getScrollTop(),
         //    listHeight = this.getItemsHeight();
         // if(this.initialRender && (scrollPos > 600) && (scrollPos+300) >= listHeight ) {
         //    //console.log('load more...', scrollPos, listHeight);
         //    //this.loadMore(); // if lazy loading whole items
         // }
      },
      getScrollTop: function() {
         return (window.pageYOffset !== undefined) ? window.pageYOffset
         : (document.documentElement || document.body.parentNode || document.body)
      	.scrollTop;
      },
      clearDynamicAds: function() {
         var ads = document.querySelectorAll('.dynamic-ad');
         googletag.destroySlots(ads);
      },
      insertAd: function(idx) {
         //console.log(idx);
         if(idx > 0) {
            return idx % this.adFreq === 0;
         } else {
            return false;
         }
      },
      refreshAds: function() {
         if(this.adFreq > 0) {
            this.setupDynAds();
         }
      },
      setupDynAds: function() {
         var outerCont = document.querySelector('.gift-guide-container'),
            adFreq = outerCont.getAttribute('data-ad-freq');
         //console.log(outerCont, adFreq);
         this.adFreq = adFreq;
         if(this.adFreq > 0) {
            this.doAds = true;
            // NOTE (ts): this is (or should be) part of the encompassing page
            if(make) {
               window.setTimeout(function() {
                  //console.log('set up ads...');
                  make.gpt.loadDyn();
               }, 2000);
            }
         }
      }
   }

}

</script>