<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login/Sign-up</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin="" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
  <div class="container">
    <!--login form -->
    <div class="login form-box">
      <form action="login_process.php" method="POST">
        <h1>Login</h1>
        
        <div class="input-box">
          <input type="text" placeholder="email" name="email" required>
          <box-icon type='solid' name='user'></box-icon>
        </div>
        <div class="input-box">
          <input type="password" placeholder="password" required name="password">
          <box-icon name='lock-alt' type='solid'></box-icon>
        </div>

        
        <div class="forgot-link">
          <a href = "#">Forgot Password</a>
        </div>
        <button type="submit" class="btn">Login</button>
        <p>Or Login with social platforms</p>

        <div class="social-icons">
          <a href="#"><box-icon name='google' type='logo'></box-icon></a>
          <a href="#"><box-icon name='facebook-square' type='logo'></box-icon></a>
          <a href="#"><box-icon name='linkedin-square' type='logo'></box-icon></a>
        </div>
      </form>
    </div>

    <!-- registeration-form -->

    <div class= "form-box register">
      <form action="signup_process.php" method="POST">
        <h1>Register</h1>
        
        <div class="input-box">
          <input type="text" placeholder="name" name="name" required>
          <box-icon type='solid' name='user'></box-icon>
        </div>
        <div class="input-box">
          <input type="text" placeholder="email" name="email" required>
          <box-icon type='solid' name='user'></box-icon>
        </div>
        <div class="input-box">
          <input type="password" placeholder="password" required name="password">
          <box-icon name='lock-alt' type='solid'></box-icon>
        </div>
        <div class="input-box">
           <select name="role" required>
           <option value="" hidden>Select Role</option>
           <option value="customer">Customer</option>
           <option value="owner">Owner</option>
      </select>
        </div>

      

        <button type="submit" class="btn">Register</button>
        <p>Or Register with social platforms</p>

        <div class="social-icons">
          <a href="#"><box-icon name='google' type='logo'></box-icon></a>
          <a href="#"><box-icon name='facebook-square' type='logo'></box-icon></a>
          <a href="#"><box-icon name='linkedin-square' type='logo'></box-icon></a>
        </div>
      </form>
    </div>
    <!--toggle-box -->
    <div class="toggle-box">
      <div class="toggle-panel toggle-left">
        <h1>Hello,Welcome!</h1>
        <p>Don't have an Account?</p>
        <button class="btn register-btn">Register</button>
      </div>

      <div class="toggle-panel toggle-right">
        <h1>Welcome-back!</h1>
        <p>Already have an Account?</p>
        <button class="btn login-btn">Login</button>
      </div>
    </div>
  </div>

  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
  <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
  <script src="js/script.js"></script>
</body>

</html>