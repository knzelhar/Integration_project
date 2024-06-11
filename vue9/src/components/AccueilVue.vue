<template>
  <section class="mainSect">
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
                    <router-link to="/">Laboratoires</router-link>
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
      <div class="menu-icon">
            <i class="fa fa-bars" @click="showMenu"></i>
      </div>
    </nav>
    <div class="all">
    <div class="mainText">
      <p id="p1" :class="{ hide: isMenuOpen }">Vos enfants méritent le meilleur:
        <img src="../assets/underline.svg">
      </p>
      <p id="p2">Faites-leurs découvrir notre entreprise</p>
      <p id="p3">Paradis des activités enfantines</p>
      <span class="typed-text">{{ typeValue }}</span>
      <span class="cursor" :class="{'typing': typeStatus}">&nbsp;</span>
      <div class="boyImg">
        <button><router-link to="/">S'inscrire</router-link>
      </button>
      <img src="../assets/boy.webp" alt="boy">
      </div>
      </div>
      <div class="mainImages">
        <div class="chess"><img  src="../assets/chess.png" alt="chess">
          <div class="purpleC">
            <img src="../assets/star.svg" class="star">
            <img src="../assets/messyline.svg" class="line">
          </div>
        </div>
        <div class="chem"><img src="../assets/chem.png" alt="chemestry">
          <div class="orangeC"></div>
          <img src="../assets/spiral.svg" class="spiral">
          <img src="../assets/code.svg" class="code">
          <img src="../assets/star2.svg" class="star2">
          <img src="../assets/spiral.svg" class="spiral2">
        </div>
        <div class="robot"><img  src="../assets/robot2.png" alt="robot">
          <div class="purpleC2">
            <img src="../assets/flower.svg" class="flower">
          </div>
        </div>
        <div class="ai"><img  src="../assets/ai.png" alt="ai"></div>
      </div>
    </div>
  </section>
</template>
<script>

export default {
data() {
return {
showMobileMenu: false,
isMenuOpen: false,
typeValue: '',
typeStatus: false,
typeArray: ['Programmation', 'Robotique', 'Laboratoires', "Jeux d'échecs",'Electronique','Intelligence Artificielle'],
typingSpeed: 100,
erasingSpeed: 90,
newTextDelay: 2000,
typeArrayIndex: 0,
charIndex: 0,

};

},
methods: {
showMenu() {
this.showMobileMenu = !this.showMobileMenu;
this.isMenuOpen = !this.isMenuOpen;
},
typeText() {
        if(this.charIndex < this.typeArray[this.typeArrayIndex].length) {
          if(!this.typeStatus)
            this.typeStatus = true;

          this.typeValue += this.typeArray[this.typeArrayIndex].charAt(this.charIndex);
          this.charIndex += 1;

          setTimeout(this.typeText, this.typingSpeed);
        }
        else {
          this.typeStatus = false;
          setTimeout(this.eraseText, this.newTextDelay);
        }
      },
      eraseText() {
        if(this.charIndex > 0) {
          if(!this.typeStatus)
            this.typeStatus = true;

          this.typeValue = this.typeArray[this.typeArrayIndex].substring(0, this.charIndex - 1);
          this.charIndex -= 1;
          setTimeout(this.eraseText, this.erasingSpeed);
        }
        else {
          this.typeStatus = false;
          this.typeArrayIndex += 1;
          if(this.typeArrayIndex >= this.typeArray.length)
            this.typeArrayIndex = 0;

          setTimeout(this.typeText, this.typingSpeed + 1000);
        }
      }
    },
    created() {
      setTimeout(this.typeText, this.newTextDelay + 200);
    },
    /*methods for image slider */
};
</script>
<style scoped>
*{
  padding:0;
  margin: 0;
  box-sizing: border-box;
}
body, html {
  overflow-x: hidden;
  width: 100%; 
  height: 100vh; 
}
/*#E6D6D0*/
.mainSect {
  position: relative; 
  background-color: #F0F0F0;
  overflow-x:hidden;
  overflow-y:hidden;
  height: 560px;
}
.mainSect::before {
  content: '';
  position: absolute;
  top: 0;
  left: 41%; 
  width: 41%; 
  height: 100%;
  background: blue;
  border-bottom-right-radius: 200px; 
  transform: translateX(-100%); 
}

