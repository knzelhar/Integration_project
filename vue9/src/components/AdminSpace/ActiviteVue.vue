<template>
  <div class="activite">
   <searchbarVue></searchbarVue>
   <div class="tcontainer">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Titre</th>
      <th scope="col">Objectif</th>
      <th scope="col">Image publicitaire</th>
      <th><button type="button" class="btn btn-success"><router-link to="/AdminVue/AddActivite">Ajouter</router-link></button></th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="activities in activity" :key="activities.id">
      <td>{{ activities.id }}</td>
      <td>{{ activities.titre }}</td>
      <td>{{ activities.objectif }}</td>
      <td>{{ activities.image_pub }}</td>
    </tr>
  </tbody>
</table>
      
</div>
  </div>
</template>
<script>
import searchbarVue from './searchbarVue.vue'
import axios from "axios"
export default{
components:{
  searchbarVue,
},
data(){
  return{
    activity:{},
  }
  },
  methods: {
    async getActivities() {
      try {
        const response = await axios.get('http://localhost:8000/api/activites');
        console.log(response.data);
        this.activity = response.data;
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    this.getActivities()
}
}

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
    padding-left:300px;
    padding-top: 30px;

}
th:nth-child(3){
    width: 200px;
}
th:nth-child(4){
    width: 350px;
}
button a{
  text-decoration: none;
  color: white;
}
</style>