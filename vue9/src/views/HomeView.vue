<template>
  <div class="tous">
    <AccueilVue></AccueilVue>
    <SlidesVue></SlidesVue>
    <commentsVue></commentsVue>
    <footerVue></footerVue>
  </div>
  </template>
<script>
import AccueilVue from '../components/AccueilVue.vue'
import commentsVue from '../components/commentsVue.vue'
import SlidesVue from '../components/SlidesVue.vue'
import footerVue from '../components/footerVue.vue'



export default{
  components:{
    AccueilVue,
    commentsVue,
    footerVue,
    SlidesVue

  }
  
}
</script>

<style scoped>
*{
  background-color:#F0F0F0;
}
</style>