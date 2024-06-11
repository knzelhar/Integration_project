<template>
    <div class="offre">
     <searchbarVue></searchbarVue>
     <div class="tcontainer">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Titre</th>
      <th scope="col">Message publicitaire</th>
      <th><button type="button" class="btn btn-success"><router-link to="/AdminVue/AddOffre">Ajouter</router-link></button></th>
    </tr>
    <tr v-for="offres in offre" :key="offres.id">
      <td>{{ offres.id }}</td>
      <td>{{ offres.titre }}</td>
      <td>{{ offres.message_pub }}</td>
      <td class="mainBtn"><button type="button" class="btn btn-primary">Modifier</button>
        <button type="button" class="btn btn-danger">Supprimer</button>
        <button type="button" class="btn btn-warning" @click="showDetail(offres.id)">Afficher</button>
      </td>
    </tr>
  </thead>
  <tbody>
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
    offre:{},
  }
  },
  methods:{
    async getOffre() {
      try {
        //const token = this.$cookies.get('token'); 
        // console.log(token)
        const response = await axios.get('http://localhost:8000/api/offres')
        console.log(response.data);
        this.offre = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    async showDetail(offreId) {
      try {
        const response = await axios.get(`http://localhost:8000/api/offres/${offreId}`)
        console.log(response.data); 
        this.$router.push({ name: 'showOffre', params: { offreId: offreId }});
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    this.getOffre()
}
  
}
</script>

<style scoped>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
.offre{
  background-color: white;
  height: 100vh;
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
table{
  width: 960px;
}
th:nth-child(3){
    width: 450px;
}

button a{
  text-decoration: none;
  color: white;
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
.btn-primary{
  margin-right: 10px;
  margin-left: -95px ;
}
</style>