.mainSect::after {
  content: '';
  position: absolute;
  top: 0;
  left: 60%; 
  width: 60%; 
  height: 100%;
  transform: translateX(0); 
}
nav{
  position: relative;
  padding-left: 55px;
  z-index: 1;
}
nav ul{
  display: flex;
  list-style: none;
  padding-top: 41px;
}
nav ul li{
  padding-right: 60px;
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
  padding-left: 130px;
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
.menu-icon{
  display: none;
}
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
#SignupBtn img{
position: absolute;
width: 150px;
top:-20px;
right: 10px;
}
#loginBtn a{
  color:#EE964B;
}
.mainText #p1{
  position: relative;
  width:500px;
  font-size: 36px;
  text-align: center;
  z-index: 1;
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
  padding-top: 35px;
}
.mainText #p1 img {
  position: absolute;
  bottom: -30px;
  left: 40%;
  width: 100px;
}
.mainText #p2{
  position: relative;
  width:500px;
  font-size: 20px;
  font-weight: bolder;
  padding-top: 45px;
  padding-left: 37px;
}
.mainText #p3{
  position: relative;
  width:500px;
  font-size: 20px;
  font-weight: bolder;
  padding-top: 10px;
  padding-left: 37px;
  padding-bottom: 10px;
  color:#EE964B;
}
.mainText #p4{
  position: relative;
  width:500px;
  font-size: 20px;
  font-weight: bolder;
  padding-top: 10px;
  padding-left: 45px;
  padding-right: 45px;
}
.mainText button{
  position:relative;
}

.mainText button{
  background-color: #EE964B;
  border-radius: 20px;
  padding-top: -4px;
  padding-bottom: 7px;
  padding-left: 30px;
  padding-right: 50px;
  border: 2px solid black;
  margin-top: 80px;
  margin-left: 120px;
  
}
.mainText button a{
 color:black;
 text-decoration: none;
 font-weight: bolder;
}
.mainText button:hover{
  color: black;
  opacity: 90%;
}
.boyImg{
  position:relative;
}
.boyImg img{
  position: absolute;
  width:80px;
  left: 220px;
  bottom: -30px;
}
.all{
  display: flex;
}
.mainImages{
  position: relative;
  display: flex;
flex-wrap: wrap;
align-items: center;
margin-top: 70px;
margin-left: 100px;

}
.mainImages img{
  margin-right: 80px ;
}

.mainImages .chem img{
  width: 170px;
	position: relative;
  top: -15px;
  left: 50%;
  transform: translateX(-50%);
}
.mainImages .chem{
  width:200px;
  background-color: #AFAFDC;
  border-radius: 41px;
  border:3px solid black;
  height: 128px;
  margin-left: 20px;
  position:relative;
}
.orangeC{
  position:absolute;
  background: #EE964B;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    bottom: -6px; 
  left: 175px;
}
.mainImages .chem .spiral{
  width: 30px;
  position:absolute;
  top: 150px;
  left: -30px;
}
.mainImages .chem .spiral2{
  width: 30px;
  position:absolute;
  top: -50px;
  left: -50px;
}
.mainImages .chem .code{
  width: 40px;
  position:absolute;
  top: 160px;
  left: 200px;
}
.mainImages .chem .star2{
  width: 30px;
  position:absolute;
  top: -60px;
  left: 170px;
}
.mainImages .chess img{
  width:220px;
  position: relative;
  top: -23px;
  left: 40%;
  transform: translateX(-50%);
}
.mainImages .chess{
  width: 200px;
  height: 128px;
  margin-right: 90px;
  margin-left: 30px;
  background-color: #F9DC5C;
  border-radius: 41px;
  border:3px solid black;
  position:relative;
}
.mainImages .chess .star{
  width: 30px;
  position: absolute;
  left: -200px;
  top:50px;
}
.mainImages .chess .line{
  width: 35px;
  position: absolute;
  left: -230px;
  top:-110px;
}
.purpleC{
  position:absolute;
  background: #AFAFDC;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    bottom: -6px; 
  left: 170px;
}
.mainImages .robot img{
  width:230px;
  position: relative;
  top: -35px;
  left: 64%;
  transform: translateX(-50%);
}
.mainImages .robot{
  width:200px;
  background-color: #E6C6BB;
  border-radius: 41px;
  border:3px solid black;
  height: 128px;
  margin-right: 90px;
  margin-left: 30px;
  margin-top: 100px;
  position:relative;
}
.purpleC2{
  position:absolute;
  background: #AFAFDC;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    bottom: -3px; 
  left: 170px;
}
.mainImages .robot .flower{
  width: 40px;
  position: absolute;
  left: 80px;
  top:-40px;
}
.mainImages .ai img{
  width:195px;
  position: relative;
  top: 13px;
  left: 57%;
  transform: translateX(-50%);
}
.mainImages .ai{
  width:200px;
  background-color: #EBE5E5;
  border-radius: 41px;
  border:3px solid black;
  height: 128px;
  margin-top: 100px;
  margin-left: 25px;
}
.Enfants
{

  font-weight: 900;
  color:#EE964B;
}

