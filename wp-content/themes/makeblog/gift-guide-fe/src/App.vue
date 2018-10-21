
<template>
   <div>
      <h1>{{ title }}</h1>
      <GiftGuide></GiftGuide>
   </div>
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
