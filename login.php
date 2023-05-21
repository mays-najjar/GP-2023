

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
                <a href="#"><h3>Download our App</h3></a>
                <p>Download App for Android and ios mobile phone</p>
                <!-- <div class="app-logo">
                    <img src="assets/img/play-store.jpg">
                    <img src="assets/img/app-store.jpg">
                </div> -->
            </div>

            <div class="footer-col-2">
                   <img src="assets/img/logo.jpg" style="mix-blend-mode: multiply;width:200px ;"  width="125px">
                <p>Developed by Afnan , Hala , Mays.</p>
            </div>
           

            <div class="footer-col-3" >
                <h3>Contact us</h3>
                <ul>
                    <li>Facebook</li>
                    <li>Instagram</li>
                    <li>Tiktok</li>
                    <li>Snapchat</li>
                </ul>
                </div>
                </div>
                <hr>
                <p class="copy-right">Copyright 2022 - Intos Art</p>
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
