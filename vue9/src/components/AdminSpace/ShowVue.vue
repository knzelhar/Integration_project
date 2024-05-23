<template>
    <div class="container mt-5">
      <div class="card">
        <div class="card-header">
          <h4>Activité</h4>
        </div>
        <div class="card-body">
          <ul class="alert alert-warning" v-if="errorList && Object.keys(errorList).length > 0">
            <li class="mb-0 ms-3" v-for="(error, index) in errorList" :key="index">
              {{ error[0] }}
            </li>
          </ul>
          <div class="mb-3">
            <label>ID</label>
            <p>{{ model.activite.id }}</p>
          </div>
          <div class="mb-3">
            <label>description</label>
            <p>{{ model.activite.description }}</p>
          </div>
          <div class="mb-3">
            <label>YouTube Link</label>
            <p>{{ model.activite.Yout_link }}</p>
          </div>
          <div class="mb-3">
            <label>Age Minimal</label>
            <p>{{ model.activite.age_min }}</p>
          </div>
          <div class="mb-3">
            <label>Age Maximal</label>
            <p>{{ model.activite.age_max }}</p>
          </div>
          <div class="mb-3">
            <label>Effectif Minimal</label>
            <p>{{ model.activite.aff_min }}</p>
          </div>
          <div class="mb-3">
            <label>Effectif Maximal</label>
            <p>{{ model.activite.eff_max }}</p>
          </div>
          <div class="mb-3">
            <label>prix</label>
            <p>{{ model.activite.prix }}</p>
          </div>
          <div class="mb-3">
            <label>Aniamteur Id</label>
            <p>{{ model.activite.animt_id }}</p>
          </div>
          <div class="mb-3">
            <label>Admin Id</label>
            <p>{{ model.activite.admin_id }}</p>
          </div>
          <div class="mb-3">
            <label>Type Id</label>
            <p>{{ model.activite.type_id }}</p>
          </div>
          <div class="mb-3">
            <label>Created At</label>
            <p>{{ model.activite.created_at }}</p>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'activiteProfile',
    data() {
      return {
        activiteId: '',
        errorList: null,
        model: {
          activite: {
            ID: '',
            description: '',
            Yout_link: '',
            age_min: '',
            age_max: '',
            eff_min: '',
            eff_max: '',
            prix: '',
            animat_id: '',
            admin_id: '',
            type_id: '',
            created_at: '',
          }
        }
      }
    },
    mounted() {
      this.activiteId = this.$route.params.id;
      this.getActiviteData(this.activiteId);
    },
    methods: {
      getActiviteData(activiteId) {
        axios.get(`http://localhost:8000/api/activites/${activiteId}`)
             .then(res => {
               console.log(res.data.activite);
               this.model.activite = res.data.activite;
             })
             .catch(error => {
               if (error.response && error.response.status === 404) {
                 alert(error.response.data.message);
               }
             });
      }
    }
  }
  </script>