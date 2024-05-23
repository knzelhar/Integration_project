<template>
  <div class="main">
    <div class="container">
      <div class="image" :class="{ 'has-errors': Object.keys(errors).length > 0 }">
   <img src="../assets/boy.webp">
    </div>
      <form @submit.prevent="submitForm" :class="{ 'has-errors': Object.keys(errors).length > 0 }" >
        <h1>S'inscrire</h1>
        <p v-if="errors['LastName']" style="color: red;" class="errorMsg">{{ errors['LastName'] }}</p>
        <p v-if="errors['Name']" style="color: red;" class="errorMsg">{{ errors['Name'] }}</p>
      <div class="Name">
         <input placeholder="Nom" v-model="Nom" class="LName">
         <input placeholder="Prénom" v-model="Prénom">
         </div>
         <p v-if="errors['Email']" style="color: red;" class="errorMsg">{{ errors['Email'] }}</p>
         <input type="email" placeholder="Adresse mail" v-model="Email" @blur="validateEmail">
         <input placeholder="Fonction" v-model="Fonction">
         <p v-if="errors['Pass']" style="color: red;" class="errorMsg">{{ errors['Pass'] }}</p>
         <p v-if="errors['confPassword']" style="color: red;" class="errorMsg">{{ errors['confPassword'] }}</p>
         <p v-if="errors['validCheck']" style="color: red;" class="errorMsg">{{ errors['validCheck'] }}</p>
         <div class="pass">
         <input :type="showPassword1 ? 'text' : 'password'"  placeholder="Mot de passe" v-model="Password">
         <i class="fas" :class="{ 'fa-eye-slash': !showPassword1, 'fa-eye': showPassword1 }" @click="togglePasswordVisibility(1)"></i>
        </div>
         <div class="pass">
         <input :type="showPassword2 ? 'text' : 'password'" placeholder="confirmation de mot de passe" v-model="confPassword">
         <i class="fas" :class="{ 'fa-eye-slash': !showPassword2, 'fa-eye': showPassword2 }" @click="togglePasswordVisibility(2)"></i>
        </div>
         <input type="submit" value="S'inscrire">
         <p>Vous avez déjà un compte ? <router-link to="loginForm">se connecter</router-link></p>
      </form>
    </div>
  </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        errors: {},
        Nom: '',
        Prénom: '',
        Email: '',
        Fonction: '',
        Password: '',
        confPassword: '',
        rules: [
				{ message:'Au moins une lettre miniscule est requise.', regex:/[a-z]+/ },
				{ message:"Au moins une lettre majuscule est requise.",  regex:/[A-Z]+/ },
				{ message:"Il faut au minimum 8 charactères.", regex:/.{8,}/ },
				{ message:"Au moins un nombre est requis.", regex:/[0-9]+/ }
			],
      showPassword1: false,
      showPassword2: false
      } 
    },
    methods: {
      validatePassword() {
      for (let rule of this.rules) {
        if (!rule.regex.test(this.Password)) {
          this.errors['validCheck'] = rule.message;
          return; // Stop checking rules if one fails
        }
      }
    },
      submitForm() {
        this.errors = {};
        if (this.Password !== this.confPassword) {
          this.errors['confPassword'] = "Les mots de passe ne correspondent pas";
        }
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(this.Email)) {
          this.errors['Email'] = "Veuillez entrer une adresse e-mail valide";
        }
        if(!this.Nom){
          this.errors['LastName'] = "Veuillez entrer votre nom";
        }
        if(!this.Prénom){
          this.errors['Name'] = "Veuillez entrer votre prénom";
        }
        if(!this.Password){
          this.errors['Pass'] = "Veuillez entrer un mot de passe";
        }
        else{
          this.validatePassword();
        }
      },
      togglePasswordVisibility(fieldNumber) {
      if (fieldNumber === 1) {
        this.showPassword1 = !this.showPassword1;
      } else if (fieldNumber === 2) {
        this.showPassword2 = !this.showPassword2;
      }
    }
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
    height:700px;
    width: 100%;
    background-color: #F0F0F0;
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
    display: flex;
    justify-content: center;
    height: 600px;
    width:1000px;
    padding: 0;
    margin-top: 25px;
    margin-left: 125px ;
    
  }
  h1{
    display: flex;
    justify-content: center;
    color:#EE964B;
    font-weight: bolder;
  }
