<template>
    <div class="commentSect">
    <h1>FeedBack De Nos Chers Utilisateurs</h1>
    <div class="comment-container">
      <div class="comment" id="cmt1">
        <div class="icon">
          <img src="../assets/quotation.png">
        </div>
        <div class="text">
          <p>La section de programmation dans votre application est fantastique ! Notre enfant apprend à coder de manière ludique et interactive.</p>
          <br>
          <p class="user1">
            <strong>Sara El-otmani</strong><br>Maman<br>Meknes,Maroc
          </p>
        </div>
      </div>
  
      <div class="comment" id="cmt2">
        <div class="icon">
          <img src="../assets/quotation.png">
        </div>
        <div class="text">
          <p>Les expériences de chimie proposées dans votre application sont incroyables. Notre enfant s'amuse tout en découvrant les merveilles de la science.</p>      
          <br>
          <p class="user2">
            <strong>Molly</strong><br>Maman<br>Paris,France
          </p>
        </div>
      </div>
  
      <div class="comment" id="cmt3">
        <div class="icon">
          <img src="../assets/quotation.png">
        </div>
        <div class="text">
          <p>Merci pour la variété d'activités que vous proposez. Notre enfant s'amuse tout en apprenant de nouvelles choses chaque jour.</p>
          <br>
          <p class="user3">
            <strong>Amin</strong><br>Papa<br>Casa,Maroc
          </p>      
        </div>
      </div>
  
      <div class="comment" id="cmt4">
        <div class="icon">
          <img src="../assets/quotation.png">
        </div>
        <div class="text">
          <p>Nous recommandons vivement votre application à d'autres parents à la recherche d'un moyen pratique et efficace de gérer les activités de leurs enfants. Merci pour votre excellent service !</p>
          <br>
          <p class="user4">
            <strong>Abdellkadder</strong><br>Tuteur<br>Alger,Algerie
          </p>      
        </div>
      </div>
    </div>
  </div>
  </template>
  
  <script>
  
  </script>
  
  <style scoped>
  .comment-container {
    display: flex;
    justify-content: space-between;
    margin: 50px;
  }
  .commentSect{
    background-color: #F0F0F0;
    padding-top: 80px;
  }
  h1{
    padding-left: 30px;
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
  }
  .comment {
    position: relative;
    width: 20%;
    height: 500px;
    padding: 40px;
    padding-top: -20px;
    margin: 20px;
    font-weight: bold;
    background-color: #fff;
    border: 2px solid #000;
    border-radius: 20px;
    overflow: hidden;
  }
  
  .comment::before {
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
  
  .icon {
    position: absolute;
    padding-top: -5px; 
    left: 20px;
    size-adjust: 10px;
  }
  
  .comment .text {
    text-align: center;
    margin-top: 20px; 
    padding-top: 20px;
  }
  img{
    width: 30px;
  }
  .user1{
    position: relative;
    top:70px;
  }
  .user2{
    position: relative;
    top:70px;
  }
  .user3{
    position: relative;
    top:95px;
  }
  #cmt1{
    box-shadow: 15px  15px #f6d233;
  }
  #cmt2{
    box-shadow: 15px 15px #EE964B;
  }
  #cmt3{
    box-shadow: 15px 15px #d52f2f;
  }
  #cmt4{
    box-shadow: 15px 15px #760885;
  }

  </style>