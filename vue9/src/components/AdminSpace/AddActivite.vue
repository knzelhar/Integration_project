<template>
    <div class="main">
       <div class="container">
    <form @submit.prevent="submitForm" :class="{ 'has-errors': Object.keys(errors).length > 0 }" >
           <h1>Ajouter Activite</h1>
           <p v-if="errors['id']" style="color: red;" class="errorMsg">{{ errors['id'] }}</p>
            <input type="text" placeholder="Id" v-model="id">
            <p v-if="errors['titre']" style="color: red;" class="errorMsg">{{ errors['titre'] }}</p>
            <input type="text" placeholder="Titre de l'offre" v-model="titre">
            <input type="text" placeholder="date de création" v-model="date_crea">
            <input type="text" placeholder="date de mise à jour " v-model="date_mise">
            <input type="text" placeholder="date de début d'incription" v-model="date_deb_inscr">
            <input type="text" placeholder="date de fin d'inscription" v-model="date_fin_inscr">
            <p v-if="errors['desc']" style="color: red;" class="errorMsg">{{ errors['desc'] }}</p>
            <input type="text" placeholder="description" v-model="desc">
            <input type="text" placeholder="message publicitaire" v-model="msg_pub">
            <p v-if="errors['remise']" style="color: red;" class="errorMsg">{{ errors['remise'] }}</p>
            <input type="text" placeholder="remise" v-model="remise">
            <p v-if="errors['vol_hor']" style="color: red;" class="errorMsg">{{ errors['vol_hor'] }}</p>
            <input type="text" placeholder="volume horaire" v-model="vol_hor">
             <input type="submit" value="Ajouter">
         </form> 
       </div>
       </div>
 </template>
 <script>
     export default {
       data() {
         return {
           errors: {},
           id: '',
           titre:'',
           date_crea:'',
           date_mise:'',
           date_deb_inscr:'',
           date_fin_inscr:'',
           desc:'',
           msg_pub:'',
           remise:'',
           vol_hor:''
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
         submitForm() {
           this.errors = {};
           if (!this.isPositiveInteger(this.id)) {
             this.errors['id'] = "Veuillez entrer un entier positif pour l'id";
           }
           if (!this.isPositiveNumber(this.remise)) {
             this.errors['remise'] = "Veuillez entrer un nombre positif pour la remise";
           }
           if (!this.isPositiveNumber(this.vol_hor)) {
             this.errors['vol_hor'] = "Veuillez entrer un nombre positif pour le volume horaire";
           }
           if (!this.titre) {
             this.errors['titre'] = "Veuillez entrer un titre pour l'offre";
           }
           if (!this.desc) {
             this.errors['desc'] = "Veuillez entrer une description pour l'offre";
           }
           else
           this.$router.push("/AdminVue");
 
         },
 
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
       height:  1100px;
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
 </style>