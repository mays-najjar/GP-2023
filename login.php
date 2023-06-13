

<?php
// Start the session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  // User is logged in, perform necessary actions
  // For example, you can display a welcome message or redirect them to a member-only area
  echo "Welcome back, " . $_SESSION['username'] . "!";
} else {
  // User is not logged in

  // Check if the "remember me" cookie is set
  if (isset($_COOKIE['rememberme'])) {
      // Retrieve the user information from the cookie and log them in
      $username = $_COOKIE['rememberme'];

      // Perform any necessary validation or database lookup to verify the user

      // Set session variables
      $_SESSION['loggedin'] = true;
      $_SESSION['username'] = $username;

    //   echo "Welcome back, " . $_SESSION['username'] . "!";
  } else {
      // User is a guest, no session or cookie found
    //   echo "Welcome, guest!";

      // Perform actions for guest users
      // Any work done by the guest will not be saved after the website is closed
  }
}

// Login function - to be called when the user submits the login form
function login($username, $remember) {
  // Perform validation and database lookup to verify the user

  // Set session variables
  $_SESSION['loggedin'] = true;
  $_SESSION['username'] = $username;

  // Set "remember me" cookie if requested
  if ($remember) {
      $cookieExpiry = time() + (30 * 24 * 60 * 60); // Set cookie expiry to 30 days
      setcookie('rememberme', $username, $cookieExpiry);
  }

  // Redirect or perform other actions after successful login
  header('Location: member-area.php');
  exit;
}

// Logout function - to be called when the user logs out
function logout() {
  // Unset all session variables
  session_unset();

  // Destroy the session
  session_destroy();

  // Remove the "remember me" cookie if set
  setcookie('rememberme', '', time() - 3600);

  // Redirect or perform other actions after logout
  header('Location: index.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <link rel="icon" href="assets/img/GP.gif" sizes="16x16" >
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <title >GP-2023 </title>
    
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
      <script src="https://kit.fontawesome.com/5076f4faae.js" crossorigin="anonymous"></script>

       <!-- jquery -->
       <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <!-- sortable  -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>

</head>
<body>
<nav style="text-align: center;" id="nav">
         <div class='logo'>
         <img src='assets/img/logo.jpg'alt='logo' style="mix-blend-mode: multiply;width:200px ;" > </div>
 <div id="login"> <a href="index.php">Main page</a></div>
        </nav>

    <!----------------account page----------------->
<div class="account-page">
    <div class="container">
        <div class="row">

            <div class="col_2">
                <div class="form-container">
                    <div class="form-btn">
                        <span onclick="login()">Login</span>
                        <span onclick="register()">Register</span>
                        <hr id="indicator2">
                    </div>
                    
                    <form id="loginform" action=" " method="post">
                        <input type="text" name="username" required placeholder="User name">
                        <input type="password" name="password" required placeholder="Password">
                        <button type="submit" name="login" class="btn">Login </button>
                        <a href="#">Forget password</a>
                    </form>

                    <form id="regform" action=" " method="post"  enctype="multipart/form-data">
                        <input type="text" name="username" required placeholder="User name"> 
                        <input type="email" name="email" required placeholder="Email">
                        <input type="password" name="password" required placeholder="Password"> 
                        <input type="file" name="image" required >
                           <button type="submit" name="reg" class="btn">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- footer -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="footer-col-1">
                <a href="#"><h3 style="color:#333 ;">Developed by</h3></a>
                <p>Eng Afnan Aish</p>
                <p>Eng Hala Shraim</p>
                <p>Eng Mays Najjar</p>
                <!-- <div class="app-logo">
                    <img src="assets/img/play-store.jpg">
                    <img src="assets/img/app-store.jpg">
                </div> -->
            </div>

            <div class="footer-col-2">
                   <img src="assets/img/logo.jpg" style="mix-blend-mode: multiply;width:200px ;"  width="125px">
                
            </div>
           

            <div class="footer-col-3" >
                <h3>Contact us</h3>
                <ul>
                    <li>Linkedin</li>
                    <li>Email</li>
                    <br><br>
                    </ul>
                </div>
                </div>
                
            </div>
        </div>


        <!--------------js for toggle form---------------->
        <script>
            var loginform=document.getElementById("loginform");
            var regform=document.getElementById("regform");
            var indicator=document.getElementById("indicator2");
          
            function register(){
                regform.style.transform="translatex(0px)";
                loginform.style.transform="translatex(0px)";
                indicator.style.transform="translatex(60px)";
            }
            function login(){
                regform.style.transform="translatex(300px)";
                loginform.style.transform="translatex(300px)";
                indicator.style.transform="translatex(-55px)";

            }
        </script>
</body>
</html>
