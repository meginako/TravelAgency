<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Home Page</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="style.css">
        
    </head>

    <body>
      <div class="nav">    
        <img src="images/Logo.png" height="70px" width="160px">

          <div class="nav-inside">
            <a href="#services">Product and services</a>&nbsp; &nbsp;
            <a href="fpdf184/Approval_Doc.php">Contact</a><br>&nbsp; &nbsp;
            <a href="fpdf184/Notebook_Doc.php">About us</a><br>&nbsp; &nbsp;

            <div class="dropdown show">
              <a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Login
              </a>
            
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="pro/signin.php">Client</a>
                <a class="dropdown-item" href="pro/agencysignin.php">Agency</a>
                <a class="dropdown-item" href="pro/managersignin.php">Manager</a>
                <a class="dropdown-item" href="pro/marketingsignin.php">Marketing</a>
                <a class="dropdown-item" href="pro/adminsignin.php">Admin</a>
              </div>
            </div> 
            &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
            
            <a href="pro/individual_reg.php"><button type="button" class="btn btn-primary">Register</button></a>
            
            &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
          </div>

          
      </div>

      <br>
      <img src="images/huge.gif" alt="kot" style="width:100%;height:600px;">

<h1 id="services">Our services</h1>

  <div class="card-carousel">
    <div class="card" id="1">
      <div class="image-container"></div>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, explicabo!</p>
    </div>
    <div class="card" id="2">
      <div class="image-container"></div>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, explicabo!</p>
    </div>
    <div class="card" id="3">
      <div class="image-container"></div>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, explicabo!</p>
    </div>  
    <div class="card" id="4">
      <div class="image-container"></div>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, explicabo!</p>
    </div>

    <div class="card" id="5">
      <div class="image-container"></div>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, explicabo!</p>
    </div>
  </div>
  <a href="#" class="visuallyhidden card-controller">Carousel controller</a>

<br><br><br><br><br><br>

<div class="footer-dark">
  <footer>
      <div class="container">
          <div class="row">
              <div class="col-sm-6 col-md-3 item">
                  <h3>Services</h3>
                  <ul>
                      <li><a href="#">Book or save trips</a></li>
                      <li><a href="#">Manage trips</a></li>
                      <li><a href="#">Manage employees</a></li>
                  </ul>
              </div>
              <div class="col-sm-6 col-md-3 item">
                  <h3>About</h3>
                  <ul>
                      <li><a href="#">Company</a></li>
                      <li><a href="#">Team</a></li>
                      <li><a href="#">Pricing</a></li>
                  </ul>
              </div>
              <div class="col-md-6 item text">
                  <h3>Where To</h3>
                  <p>Our company aims to bring together clients who are looking for traveling facilities together with agencies which would offer their services to a bogger market of clients.</p>
              </div>
              <div class="col item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a></div>
          </div>
          <p class="copyright">Where To © 2022</p>
      </div>
  </footer>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

<script src="script.js"></script>

</body>
</html>