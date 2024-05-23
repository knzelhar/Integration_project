<template>
  <div class="proposSect">
    <nav>
        <div class="nav-content">
        <ul id="menuList"   :class="this.showMobileMenu ? 'open-menu' : 'closed-menu'">
          <li class="logo"><router-link to="/"><span class="Enfants">Enfants</span>Innova</router-link></li>
        <li><router-link to="/">Accueil</router-link></li>
        <li><router-link to="/">A propos</router-link></li>
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
    <section class="sect0">
        <div class="section">
            <p class="p1">A propos</p>
            <br>
            <p class="texte">
                Depuis 2005, notre entreprise propose des activités ludiques et éducatives pour les enfants, allant du jeu d'échecs à la robotique, en passant par la programmation et bien d'autres. Reconnus comme leaders dans notre domaine, des millions d'enfants ont déjà bénéficié de nos programmes. Notre engagement envers leur bien-être et leur développement reste notre priorité, et nous continuons notre mission avec passion.    </p> 
       </div>
        <div class="images">
            <img class="image1" src="../assets/pic3.png">
            <img class="image" src="../assets/kid2.png">
        </div>
    </section>
    <section class="section1">
      <div class="bossImg">
        <img src="static/img/leader.png" style="width: 50%; height: 50%;">
      </div>
      <div class="bossInfo">
        <p class="p2">Adam Benllwali</p>
        <br>
        <p>Propriétaire et PDG de notre société, est un leader chevronné avec plus de 15 ans d'expérience dans le domaine des affaires. Diplômé en Gestion des Affaires de l'Université de Paris, il a consacré sa carrière au développement d'une vision stratégique et à la promotion de la croissance de l'entreprise. En dehors du travail, Adam est passionné par l'entrepreneuriat chez les jeunes et participe activement à des initiatives caritatives locales. Pour le contacter, vous pouvez le joindre par téléphone au +212 123 456 789 ou par e-mail à l'adresse adam.benllwali@exemple.com. Sa porte est toujours ouverte pour ceux qui partagent sa vision de l'avenir."</p>
      </div>
    </section>
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
  .sect0{
    padding-top: 50px;
    background: #F0F0F0;
    display: flex;
    height: 700px;
  }
  .p1{
    padding-top: 50px;
    padding-bottom: 2px;
    padding-left: 100px;
    text-align: center;
    color:#C49FD9;
  text-shadow: 
  -2px -2px 0 #000,
     0   -2px 0 #000,
     2px -2px 0 #000,
     2px  0   0 #000,
     2px  2px 0 #000,
     0    2px 0 #000,
    -2px  2px 0 #000,
    -2px  0   0 #000;
  font-weight:900;
  font-size: 40px;
  }
  .texte{
    width: 500px;
    padding-left: 100px;
    padding-top: 2px;
    font-size: 23px;
    text-align: center;
  }
  .images {
        position: absolute;
        left: 560px; 
    }
    .image1,
    .image {
        position: relative; 
    }
    .image1{
        width: 700px;
    }
    .image{
        top: -600px;
        left: 120px;
    }
    .section1{
      height: 900px;
      background-color: #F0F0F0;
    }
    .bossInfo{
  position: relative;
  width: 1100px;
  height:300px;
  padding: 40px;
  margin-right: 100px;
  margin-left: 100px;
  font-weight: bold;
  background-color: rgb(245, 237, 236);
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 15px  15px#EE964B;
  display: flex;
  flex-direction: column;
  align-items: center; 
  justify-content: flex-start; 
}
  .p2{
    font-weight: bolder;
    padding-left: -100px;
    align-self: flex-start;
  } 
  </style>