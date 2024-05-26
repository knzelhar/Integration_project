<template>
    <footer id="main-footer">
      <div class="footer-content">
        <div class="footer-logo">
          <div class="logo-container">
            <router-link to="/">
              <img class="logo" src="../assets/pic6.png">
            </router-link>
            <img src="static/img/footer2.png" alt="Kids Web App Logo" style="width: 1263px; height: 500px;">
            <div class="links-overlay">
              <ul>
                <li><router-link to="/" @click="scrollToTop">Accueil</router-link></li>
                <li><router-link to="/AproposVue">A propos</router-link></li>
                <li>
                  <router-link to="" style="cursor: default;">Services</router-link>
                  <ul class="dropdown-menu">
                    <li><router-link to="/ProgrammationVue">Programmation</router-link></li><br>
                    <li><router-link to="/RobotiqueVue">Robotique</router-link></li><br>
                    <li><router-link to="/LabVue">Laboratoire</router-link></li><br>
                    <li><router-link to="/chessVue">Jeux d'echc</router-link></li><br>
                    <li><router-link to="/ElectroVue">Electronique</router-link></li><br>
                    <li><router-link to="/AiVue">AI</router-link></li>
                  </ul>
                </li>
                <li><router-link to="/ContactVue">Contact</router-link></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="divider"></div> 
        <div class="footer-social">
          <p style="color: white; font-size: large; margin-bottom: 10px;">Suivez Nous</p>
          <div>
            <a href="https://www.facebook.com/"><img src="../assets/facebook.png" alt="Facebook" style="width: 30px; height: 30px;"></a>
            <a href="https://www.facebook.com/"><img src="../assets/instagram.png" alt="instagram" style="width: 30px; height: 30px;"></a>
            <a href="https://www.facebook.com/"><img src="../assets/twitter.png" alt="twitter" style="width: 30px; height: 30px;"></a>
            <a href="https://www.facebook.com/"><img src="../assets/youtube.png" alt="youtube" style="width: 30px; height: 30px;"></a>
            <a href="https://www.facebook.com/"><img src="../assets/telegramme.png" alt="telegram" style="width: 30px; height: 30px;"></a>
          </div>
        </div>
      </div>
    </footer>
  </template>
  
  <script>
  export default {
  name: 'footerVue',
  methods: {
    scrollToTop() {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    }
  }
}
  </script>
  
  <style scoped>
  footer {
    background-color: #f9f9f9;
    text-align: center;
  }
  
  .footer-content {
    position: relative;
    max-width: 1200px;
  }
  
  .logo-container {
    position: relative;
    height: 400px; 
    margin-bottom: 20px;
  }
  .logo-container img{
    width:110px;
  }
  
  .logo {
    position: absolute;
    top: 50%;
    left: 100px;
    transform: translate(-50%, -50%);
    cursor: pointer; 
  }
  
  .links-overlay {
    position: absolute;
    top: 0;
    left: 50px;
    width: 1200px;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .links-overlay ul {
    list-style-type: none;
    padding: 0;
  }
  
  .links-overlay ul li {
    display: inline;
    padding-right: 60px;
    position: relative;
  }
  
  .links-overlay ul li a {
    color: #fff;
    text-decoration: none;
    background-color: rgba(0, 0, 0, 0.5); 
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer; 
  }
  
  
  .dropdown-menu {
    position: absolute;
    top: 100%; 
    left: 0;
    background-color: transparent;
    display: block; 
    width: max-content; 
    padding: 10px;
  }
  
  .dropdown-menu li {
    display: block;
    padding: 5px 0;
  }
  
  .dropdown-menu li a {
    color: #fff;
    text-decoration: none;
    cursor: pointer; 
  }
  
  
  .footer-social {
    position: absolute;
    top: 380px;
    bottom: 0;
    left:660px;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  
  .footer-social a {
    padding: 5px 10px;
    cursor: pointer; 
  }
  
  
  .divider {
    border-top: 1px solid grey;
    width: 80%; 
    padding: 0 auto; 
  }
  </style>