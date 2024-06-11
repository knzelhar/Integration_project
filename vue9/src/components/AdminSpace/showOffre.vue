<template>
    <div class="offre">
        <!-- <table class="table"> -->
  <!-- <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Titre</th>
      <th scope="col">Date de création</th>
      <th scope="col">Description</th>
      <th scope="col">Message publicitaire</th>
      <th scope="col">Remise</th>
      <th scope="col">Volume horaire</th>


    </tr>
  </thead> -->
  <!-- <tbody> -->
    <div class="tcontainer" v-if="offre">
      <div class="text">
      <h2>Offre {{ offre.id }}</h2>
      <p>ID: {{ offre.id }}</p>
      <p class="header">Titre</p>
      <p>{{ offre.titre }}</p>
      <p class="header">Date de création</p>
      <p>{{ offre.date_creation }}</p>
      <p class="header">Description</p>
      <p>{{ offre.description }}</p>
      <p class="header">Message publicitaire</p>
      <p>{{ offre.message_pub }}</p>
      <p class="header">Remise</p>
      <p>{{ offre.remise }}</p>
      <p class="header">Volume horaire</p>
      <p>{{ offre.volume_horaire }}</p>
    </div>
    <div class="image">
      <img :src="require('@/assets/sgirl.png')">
    </div>
    </div>

  <!-- </tbody> -->
<!-- </table> -->
      

  </div>
</template>
<script>
import axios from 'axios';

export default {
  data() {
    return {
      offre: null
    };
  },
  async mounted() {
    // Fetch activity details based on the ID from route params
    //let token = JSON.parse(localStorage.getItem('token'));
    const offerId = this.$route.params.offreId;
    try {
      const response = await axios.get(`http://localhost:8000/api/offres/${offerId}`)
      this.offre = response.data;
    } catch (error) {
      console.error('Error fetching offre details:', error);
    }
  }
};
</script>
<style scoped>
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
/*style for search bar */
.container {
  padding-top: 20px;
}
.btn:hover {
  color: #fff;
}

.input-text:focus {


  box-shadow: 0px 0px 0px;
  border-color: #f8c146;
  outline: 0px;
}

.form-control {
  border: 1px solid #f8c146;
}
.tcontainer{
    padding-top: -10px;
    display: flex;
}
.text{
  padding-left: 300px;
  padding-top: 50px;
  width: 750px;
}
button a{
  text-decoration: none;
  color: white;
}
td{
  height: 20px;
}
.btn-primary{
  margin-right: 10px;
  margin-left: -95px ;
}
td{
  vertical-align: middle;
  height: 70px;
}
.btn {
  width: 90px; /* Fixed width for all buttons */
  margin-right: 7px;
  font-size: 13px; 
  border-radius: 20px;
}
.btn-warning{
  color:white;
}
.mainBtn{
  width:300px;
}
h2{
  padding-left: 100px;
}
h5{
  padding-bottom: 20px;
  font-size:larger;
  text-align:center;

}
p{
  padding-bottom: 20px;
  width: 300px;
  font-size:larger;
  text-align:center;
  font-size: larger;
}
.header{
  font-weight: bolder;
}
image{
  padding-top: 50px;
}
.image img{
  width: 430px;
}
</style>
