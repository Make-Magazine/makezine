
<template>
   <GiftGuide></GiftGuide>
</template>

<script>
const GiftGuide = require('./GiftGuide.vue');
module.exports = {
   data: function() {
      return {
         title: 'hello world'
      }
   },
   components: {
      'GiftGuide': GiftGuide
   }
};
</script>


