
<template>
<transition appear>
   <div class="item-instance" v-bind:id="item.item_link" v-lazy-container="{ selector: 'img' }">

         <div class="row">
            <div class="col-sm-5">
               <div class="item-image">
                  <a v-bind:href="item.item_purchase_url"><img v-bind:data-item-url="item.item_link" v-bind:data-item-title="item.title" v-bind:data-src="item.item_image" /></a>
               </div>
            </div>
            <div class="col-sm-7">
               <div class="item-text">
                  <h2 class="item-name"><a v-bind:href="item.item_purchase_url" v-html="item.title"></a></h2>
                  <div class="item-desc" v-html="item.item_description"></div>
                  <div class="why-to-buy" v-if="item.why_to_buy">Why to buy: <span v-html="item.why_to_buy"></span></div>
                  <div class="item-price">$<span v-html="item.item_price"></span></div>
                  <a class="btn btn-blue btn-item-buy" v-bind:href="item.item_purchase_url">Buy</a>
               </div>
            </div>
         </div>

         <div v-if="item.item_editors_pick === 'yes'" class="gg-badge gg-badge-editor"><img v-bind:data-src="item.editors_pick_badge" alt="Editor's Pick"></div>

   </div>
</transition>
</template>

<script>
// NOTE (ts): the <img> tag has a couple of data-attr that we use to pass along data
// to the Google Tag Manager Virtual Pageview event; see main.js
module.exports = {
   props: ['item'],
   data: function() {
      return {}
   },
}
</script>
