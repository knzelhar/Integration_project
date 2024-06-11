<template>
    <div class="activite">
   <div class="tcontainer">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Titre</th>
      <th scope="col">Objectif</th>
      <th scope="col">Image publicitaire</th>
      <th scope="col">Lien youtube</th>
      <!--<th scope="col">Descriptif</th>-->
      <th scope="col">Age minimal</th>
      <th scope="col">Age maximal</th>
      <th scope="col">Effectif minimal</th>
      <th scope="col">Effectif maximal</th>
      <th scope="col">Prix</th>


    </tr>
  </thead>
  <tbody>
    <tr v-if="activity">
      <td>{{ activity.id }}</td>
      <td>{{ activity.titre }}</td>
      <td>{{ activity.objectif }}</td>
      <td>{{ activity.image_pub }}</td>
      <td>{{ activity.lien_youtube }}</td>
      <td>{{ activity.age_min }}</td>
      <td>{{ activity.age_max }}</td>
      <td>{{ activity.eff_min }}</td>
      <td>{{ activity.eff_max }}</td>
      <td>{{ activity.prix }}</td>
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
      activity: null
    };
  },
  async mounted() {
    // Fetch activity details based on the ID from route params
    const activityId = this.$route.params.id;
    try {
        const response = await axios.get(`http://localhost:8000/api/activites/${activityId}`)
      this.activity = response.data;
    } catch (error) {
      console.error('Error fetching activity details:', error);
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
