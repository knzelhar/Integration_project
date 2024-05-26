<template>
    <div class="offre">
   <div class="tcontainer">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Titre</th>
      <th scope="col">Date de création</th>
      <th scope="col">Description</th>
      <!--<th scope="col">Descriptif</th>-->
      <th scope="col">Message publicitaire</th>
      <th scope="col">Remise</th>
      <th scope="col">Volume horaire</th>


    </tr>
  </thead>
  <tbody>
    <tr v-if="offre">
      <td>{{ offre.id }}</td>
      <td>{{ offre.titre }}</td>
      <td>{{ offre.date_creation }}</td>
      <td>{{ offre.description }}</td>
      <td>{{ offre.message_pub}}</td>
      <td>{{ offre.remise }}</td>
      <td>{{ offre.volume_horaire }}</td>
    </tr>
  </tbody>
</table>
      
</div>
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
    const offerId = this.$route.params.offreId;
    try {
      const response = await axios.get(`http://localhost:8000/api/offres/${offerId}`);
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
  padding-left: 400px;
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
    padding-left:100px;
    padding-top: 30px;

}
th{
    width: 10px;
    white-space: nowrap;
    font-size: smaller;
}
th:nth-child(1){
  width:50px;
}
th:nth-child(4){
    width: 150px;
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
</style>
