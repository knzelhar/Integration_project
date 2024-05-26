<template>
    <div class="mainContact">
        <nav>
        <div class="nav-content">
        <ul id="menuList"   :class="this.showMobileMenu ? 'open-menu' : 'closed-menu'">
          <li class="logo"><router-link to="/"><span class="Enfants">Enfants</span>Innova</router-link></li>
        <li><router-link to="/">Accueil</router-link></li>
        <li><router-link to="/AproposVue">A propos</router-link></li>
        <li class="dropdown">
                <button class="dropbtn">Services</button>
                <div class="dropdown-content">
                    <router-link to="/ProgrammationVue">Programmation</router-link>
                    <router-link to="/RobotiqueVue">Robotique</router-link>
                    <router-link to="/LabVue">Laboratoires</router-link>
                    <router-link to="/chessVue">Jeux d'échecs</router-link>
                    <router-link to="/ElectroVue">Electronique</router-link>
                    <router-link to="/AiVue">Intelligence Artificielle</router-link>
                </div>
              </li>
        <li><router-link to="/ContactVue">Contact</router-link></li>
        <li id="loginBtn" ><router-link to="/loginForm">Se connecter</router-link></li>
          <li id="SignupBtn"><router-link to="/SignupForm">S'inscrire</router-link>
          </li>
        </ul>
      </div>
    </nav>
    <div class="boxs">
      <div class="box" id="box1">
        <div class="icon">
          <img src="../assets/panneau-de-localisation.png">
        </div>
        <div class="iconName">
          <p>NOTRE GROUPE PRINCIPAL</p>
        </div>
        <div class="text">
          <p>Rue 94 Hay Hamria, Meknes </p>
        </div>
      </div>
      <div class="box" id="box2">
        <div class="icon">
          <img src="../assets/telephone.png">
        </div>
        <div class="iconName">
          <p class="p1">NUMERO DE TELEPHONE</p>
        </div>
        <div class="text">
          <!-- Ajouter un lien tel: pour le numéro de téléphone -->
          <a href="tel:+212666777000">+212 666 777 000</a>
        </div>
      </div>
      <div class="box" id="box3">
        <div class="icon">
          <img src="../assets/fax.png">
        </div>
        <div class="iconName">
          <p class="p1"> FAX</p>
        </div>
        <div class="text">
          <!-- Ajouter un lien tel: pour le numéro de fax -->
          <a href="tel:+212566777000">+212 566 777 000</a>
        </div>
      </div>
      <div class="box" id="box4">
        <div class="icon">
          <img src="../assets/email.png">
        </div>
        <div class="iconName">
          <p class="p1">NOTRE EMAIL</p>
        </div>
        <div class="text">
          <!-- Ajouter un lien mailto: pour l'adresse e-mail -->
          <a href="mailto:saraelotmani@gmail.com">saraelotmani@gmail.com</a>
        </div>
      </div>
    </div>
    <footerVue></footerVue>
    </div>
  </template>
  <script>
 import footerVue from '../components/footerVue.vue'
  export default{
  components:{
    footerVue
  }
  
}
  </script>
  
  <style scoped>
  .mainContact{
    background-color: #F0F0F0;
  }
  nav{
  position: fixed;
  width: 100%;
  padding-left: 75px;
  z-index: 1;
  background-color: #F0F0F0;
  padding-bottom: 3px;
}
nav ul{
  display: flex;
  list-style: none;
  padding-top: 41px;
}
nav ul li{
  padding-right: 80px;
}
nav ul li a{
  text-decoration: none;
  color: black;
  font-weight: bold;
  position:relative;
}
nav ul li a:hover{
  color: #EE964B;
}
.dropbtn {
  background-color: #EE964B;
  color: white;
  padding: 13px;
  font-size: 16px;
  border: none;
}

.dropdown {
  position: relative;
  display: inline-block;
  margin-top: -10px;
  padding-right: 80px;
  padding-left: 10px;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #e3a671;}
#SignupBtn a{
  background-color: #EE964B;
  border-radius: 20px;
  padding-top: 7px;
  padding-bottom:7px;
  padding-left: 15px;
  padding-right: 20px;
  border: 2px solid black;
  position:relative;
}
#SignupBtn a:hover{
  color: black;
  opacity: 90%;

}
  .boxs {
    margin-right: 100px;
    margin-left: 120px;
    padding-top: 170px;
    display: flex;
    flex-wrap: wrap;
  }
  
  .box {
    position: relative;
    width: 300px;
    height: 200px;
    padding: 40px;
    margin-right: 100px;
    margin-left: 100px;
    margin-bottom: 100px;
    font-weight: bold;
    background-color: #fff;
    border: 3px solid #000;
    border-radius: 20px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: center; 
    justify-content: flex-start;
    transition: transform 0.4s ease; 
  }
  .box:hover{
    transform: scale(1.06);
    cursor: pointer;
  }
  #box1{
    box-shadow: 15px  15px #f6d233;
  }
  #box2{
    box-shadow: 15px  15px #EE964B;
  }
  #box3{
    box-shadow: 15px  15px #d52f2f;
  }
  #box4{
    box-shadow: 15px  15px #760885;
  }
  .box::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 20px 20px 0 0;
    border-color: #000 transparent transparent transparent;
  }
  .box .icon {
    text-align: center;
  }
  .icon img{
    width: 45px;
  }
  .box .iconName{
    margin-top: 30px;
  }
  .box .text {
    margin-top: -20px; 
  }
  </style>