<template>
    <div class="main">
      <div class="container">
        <div class="image" :class="{ 'has-errors': Object.keys(errors).length > 0 }">
     <img src="../assets/boy.webp">
      </div>
        <form @submit.prevent="submitForm" :class="{ 'has-errors': Object.keys(errors).length > 0 }" >
          <p v-if="errors['isVerified']" style="color: red; font-size: large;" class="errorMsg">{{ errors['isVerified'] }}</p>
          <p v-if="errors['notExist']" style="color: red; font-size: large;" class="errorMsg">{{ errors['notExist'] }}</p>
          <p v-if="errors['wrongPass']" style="color: red; font-size: large;" class="errorMsg">{{ errors['wrongPass'] }}</p>

          <h1>Se connecter</h1>
           <p v-if="errors['Email']" style="color: red;" class="errorMsg">{{ errors['Email'] }}</p>
           <input type="email" placeholder="Adresse mail" v-model="Email" @blur="validateEmail">
           <p v-if="errors['Pass']" style="color: red;" class="errorMsg">{{ errors['Pass'] }}</p>
           <div class="pass">
           <input :type="showPassword ? 'text' : 'password'"  placeholder="Mot de passe" v-model="Password">
           <i class="fas" :class="{ 'fa-eye-slash': !showPassword, 'fa-eye': showPassword }" @click="togglePasswordVisibility"></i>
        </div>
          <!--<input type="text" hidden value="parent">-->
            <input type="submit" value="Se connecter">
           <p id="Lastp"><router-link to="/ForgetPass">Mot de passe oublié?</router-link></p>
        </form>
      </div>
      <!-- -->
    </div>
    </template>
    
    <script>
    import axios from "axios"
    export default {
      data() {
        return {
          errors: {},
          Email: '',
          Password: '',
          showPassword: false,
        }
      },
      methods: {
        validForm() {
          this.errors = {};
          let noEmpty = true;
          if (!this.Password) {
            this.errors['Pass'] = "Veuillez entrer un mot de passe";
            noEmpty = false;
          }
         if (!this.Email){
            this.errors['Email'] = "Veuillez entrer une adresse mail";
            noEmpty = false;
          }
         return noEmpty;
        },
        togglePasswordVisibility() {
          this.showPassword = !this.showPassword;
      },
      async submitForm() {
      if (this.validForm()) {
        try {
          const response = await axios.post('http://localhost:8000/api/hh', {
            email: this.Email,
            password: this.Password
          });
          this.$cookies.set('token', response.data.token);
          const role = response.data.role;
          console.log(response.data);
          if (role === 0) {
            this.$router.push('/AdminVue');
          } else if (role === 1) {
            this.$router.push('/ContactVue');
          } else if (role === 2) {
            this.$router.push('/ContactVue');
          }
        } catch (error) {
          console.error('There was an error with the request:', error);
          if (error.response && error.response.status === 403) {
              this.errors['isVerified'] = "Veuillez d'abord vérifier votre adresse e-mail.";
          }
          else if (error.response && error.response.status === 401) {
            this.errors['notExist'] = "Cet usilisateur n'existe pas";
          }
      }
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
      margin-top: 90px;
      margin-left: 125px ;
    }
    h1{
      display: flex;
      justify-content: center;
      color:#EE964B;
      font-weight: bolder;
      padding-bottom:20px;
    }
  form{
    display:flex;
    flex-direction: column;
    width: 40%;
    height: 370px;
    padding: 0;
    border-left: none;
    background-color: #E6D6D0;
    padding-top: 40px;
    border-top-right-radius:50px;
    border-bottom-right-radius:50px;
    box-shadow: 8px 0px;
  }
  .image{
    display: flex;
    align-items: center;
    width: 25%;
    height: 370px;
    padding: 0;
    background-color: #E6D6D0;
    border-top-left-radius:50px;
    border-bottom-left-radius:50px;
  }
  .image img{
    width: 70%;
    padding-top: auto;
    padding-bottom: auto;
    margin-left: 70px;
    z-index: 1;
  
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
  }
  .pass{
    width: 100%;
    margin-top:3px;
    margin-left: 80px;
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
    width:40%;
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
  .image.has-errors{
    height: 400px;
  } 
  #Lastp{
    color:#EE964B;
    text-decoration: underline;
    font-weight: light;
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
    