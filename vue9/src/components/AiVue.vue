<template>
    <div class="mainSect">
        <section class="imgBackg">
            <div class="dark-overlay"></div>
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
    <div class="text">
        <h1>Petits Génies de l’IA : L’Aventure des Enfants dans le Monde de l’Intelligence Artificielle</h1>
    </div>
</section>
<section class="description">
    <div class="descimg">
        <img src="../assets/ai3.jpg">
    </div>
    <div class="desctext">
<p>Votre enfant est invité à plonger dans l’univers passionnant de l’intelligence artificielle lors de notre atelier spécialement conçu pour les jeunes esprits curieux. À travers des activités ludiques et éducatives, ils apprendront comment l’IA façonne notre avenir, tout en s’amusant à créer des projets interactifs. C’est une aventure inoubliable où chaque enfant devient un petit scientifique, découvrant les merveilles de la technologie tout en s’amusant.</p>    
</div>
</section>
    </div>
</template>
<script>
</script>
<style scoped>
.mainSect{
    width: 100%;
    height: 100vh;
}
.imgBackg{
    height: 700px;
    width: 100%;
    background-image: url('../assets/ai2.jpg');
    background-size:cover;
    background-position: top;
    background-repeat: no-repeat;
    background-attachment: fixed;
    position: relative;
}
.dark-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7); /* Couleur de fond sombre avec opacité */
    z-index: 0; /* Assurez-vous qu'il est en dessous de tous les autres éléments */
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
.text h1{
    color:white;
    z-index: 1;
    position: absolute;
    top:300px;
    text-align: center;
    font-weight: 900;
    width: 700px;
    left: 270px;
    z-index: 0;
}
.description{
    position: relative;
    display: flex;
    height: 700px;
    background-color: #F0F0F0;
    padding-left: 100px;
    padding-top: 130px;
}
.desctext p{
    color:black;
    padding-left: 150px;
}
.descimg img{
    width: 500px;
    box-shadow: 30px 30px #EE964B;
}
p{
    width: 500px;
    font-weight: 600;
    font-size: large;
    text-align: center;
}
</style>