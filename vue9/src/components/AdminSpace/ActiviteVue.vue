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
      <td class="mainBtn"><button type="button" class="btn btn-primary">Modifier</button>
        <button type="button" class="btn btn-danger" @click="deleteActivity(activities.id)">Supprimer</button>
        <button type="button" class="btn btn-warning" @click="showDetails(activities.id)">Afficher</button>
      </td>
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
          // const authtoken = this.$cookies.get('token'); 
      try {
        // plainText = token.plainText;
        // console.log(token)
        const response = await axios.get('http://localhost:8000/api/activites')
        // headers: {
        //   'Authorization': `Bearer ${authtoken}`
        // }
        console.log(response.data);
        this.activity = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    async showDetails(id) {
      try {
        const response = await axios.get(`http://localhost:8000/api/activites/${id}`);
        console.log(response.data); 
        this.$router.push({ name: 'showActivite', params: { id: id }});
      } catch (error) {
        console.log(error);
      }
    },
    async deleteActivity(id) {
      try {
        const response = await axios.delete(`http://localhost:8000/api/activites/${id}`);
        console.log(response.data);
        this.getActivities();
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
th{
    width: 200px;
}
th:nth-child(1){
  width:50px;
}
th:nth-child(4){
    width: 400px;
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