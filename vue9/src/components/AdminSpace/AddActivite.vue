<template>
  <div class="main">
     <div class="container">
  <form @submit.prevent="submitForm">
         <h1>Ajouter Activité</h1>
          <p v-if="errors['titre']" style="color: red;" class="errorMsg">{{ errors['titre'] }}</p>
          <input type="text" placeholder="Titre de l'activité" v-model="titre">
          <p v-if="errors['description']" style="color: red;" class="errorMsg">{{ errors['description'] }}</p>
          <input type="text" placeholder="description de l'activité" v-model="description">
          <input type="text" placeholder="descriptif" v-model="descriptif">
          <p v-if="errors['type_act']" style="color: red;" class="errorMsg">{{ errors['type_act'] }}</p>
          <input type="text" placeholder="type de l'activité" v-model="type_act">
          <p v-if="errors['description_type']" style="color: red;" class="errorMsg">{{ errors['description_type'] }}</p>
          <input type="text" placeholder="description du type" v-model="description_type">
          <p v-if="errors['objectif']" style="color: red;" class="errorMsg">{{ errors['objectif'] }}</p>
          <input type="text" placeholder="objectif " v-model="objectif">
          <p v-if="errors['img_pub']" style="color: red;" class="errorMsg">{{ errors['img_pub'] }}</p>
          <input type="text" placeholder="image publicitaire" v-model="img_pub">
          <p v-if="errors['lien_ytb']" style="color: red;" class="errorMsg">{{ errors['lien_ytb'] }}</p>
          <input type="text" placeholder="lien youtube" v-model="lien_ytb">
          <!-- <input type="file" id="file-upload" accept=".pdf">-->
          <p v-if="errors['age']" style="color: red;" class="errorMsg">{{ errors['age'] }}</p>
          <input type="text" placeholder="age minimal" v-model="age_min">
          <input type="text" placeholder="age maximal" v-model="age_max">
          <p v-if="errors['eff']" style="color: red;" class="errorMsg">{{ errors['eff'] }}</p>
          <input type="text" placeholder="effectif minimal" v-model="eff_min">
          <input type="text" placeholder="effectif maximal" v-model="eff_max">
          <p v-if="errors['prix']" style="color: red;" class="errorMsg">{{ errors['prix'] }}</p>
          <input type="text" placeholder="prix" v-model="prix">
          <p v-if="errors['sessions']" style="color: red;" class="errorMsg">{{ errors['sessions'] }}</p>
          <div v-for="(session, index) in sessions" :key="index" class="sessions">
            <label>Session {{ index + 1 }}</label>
            <br>
          <p v-if="errors[`jour${index}`]" style="color: red;" class="errorMsg">{{ errors[`jour${index}`] }}</p>
            <input type="text" placeholder="jour" v-model="session.jour">
            <p v-if="errors[`heure_deb${index}`]" style="color: red;" class="errorMsg">{{ errors[`heure_deb${index}`] }}</p>
            <input type="text" placeholder="Heure de début" v-model="session.heure_deb">
            <p v-if="errors[`heure_fin${index}`]" style="color: red;" class="errorMsg">{{ errors[`heure_fin${index}`] }}</p>
            <input type="text" placeholder="Heure de fin" v-model="session.heure_fin">
          </div> 
          <button type="button" id="addSession" class="btn btn-success" @click="addSession">Ajouter Session +</button>
           <input type="submit" value="Ajouter">
       </form> 
     </div>
     </div>