.logo a {
  display: flex;
  align-items: center; 
  font-size: 1em; 
}
span.cursor {
      display: inline-block;
      margin-left: 3px;
      width: 4px;
      background-color: black;
      animation: cursorBlink 1s infinite;
      position:relative;
    }

    span.cursor.typing {
      animation: none;
      position:relative;
    }
.typed-text{
  position: relative;
  margin-left: 37px;
  font-weight:bolder;
  font-size: 20px;
}
  @keyframes cursorBlink {
    49% { background-color: black; }
    50% { background-color: transparent; }
    99% { background-color: transparent; }
  }
/*=====================
style for image slider
======================
*/
.imageSlider{
  background-color: #F0F0F0;
}

@media screen and (max-width: 1273px) and (min-width:1058px){

nav ul li{
  padding-right: 30px;
  text-align: center;
}
nav ul li a{
  font-size:smaller;
}


.dropdown{
  padding-left: 300px;
  padding-right: 40px;
}
.mainSect::before {
    left: 45%; 
 width:45%;
  }
  .mainImages .orangeC,
  .mainImages .spiral,
  .mainImages .code,
  .mainImages .star,
  .mainImages .star2,
  .mainImages .spiral2,
  .mainImages .purpleC,
  .mainImages .purpleC2,
  .mainImages .line,
  .mainImages .flower {
    display: none;
  }
  .chess,.chem,.robot,.ai{
      margin: 5px !important;
    }
    .mainImages{
      /*margin-top: 20px;
      margin-left:80px!important ;
      height: 450px;
      width:800px;*/
      display: flex;
      justify-content: center;
    }
    .chess,.robot{
      margin-right: 40px !important;
    }

}
@media screen and (max-width: 1058px) and (min-width:1015px){

  nav ul li{
    padding-right: 30px;
  }
  nav ul li a{
  font-size:smaller;
}
  .dropdown{
    padding-left: 170px;
    padding-right: 5px;
  }
  .mainText {
  position: relative;
}

.mainText img {
  position: absolute;
  bottom: 90px; 
  left: 17%;
}
.mainSect::before {
    left: 50%; 
 width:50%;
  }
  .boyImg{
    width: 300px;
    height: 300px;
  }
  .boyImg img{
    left: 220px;
    top: 10px;
  }
  .dropdown{
  padding-right: 35px;
  padding-left: 170px;
}
  .mainImages .orangeC,
  .mainImages .spiral,
  .mainImages .code,
  .mainImages .star,
  .mainImages .star2,
  .mainImages .spiral2,
  .mainImages .purpleC,
  .mainImages .purpleC2,
  .mainImages .line,
  .mainImages .flower {
    display: none;
  }
  .chess,.chem,.robot,.ai{
      margin: 5px !important;
    }
    .mainImages{
      margin-top: 20px;
      height: 450px;
    }

}

