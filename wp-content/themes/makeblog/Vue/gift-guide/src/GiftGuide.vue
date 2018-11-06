<template>
   <div ref="giftGuide" class="gift-guide hidden">

      <div class="filter-container">
         <div class="container">
            <div class="row">
               <div class="col-md-12 filters">
                  <label>Filter By: </label>
						<div class="select-section">
							<span class="select-container">
								<label for="category-select" class="sr-only sr-only-focusable">Categories</label>
								<v-select 
									name="category-select" id="category-select"
									v-model="filter_cat_model" 
									v-on:input="filterChange" 
									:searchable="false" 
									:options="categories">
								</v-select> 
							</span>
							<span class="select-container">
								<label for="recipient-select" class="sr-only sr-only-focusable">Recipients</label>
								<v-select 
									name="recipient-select" id="recipient-select"
									v-model="filter_recip_model" 
									v-on:input="filterChange" 
									:searchable="false" 
									:options="recipients"></v-select>
							</span>
						</div>
						<label for="sort-select">Sort By: </label>
						<div class="select-section">
							<span class="select-container">
								<v-select 
									name="sort-select" id="sort-select"
									v-model="sort_by_model" 
									v-on:input="sortChange" 
									:options="sort" 
									:searchable="false"></v-select>
							</span>
						</div>
               </div>
            </div>
         </div>
      </div>

      <div ref="itemList" class="container item-list">
		   <div class="row">
            <div class="col-sm-12 item-count">
               <p>{{ itemsAvailable() }} Items 
                  <span v-if="loading === true">
                     <transition appear>
                        <span class="initial-loading-indicator"> Loading... <i class="fa fa-spinner"></i></span>
                     </transition>
                  </span>
               </p>
				</div>
			</div>
         <transition-group name="list" tag="div">
            <div v-for="(item, index) in currentItems" v-bind:key="item.item_id" class="item-list-inner">
               <GiftGuideItem v-bind:item="item"></GiftGuideItem>
               <div v-if="insertAd(index)" class="dynamic-ad">
                  <div class="js-ad scroll-load" data-size="[[728,90],[970,90],[320,50]]" data-size-map="[[[1000,0],[[728,90],[970,90]]],[[800,0],[[728,90]]],[[0,0],[[320,50]]]]" data-pos="btf"></div>
               </div>
            </div>
         </transition-group>
         <div v-if="initialRenderComplete && itemsAvailable() < 1">Sorry, no items match the filters you've chosen.</div>

         <div ref="btt" v-if="showBTT" class="back-to-top"><a @click.prevent="backToTop" href="#" title="Back to Top"><span class="sr-only sr-only-focusable">Back to Top</span> <i class="fa fa-arrow-circle-up"></i></a></div>

      </div>

   </div>
</template>

<script>
// My suggestion is we move a function like this to global where we can just cover the most commonly used entities, but something like this would undoubtedly be useful in other areas as well
function decodeHTMLEntities(text) {  
    var entities = [
        ['amp', '&'],
        ['apos', '\''],
        ['#x27', '\''],
        ['#x2F', '/'],
        ['#39', '\''],
        ['#47', '/'],
        ['lt', '<'],
        ['gt', '>'],
        ['nbsp', ' '],
        ['quot', '"']
    ];

    for (var i = 0, max = entities.length; i < max; ++i) 
        text = text.replace(new RegExp('&'+entities[i][0]+';', 'g'), entities[i][1]);

    return text;
}
import Vue from 'vue';
import axios from 'axios';
import vSelect from 'vue-select';
import GiftGuideItem from './GiftGuideitem.vue';
import SortMethods from './sortMethods.js';
import './stickyFilters.js';
import VueScrollTo from 'vue-scrollto';
Vue.use(VueScrollTo, {
   container: "body",
   duration: 200,
   easing: "ease",
   offset: 0,
   force: true,
   cancelable: true,
   onStart: false,
   onDone: false,
   onCancel: false,
   x: false,
   y: true
})

