
<template>
<transition appear>
   <div class="item-instance">

         <div class="row">
            <div class="col-sm-5">
               <img v-bind:src="post.item_image" />
            </div>
            <div class="col-sm-7">
               <h2 class="item-name" v-html="post.item_name"></h2>
               <div class="item-desc" v-html="post.item_description"></div>
               <div class="why-to-buy">Why to buy: <span v-html="post.why_to_buy"></span></div>
               <div class="item-price">$<span v-html="post.item_price"></span></div>
               <a class="btn btn-blue btn-item-buy" v-bind:href="post.item_purchase_url">Buy</a>
               <div>
                  Cats: <span v-for="cat of post.item_categories" v-bind:key="cat.value">{{ cat }} | </span>
                  Recips: <span v-for="recip of post.item_recipients" v-bind:key="recip.value">{{ recip }} | </span>
               </div>
            </div>
         </div>

   </div>
</transition>
</template>

<script>
module.exports = {
   props: ['post'],
   data: function() {
      return {
         
      }
   },
}
</script>