@media screen and (width: 1024px) {
  .boyImg{
    height: 300px;
  }
  .boyImg img{
    top: 50px;
    left: 210px;
  }
  nav ul li a{
  font-size:smaller;
}

}
@media screen and (max-width: 1015px){
  .mainSect::before,
  .mainSect::after {
    display: none;
  }
  .mainSect{
    position: relative;
    background-color:#F0F0F0 ;
    display: flex;
    justify-content: center;
  }
  .boyImg img{
    top:-50px;
    left: 270px;
  }
  .boyImg button{
    display:flex;
    margin:60px auto
  }
  .mainText{
    padding-top: 60px;
    text-align: center;
  }
nav{
  position: fixed;
  padding: 10px 75px;
}
ul{
  display: flex;
  flex-direction: column;
  position: absolute;
  width: 100%;
  background-color: rgb(235, 208, 166);
  padding: 25px;
  top: 100%;
  left: -90px;
  transition: all 0.3s ease-in-out;
}
ul li{
  padding-top: 12px;
  padding-bottom: 12px;
  width: 230px;
  text-align: center;
}
nav ul li a{
  font-size:smaller;
}
.menu-icon{
  display: block;
  background-color: #F0F0F0;
}
.menu-icon i{
  display: block;
  color: black;
  padding-top: -20px;
  padding-left: 20px;
  font-size: 30px;
  cursor: pointer;
  position: relative;
  z-index: 1;
  background-color: #F0F0F0;
}
.open-menu {
opacity: 1;
height: 450px;
width: 400px;
text-align: center;
}
.open-menu li{
  padding-right: 0;
  padding-left: 108px;
  text-align: center;
}
.open-menu .dropdown{
  margin-left: 12px;
}
.closed-menu{
opacity: 0;
height: 0;
padding: 0;

}
.dropdown{
  position: relative;
  width: 215px;
  padding-left: 0px;

}
.dropdown-content{
  z-index: 1;
    position: absolute;
    top: calc(70% + 10px); 
    width: auto;
    min-width: 160px; 
    background-color: #f1f1f1; 
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
}
.mainText #p1.hide {
    display: none;
  }
  
}
  @media screen and (max-width: 1014px) and (min-width: 240px){
    .mainSect{
      height: 1100px;
    }
    .mainText #p1{
      font-size: 19px;
    }
    .mainText #p2{
      font-size: 15px;
    }
    .mainText #p1 img{
      width: 70px ;
      left: 43%;
      top:60px;
    }
    nav ul li a{
  font-size:smaller;
}
    .all{
      display: flex;
      flex-direction: column;
    }
    .mainImages .orangeC,
  .mainImages .spiral,
  .mainImages .code,
  .mainImages .star,
  .mainImages .star2,
  .mainImages .spiral2,
  .mainImages .purpleC,
  .mainImages .purpleC2,
  .mainImages .line,
  .mainImages .flower {
    display: none;
  }
    .mainImages{
      display: flex;
      flex-direction: column;
      justify-content: center;
      margin: 0px;
    }
    .chess,.chem,.robot,.ai{
      margin: 20px !important;
    }
  .chess img, .chem img,.robot img,.ai img{
    display: flex;
    justify-content: center;
  }
  .menu-icon{
  display: block;
  background-color: #F0F0F0;
  position: fixed; 
  top:15px;
  right: 50px;
}
.menu-icon i{
  padding-left: 0px !important;
  background-color: #F0F0F0;
}
.typed-text{
  position: relative;
  margin-left: -10px;
  font-weight:bolder;
  font-size: 20px;
}
#ai2{
  width: 300px;
}
  }
  @media screen and (max-width: 300px){
    .mainText #p1{
      font-size: 13px;
    }
    .mainText #p1 img{
      width: 50px;
      left: 225px;
      top:53px;
    }
    .mainText #p2{
      font-size: 13px;
    }
    .mainText #p3{
      font-size: 13px;
    }
  }
</style>