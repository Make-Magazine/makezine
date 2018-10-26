
<template>
<transition appear>
   <div class="item-instance" v-bind:id="post.slug">

         <div class="row">
            <div class="col-sm-5">
               <div class="item-image" v-lazy-container="{ selector: 'img' }">
                  <a v-bind:href="post.item_purchase_url"><img v-bind:data-src="post.item_image" /></a>
                  <div v-if="post.item_editors_pick === 'yes'" class="gg-badge gg-badge-editor"><img v-bind:data-src="post.editors_pick_badge" alt="Editor's Pick"></div>
                  <div v-if="post.item_sponsored === 'yes'" class="gg-badge gg-badge-sponsored"><img v-bind:data-src="post.sponsored_badge" alt="Sponsored"></div>
               </div>
            </div>
            <div class="col-sm-7">
               <h2 class="item-name"><a v-bind:href="post.item_purchase_url" v-html="post.title"></a></h2>
               <div class="item-desc" v-html="post.item_description"></div>
               <div class="why-to-buy" v-if="post.why_to_buy">Why to buy: <span v-html="post.why_to_buy"></span></div>
               <div class="item-price">$<span v-html="post.item_price"></span></div>
               <a class="btn btn-blue btn-item-buy" v-bind:href="post.item_purchase_url">Buy</a>
               <!-- <div>Order: {{post.item_list_order}}</div> -->
               <!-- <div>
                  Cats: <span v-for="cat of post.item_categories" v-bind:key="cat.value">{{ cat }} | </span>
                  Recips: <span v-for="recip of post.item_recipients" v-bind:key="recip.value">{{ recip }} | </span>
               </div> -->
            </div>
         </div>

   </div>
</transition>
</template>

<script>
module.exports = {
   props: ['post'],
   data: function() {
      return {}
   },
}
</script>
