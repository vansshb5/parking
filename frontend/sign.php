<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Home</title>
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="css/style.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  
</head>
<body>
  <!-- HEADER -->
  <section class="header">
    <a href="sign.php" class="logo">parking.</a>
    <nav class="navbar">
      <a href="login.php">login</a>
     

    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
  </section>
<!--home-->
<section class="home">
    <div class="home-slider swiper">
        <div class="swiper-wrapper">
            <div class="slide swiper-slide" style="background:url(images/home-slide-1.png) no-repeat">
             <div class="content">
                  <span>explore, discover , travel</span>
                  <h3>park around the world</h3>
                  <a href="package.php" class="btn">discover more</a>
                </div>
            </div>
            <div class="slide swiper-slide" style="background:url(images/home-slide-2.png) no-repeat">
                <div class="content">
                  <span>explore, discover , travel</span>
                  <h3>park around the world</h3>
                  <a href="package.php" class="btn">discover more</a>
                </div>
            </div>
            <div class="slide swiper-slide" style="background:url(images/home-slide-3.png) no-repeat">
                <div class="content">
                  <span>explore, discover , travel</span>
                  <h3>travel around the world</h3>
                  <a href="package.php" class="btn">discover more</a>
                </div>
            </div>
        </div>
         <div class="swiper-button-next">></div>
        <div class="swiper-button-prev"><</div>
 
    </div>

</section>
  <!-- FOOTER -->
  <section class="footer">
    <div class="box-container">
      <div class="box">
        <h3>quick links</h3>
        <a href="sign-in.php"><i class="fas fa-angle-right"></i>sign-in</a>
        <a href="login.php"><i class="fas fa-angle-right"></i>login</a>
       
      </div>

      <div class="box">
        <h3>extra links</h3>
        <a href="#"><i class="fas fa-angle-right"></i>ask questions</a>
        <a href="#"><i class="fas fa-angle-right"></i>about</a>
        <a href="#"><i class="fas fa-angle-right"></i>privacy policy</a>
        <a href="#"><i class="fas fa-angle-right"></i>terms of use</a>
      </div>

      <div class="box">
        <h3>contact info</h3>
        <a href="#"><i class="fas fa-phone"></i>+91 8699771214</a>
        <a href="#"><i class="fas fa-envelope"></i>vansshbhargav@gmail.com</a>
        <a href="#"><i class="fas fa-map"></i>chandigarh, india</a>
      </div>

      <div class="box">
        <h3>follow us</h3>
        <a href="#"><i class="fab fa-instagram"></i>instagram</a>
        <a href="#"><i class="fab fa-x"></i>X</a>
        <a href="#"><i class="fab fa-linkedin"></i>linkedin</a>
      </div>
    </div>

    <div class="credit"> <span></span></div>
  </section>

 <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
  <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
  <script src="js/script.js"></script>
</body>
</html>