</template>
<script>
import axios from "axios"
   export default {
     data() {
       return {
         errors: {},
         titre:'',
         description:'',
         objectif:'',
         img_pub:'',
         lien_ytb:'',
         age_min:'',
         age_max:'',
         eff_min:'',
         eff_max:'',
         prix:'',
         /*jour:'',
         heure_deb:'',
         heure_fin:'',*/
         sessions: [],
         type_act: '',
         description_type:'',
         descriptif:''
       }
     },
     methods: {
        isPositiveInteger(value) {
           const integerRegex = /^[1-9]\d*$/;
           return integerRegex.test(value);
        },
        isPositiveNumber(value) {
           const numberRegex = /^[+]?\d+(\.\d+)?$/;
           return numberRegex.test(value);
        },
        isValidYoutubeLink(link) {
          const youtubeRegex = /^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/;
          return youtubeRegex.test(link);
      },
      isValidJour(jour) {
          const jourRegex = /^(Lundi|Mardi|Mercredi|Jeudi|Vendredi|Samedi|Dimanche)$/;
          return jourRegex.test(jour);
      },

      isValidHeure(heure) {
          const heureRegex = /^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/;
          return heureRegex.test(heure);
      },
      addSession() {

        if (this.sessions.length < 7) {
        this.sessions.push({ jour: '', heure_deb: '', heure_fin: '' });
      }
      },
        validForm() {
         this.errors = {};
         let formValid = true;
         if (!this.titre) {
           this.errors['titre'] = "Veuillez entrer un titre pour l'activité";
           formValid = false;

         }
         if (!this.description) {
           this.errors['description'] = "Veuillez entrer une description pour l'activité";
           formValid = false;

         }
         if (!this.objectif) {
           this.errors['objectif'] = "Veuillez entrer un objectif pour l'activité";
           formValid = false;

         }
         if (!this.img_pub) {
           this.errors['img_pub'] = "Veuillez entrer une image publicitaire pour l'activité";
           formValid = false;

         }
         if (!this.isValidYoutubeLink(this.lien_ytb)) {
              this.errors['lien_ytb'] = "Veuillez entrer un lien YouTube valide";
           formValid = false;

          }
          if (!this.isPositiveInteger(this.age_min)||!this.isPositiveInteger(this.age_max)) {
           this.errors['age'] = "Veuillez entrer un entier positif pour l'age";
           formValid = false;

         }
         if (!this.isPositiveInteger(this.eff_min)||!this.isPositiveInteger(this.eff_max)) {
           this.errors['eff'] = "Veuillez entrer un entier positif pour l'effectif";
           formValid = false;

         }
         if (!this.isPositiveNumber(this.prix)) {
          this.errors['prix'] = "Veuillez entrer un nombre positif pour le volume horaire";
          formValid = false;

        }
        if(!this.type_act){
          this.errors['type_act'] = "Veuillez entrer le type de l'activité";
          formValid = false;

        }
        if(!this.description_type){
          this.errors['description_type'] = "Veuillez entrer une description du type de l'activité";
          formValid = false;

        }
        if (this.sessions.length === 0) {
                  this.errors['sessions'] = "Veuillez ajouter au moins une session";
           formValid = false;

        }
        this.sessions.forEach((session, index) => {
          if (!this.isValidJour(session.jour)) {
            this.errors[`jour${index}`] = "Veuillez entrer un jour valide (Lundi-Dimanche)";
           formValid = false;

          }
          if (!this.isValidHeure(session.heure_deb)) {
            this.errors[`heure_deb${index}`] = "Veuillez entrer une heure de début valide (HH:MM)";
           formValid = false;

          }
          if (!this.isValidHeure(session.heure_fin)) {
            this.errors[`heure_fin${index}`] = "Veuillez entrer une heure de fin valide (HH:MM)";
           formValid = false;

          }
        });
        return formValid;
      },
        async submitForm(){
        if (this.validForm()) {
         try {
        // Make a POST request to your API endpoint
        const response = await axios.post('http://localhost:8000/api/activites',{
              titre: this.titre,
              description: this.description,
              objectif: this.objectif,
              image_pub: this.img_pub,
              lien_youtube: this.lien_ytb,
              age_min: this.age_min,
              age_max: this.age_max,
              eff_min: this.eff_min,
              eff_max: this.eff_max,
              descriptif:this.descriptif,
              prix: this.prix,
              type: this.type_act,
              description_type:this.description_type,
              horaires: this.sessions.map(session => ({
                    jour_par_semaine: session.jour,
                    debut: session.heure_deb,
                    fin: session.heure_fin
                }))
        });
        console.log(response.data); 
        alert("Activity added successfully!");
        
        // Clear form fields after successful submission
        //this.clearForm();

      } catch (error) {
        // Handle errors, e.g., display error messages
        console.error("Error:", error);
        alert("Failed to add activity. Please try again later.");
      }
        }
      },
      /*clearForm() {
        this.titre = '';
        this.description = '';
        this.objectif = '';
        this.img_pub = '';
        this.lien_ytb = '';
        this.age_min = '';
        this.age_max = '';
        this.eff_min = '';
        this.eff_max = '';
        this.prix = '';
        this.type_act = '';
        this.description_type = '';
        this.sessions = [];
      }*/
     }

 }
   </script>
<style scoped>
*{
     margin: 0;
     padding: 0;
     box-sizing: border-box;
   }
   .main{
     height:  2000px;
     width: 100%;
     background-color: white;

   }
   span{
     color:red;
   }
   .is-invalid{
     border: 1px solid red;
   }
   #login{
     color:rgb(232, 143, 26);
   }
   .container{
     position: absolute;
     height: 600px;
     width:1000px;
     padding: 0;
     margin-top: 90px;
     margin-left: 125px ;
   }
   h1{
     text-align: center;
     color:#EE964B;
     font-weight: bolder;
     padding-bottom:45px;
   }
 form{
   display:flex;
   flex-direction: column;
   width: 100%;
   height: 800px;
   margin-top: -90px;
   margin-left: 135px;
   padding: 0;
   border-left: none;
   /*background-color: #E6D6D0;*/
   padding-top: 40px;
  /*border-radius: 50px;
   box-shadow: 8px 0px;*/
 }
 p{
   font-weight: bold;
   margin-left:auto;
   margin-right:auto;
 
 }
 .pass{
   position:relative;
   margin-left: 71px;
 }
 input{
   width: 60%;
   margin-left:auto;
   margin-right:auto;
   color:black;
   border:1px solid black;
   outline: none;
   margin-bottom: 40px;
   border-radius: 10px;
   padding-top:4.5px;
   padding-bottom:7px;
   background-color: #fefbfb;
   padding-left: 10px;
   caret-color: grey;
 }
 ::placeholder {
   font-size: 11px;
   color: grey;
   font-weight: bolder;
   text-align:left;
 }
 label{
   margin: auto;
   color: black;
 }
 input[type="submit"]{
   background-color: #EE964B;
   font-weight: bolder;
   width:60%;
   border-radius: 25px ;
   padding-left:0;
 }
 input[type="submit"]:hover{
 color: black;
 opacity: 90%;
 }
 input[type="number"]{
  width: 10%;
  margin-left:200px;
  margin-top: 20px;
 }
 #nbr_sea{
  margin-left: 200px;
 }
 /*style for  activity sessions*/
 .sessions{
       margin-left: 200px ;
 }
 .sessions input{
  width:610px;
 }
 /**/
/*style for file*/
input[type="file"]{
padding-bottom: 40px;
padding-top: 10px;
}

/**/
 p a{
   text-decoration: none;
   color:#EE964B;
 }
  .errorMsg{
   font-weight: light;
   font-size: 12px;
  } 
  form.has-errors {
   height: 400px; 
 }
 #Lastp{
   color:#EE964B;
   text-decoration: underline;
   font-weight: light;
 }
 #addSession{
  width:200px;
  margin-left:200px ;
  margin-bottom: 40px;
 }
</style>