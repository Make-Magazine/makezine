
<template>
   <div>
      <h2 v-html="post.title.rendered"></h2>
      <div v-html="post.content.rendered"></div>
   </div>
</template>

<script>
module.exports = {
   props: ['post'],
   data: function() {
      return {
         //content: 
      }
   },
}
</script>