form{
  display:flex;
  flex-direction: column;
  width: 40%;
  height: 515px;
  padding: 0;
  /*backdrop-filter: blur(15px);
  border-top-right-radius: 40px;*/
  border-left: none;
  background-color: #E6D6D0;
  padding-top: 20px;
  border-top-right-radius:50px;
  border-bottom-right-radius:50px;
  box-shadow: 10px 0px;
}
.image{
  display: flex;
  align-items: center;
  width: 25%;
  height: 515px;
  padding: 0;
  background-color: #E6D6D0;
  border-top-left-radius:50px;
  border-bottom-left-radius:50px;
}
.image img{
  width: 85%;
  margin-top: auto;
  margin-bottom: auto;
  margin-left: 60px;
  z-index: 1;

}
p{
  font-weight: bold;
  margin-left:auto;
  margin-right:auto;

}
.pass{
  position:relative;
  margin-left: 80px;
}
input{
  width: 60%;
  margin-left:auto;
  margin-right:auto;
  color:black;
  border:2px solid black;
  outline: none;
  margin-bottom: 25px;
  border-radius: 15px;
  padding-top:4.5px;
  padding-bottom:7px;
  background-color: #E9E4E4;
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
}*
.pass{
  width: 100%;
  margin-top:3px;
}
.pass i{
  position:absolute;
  bottom: 36px;
  right: 170px;
  cursor:pointer;
  color:black;
}
input[type="submit"]{
  background-color: #EE964B;
  font-weight: bolder;
  width:42%;
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
.Name{
  display: flex;
}
.Name input{
  width:27%;
  margin-top:20px;
}
.LName{
  margin-right: -50px;
}
 .errorMsg{
  font-weight: light;
  font-size: 12px;
 } 
 form.has-errors {
  height: 600px; 
}
.image.has-errors{
  height: 600px;
}
@media screen and (max-width:1159px) {
  .container{
    margin-left: 80px;
  }
}
  @media screen and (max-width:1141px){
    .container{
      margin-left:60px;
    }
  }
    @media screen and (max-width:1141px){
    .container{
      margin-left:40px;
    }
  }
    @media screen and (max-width:990px){
       .container{
        margin-left: 100px;
    }
    form{
         width:50%; 
        }
      }
      @media screen and (max-width:760px){
        form{
         width:100%; 
        }
        .pass i{
          left: 210px;
        }
        .image img{
          width: 190px;
          margin-left: 20px;
        }
      }
      @media screen and (max-width:710px){
        form{
          width: 70%;
        }
        .pass i{
          left: 190px;
        }
      }
      @media screen and (max-width:710px){
        form{
          width: 60%;
        }
        .image img{
          width: 170px;
          margin-left: 20px;
        }
        .pass{
          margin-left: 65px;
        }
        .pass i{
          left: 167px;
        }
      }
      @media screen and (max-width:660px){
        form{
          width: 59%;
        }  }
        @media screen and (max-width:660px){
          form{
          width: 47%;
        }  
        .image img{
          width: 160px;
          margin-left: 10px;
        }
        .pass{
          margin-left: 55px;
        }
        .pass i{
          left: 125px;
        }
        p{
          font-size: small;
        }
        }
        @media screen and (max-width:640px){
          form{
          width: 45%;
        }
        .pass{
          margin-left: 50px;
        }
        p{
          font-size: 10px;
        }
        }
        @media screen and (max-width:610px){
          form{
          width: 100%;
        }
        .container{
          margin-left: 80px;
          width: 430px;
        }
        .pass{
          margin-left: 65px;
        }
        .pass i{
          left: 160px;
        }
        }
        @media screen and (max-width:580px){
          .container{
          margin-left: 80px;
          width: 400px;
        }
        .image img{
          width: 130px;
        }
        .pass {
          margin-left: 60px;
        }
        .pass i{
          left: 150px;
        }
        }
        @media screen and (max-width:490px){
          .container{
          margin-left: 80px;
          width: 340px;
        }
        .image img{
          width: 130px;
        }
        .pass {
          margin-left: 60px;
        }
        .pass i{
          left: 150px;
        }
        .image img{
          width: 110px;
        }
        .pass {
          margin-left: 50px;
        }
        .pass i{
          left: 125px;
        }
        }

      

  </style>
  