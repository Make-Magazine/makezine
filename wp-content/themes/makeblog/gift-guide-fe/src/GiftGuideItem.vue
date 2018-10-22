
<template>
   <div class="row">
      <div class="col-sm-12">
         <h2 v-html="post.title.rendered"></h2>
         <div v-html="post.content.rendered"></div>
      </div>
   </div>
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