module.exports = {
   data: function() {
      return {
         loading: true,
         filter_cat_model: {value: 0, label: 'All Categories'},
         filter_recip_model: {value: 0, label: 'All Recipients'},
         sort_by_model: {value: 0, label: 'Default'},
         categories: [],
         recipients: [],
         sort: [
            {
               "value": "0",
               "label": "Default"
            },
            {
               "value": "1",
               "label": "Price High - Low"
            },
            {
               "value": "2",
               "label": "Price Low - High"
            },
            {
               "value": "3",
               "label": "A - Z"
            },
            {
               "value": "4",
               "label": "Z - A"
            },
         ],
         origItems: [], // this is our internal, complete list; it doesn't get displayed
         currentItems: [], // this is a mutable copy of the list that gets filtered & sorted
         initialRenderComplete: false,
         scrolledOnce: false,
         postLimitInterval: 3,
         postLimit: 3,
         doAds: false,
         adFreq: 0,
         showBTT: false
      }
   },
   created: function() {
      var _self = this;
      this.loading = true;

      //axios.get('/wp-content/themes/makeblog/gift-guide-fe/src/categories.json')
      axios.get('/wp-json/wp/v2/gift_guide_category/')
         .then(function (response) {
            var catsParsed = [
               {
                  'value': 0,
                  'label': "All Categories"
               }
            ];
            response.data.forEach(function(el) {
				   var label = el.name;
               var thisCat = {
                  'value': el.id,
                  'label': decodeHTMLEntities(el.name)
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
            var recipsParsed = [
               {
                  'value': 0,
                  'label': "All Recipients"
               }
            ];
            response.data.forEach(function(el) {
               var thisCat = {
                  'value': el.id,
                  'label': decodeHTMLEntities(el.name)
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
            _self.origItems = response.data;
            _self.currentItems = _self.origItems;
            _self.itemsRendered();
         })
         .catch(function (error) {
            console.log(error);
            _self.loading = false;
         });

   },
   destroyed: function() {
      window.removeEventListener('scroll', this.handlePageScroll);
   },
   mounted: function() {
      this.$refs.giftGuide.classList.remove('hidden');
      this.setupDynAds();
      this.$nextTick(function() {

         window.addEventListener('scroll', this.handlePageScroll);
      });
   },
   components: {
      'GiftGuideItem': GiftGuideItem,
      'v-select': vSelect
   },
   methods : {
      sortItems: function() {
         this.loading = true;
         this.clearDynamicAds();
         var mode = {
            0: SortMethods['default'],
            1: SortMethods['price']['desc'],
            2: SortMethods['price']['asc'],
            3: SortMethods['name']['asc'],
            4: SortMethods['name']['desc']
         }
         this.currentItems.sort(mode[this.sort_by_model.value]);
         this.itemsRendered();
      },
      sortChange: function() {
         this.sortItems();
      },
      filterChange: function() {
         this.loading = true;
         this.clearDynamicAds();
         //console.log(this.filter_cat_model.value, this.filter_recip_model.value);
         var _self = this,
            filteredItems;
         // If both category and recipient have '0', just show the whole (original) list
         if(_self.filter_cat_model.value === 0 && _self.filter_recip_model.value === 0) {
            this.currentItems = this.origItems;
         } else {
            filteredItems = this.origItems.filter(function(obj) {
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
            this.currentItems = filteredItems;
         }
         this.sortItems();
         this.itemsRendered();
      },
      itemsRendered: function() {
         var _self = this;
         _self.scrollToItem();
         setTimeout(function(){
            // Manufacturing a slight delay before hiding the working indicator so it doesn't flicker
            _self.loading = false;
            if(!_self.initialRenderComplete) {
               _self.initialRenderComplete = true;
            }
         },1000);
         if(_self.initialRenderComplete) {
            this.refreshAds();
         }
      },
      itemsAvailable: function() {
         return this.currentItems.length;
      },
      scrollToItem: function() {
         var _self = this;
         this.$nextTick(function() {
            //console.log('next tick...');
            var hash = window.location.hash,
               element,
               duration = 200,
               options = {},
               cancelScroll;
            if(!_self.scrolledOnce && hash) {
               element = document.querySelector(hash);
               if(element) {
                  //console.log('Scroll to: ', hash, element);
                  cancelScroll = _self.$scrollTo(element, duration, options);
                  _self.scrolledOnce = true;
               }
            }
         });
      },
      handlePageScroll: function() {
         var top = document.documentElement.scrollTop || document.body.scrollTop,
            listHeight = this.$refs.giftGuide.clientHeight;
         //console.log(top);
         if(top > 400 && top < (listHeight-200)) {
            //console.log('Show BTT', top, listHeight);
            this.showBTT = true;
         } else {
            //console.log('Hide BTT');
            this.showBTT = false;
         }
      },
      backToTop: function() {
         var body = document.querySelector('body');
         //console.log('Back to Top...', body);
         VueScrollTo.scrollTo(body, 500);
      },
      clearDynamicAds: function() {
         var ads = document.querySelectorAll('.dynamic-ad');
         googletag.destroySlots(ads);
      },
      insertAd: function(idx) {
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
         this.adFreq = adFreq;
         if(this.adFreq > 0) {
            this.doAds = true;
            // NOTE (ts): this is (or should be) part of the encompassing page
            if(make) {
               window.setTimeout(function() {
                  make.gpt.loadDyn();
               }, 2000);
            }
         }
      }
   }
}
</script>