<template>
    <div class="slide">
      <img v-bind:src="slide.src">
    </div>
  </template>
  
  <script>
  export default{
   data(){
    
   },
   props: {
    slide: Object
   }
  }
  </script>
  
  <style scoped>
  .slide img{
    width:430px;
  }
  </style>