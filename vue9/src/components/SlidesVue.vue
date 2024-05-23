<template>
    <div class="slides">
      <div class="slides-inner" ref="slidesInner" :style="{ transform: 'translateX(-' + slidesInnerMarginLeft + 'px)' }">
        <div v-for="(slide, index) in slides" :key="index" class="slide">
          <Slide :slide="slide" :width="singleWidth"></Slide>
        </div>
      </div>
      <div class="navigation-container">
        <button class="nav-btn prev-btn" @click="goToPrev"><img src="static/img/back.png" alt="Previous"></button> <!-- Icône précédente -->
        <button class="nav-btn next-btn" @click="goToNext"><img src="static/img/next.png" alt="Next"></button> <!-- Icône suivante -->
      </div>
    </div>
  </template>
  
  <script>
  import Slide from './SlideVue';
  
  export default {
    data() {
      return {
        slides: [
          {src: 'static/img/kid4.png'},
          {src: 'static/img/kid9.png'},
          {src: 'static/img/kid12.png'},
          {src: 'static/img/kid2.png'},
          {src: 'static/img/kid3.png'},
        ],
        singleWidth: 0,
        currentIndex: 1, // Commence à l'indice 0
        autoSlideInterval: null,
        autoSlideDelay: 1000, // Interval de défilement automatique en millisecondes
      };
    },
    computed: {
      slidesInnerMarginLeft() {
        return this.currentIndex * this.singleWidth;
      },
    },
    methods: {
      goToPrev() {
        if (this.currentIndex === 0) {
          this.currentIndex = this.slides.length - 1; // Si l'utilisateur est sur la première diapositive, passez à la dernière
        } else {
          this.currentIndex--;
        }
      },
      goToNext() {
        if (this.currentIndex === this.slides.length - 1) {
          this.currentIndex = 0; // Si l'utilisateur est sur la dernière diapositive, passez à la première
        } else {
          this.currentIndex++;
        }
      },
      goToSlide(index) {
        this.currentIndex = index;
      },
      startAutoSlide() {
        this.autoSlideInterval = setInterval(() => {
          this.goToNext(); // Défilement automatique vers la diapositive suivante
        }, this.autoSlideDelay);
      },
      stopAutoSlide() {
        clearInterval(this.autoSlideInterval); // Arrêter le défilement automatique
      },
    },
    props: {
      itemsPerSlide: {
        type: Number,
        default: 1
      }
    },
    components: {
      Slide
    },
    mounted() {
      this.$nextTick(() => {
        // Get the bounding client rect of slidesInner
        const slidesInnerRect = this.$refs.slidesInner.getBoundingClientRect();
        // Calculate the total width of slidesInner
        const totalWidth = slidesInnerRect.width;
        // Calculate the singleWidth based on the total width and number of slides
        this.singleWidth = totalWidth / this.slides.length / this.itemsPerSlide;
  
        this.startAutoSlide(); // Démarrer la navigation automatique
      });
    },
    beforeUnmount() {
      this.stopAutoSlide(); // Arrêter l'intervalle lors de la destruction du composant
    }
  };
  </script>
  
  
  
  <style scoped>
  .slides {
    position: relative; /* Positionnement relatif pour les éléments enfants */
    overflow: hidden; /* Cache les parties de l'image qui dépassent de la boîte */
    margin-bottom: -20px;
    margin-top: 60px ;
  }
  
  .slides-inner {
    display: flex;
    flex-wrap: nowrap; /* Prevent wrapping to new lines */
    transition: transform 0.3s ease; /* Ajoute une transition fluide lors du défilement */
  }
  
  .slide {
    flex: 0 0 auto; /* Ensure each slide has a fixed size */
  }
  
  .navigation-container {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 100%; /* Ajuste la largeur pour s'adapter à la largeur du conteneur parent */
    display: flex;
    justify-content: space-between; /* Aligne les éléments enfants avec un espace égal entre eux */
  }
  
  .prev-btn, .next-btn {
    cursor: pointer;
    background-color: transparent;
    border: none;
  }
  
  .prev-btn img, .next-btn img {
    width: 30px; /* Ajuster la taille de l'icône selon les besoins */
  }
  
  /* Other styles as needed */
  </style>