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
  </thead>
  <tbody>
  </tbody>
</table>
      
</div>
    </div>
</template>
<script>
import searchbarVue from './searchbarVue.vue'

export default{
  components:{
    searchbarVue,

  },
  
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
    width: 400px;
}

button a{
  text-decoration: none;
  color: white;
}
</style>