<?php  

function footer(){
echo '
<footer>
        <div class="footer-content">
          <div class="main-footer">
            <div id="contact">
              <h4>Contact us</h4>

              <div class="contact-section">
                <p>Email &nbsp;&nbsp;:</p>
                <a href="mailto:commerce@gmail.com"
                  >commerce@gmail.com</a
                >
              </div>
              <div class="contact-section">
                <p>Phone &nbsp;:</p>
                <a href="tel:+212600000000">+212 6 15 41 23 65</a>
              </div>
              <div class="contact-section">
                <p>Fax &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</p>
                <a href="tel:+212600000000">+212 5 18 00 10 20</a>
              </div>
            </div>

            <div class="seperator"></div>

            <div id="about">
              <h4>About Us</h4>
              <div class="about-img-frame">
                <img src="images/roofTopSwordmanMad.png" alt="" />
              </div>
              <p>
                We give free products for demigods such ourselves,
                 for mortals, bow before us or die.
              </p>
            </div>
          </div>
        </div>
        <div class="footer-bar">
          All rights reserved to DemiGods
        </div>
      </footer>
';
}

function sub_footer(){
  echo '
  <footer class="footer">
         <div class="containerr">
             <div class="row">

                 <div class="footer-col">
                     <h4 class>About Us</h4>
                     <ul>
                         <li><a href="#"><p>
                         We give free products for demigods such ourselves,
                          for mortals, bow before us or die.
                       </p></a></li>

                     </ul>
                 </div>
                 <div class="footer-col">
                     <h4>payment</h4>
                     <ul class="display">
                         <li><a href="#"><i class="fa fa-cc-paypal fa-2x"></i></a></li>
                         <li><a href="#"><i class="fa fa-cc-visa fa-2x"></i></a></li>
                         <li><a href="#"><i class="fa fa-cc-mastercard fa-2x"></i></a></li>
                 
                     </ul>
                     <ul class="display">
                         <li><a href="#"><i class="fab fa-cc-apple-pay fa-2x"></i></a></li>
                         <li><a href="#"><i class="fab fa-cc-amazon-pay fa-2x"></i></a></li>
                         <li><a href="#"><i class="fab fa-bitcoin fa-2x"></i></a></li>
                 
                     </ul>
                     
                 </div>
                 <div class="footer-col">
                     <h4>contact us</h4>
                     <div class="wrapper">
                     <ul>
                         <li>
                        <div class="button">
                            <div class="icon">
                            <i class="fa fa-envelope fa-2x"></i>
                            </div>
                            <span>commerce@gmail.com</span>
                        </div>
                        </li>
                        <li>
                        <div class="button">
                            <div class="icon">
                            <i class="fa fa-phone fa-2x"></i>
                            </div>
                            <span>+212 6 03 80 47 39</span>
                        </div>
                        </li>
                        </ul>
                       </div> 
                 </div>
                 <div class="footer-col">
                     <h4>follow us</h4>
                     <div class="social-links">
                         <a href="https://www.facebook.com"><i class="fa fa-facebook fa-2x"></i></a>
                         <a href="https://www.intagram.com"><i class="fa fa-instagram fa-2x"></i></a>
                         <a href="https://www.twitter.com"><i class="fa fa-twitter fa-2x"></i></a>
                     </div>
  
                 </div>
             </div>
         </div>
         <div class="footer-bar">
          All rights reserved to DemiGods
        </div>
    </footer>

  ';
  }
  


function headers(){
  echo '
  <style>.fa, .far, .fas {
    font-family: "Font Awesome 5 Free";
    font-size: 30px;
}</style>
  ';
echo '
<header>
          <div class="logo">
            <a href="index.php"
              ><img src="images/roofTopSwordmanMad.png" alt="logo"
            /></a>
          </div>
          <nav>
            <div class="burger">
              <div class="line1"></div>
              <div class="line2"></div>
              <div class="line3"></div>
            </div>
            <ul class="nav-bar">
              <li><a href="index.php">HomePage</a></li>
              <li><a href="php/home.php">Home</a></li>
              <li><a href="php/products.php">Products</a></li>
              <li><a href="php/orders.php">ViewCart</a></li>
              <li><a href="php/profile.php">My Profile</a></li>
              <li><a href="login.php">
              <i class="fa fa-user-circle" aria-hidden="true" title="Login to you Account"></i>
              </a></li>
            </ul>
          </nav>
</header>
';  
}

function sub_headers(){
  echo '
  <style>.fa, .far, .fas {
    font-family: "Font Awesome 5 Free";
    font-size: 30px;
}</style>
  ';
echo '
<header class="navbarclr">
          <div class="logo">
            <a href="index.php?page=Home" class="nav-link" >
              <span class="link-text logo-text">GameStart</span>
              <i class="fad fa-dragon"></i>
            </a>
          </div>
          <nav>
            <div class="burger">
              <div class="line1"></div>
              <div class="line2"></div>
              <div class="line3"></div>
            </div>
            <ul class="nav-bar">
              <li><a href="index.php?page=Home">HomePage</a></li>
              <li><a href="index.php?page=products">Products</a></li>
              <li><a href="index.php?page=orders">ViewCart</a></li>
              <li><a href="index.php?page=profile">My Profile</a></li>
              <li><a href="index.php?page=login.php">
              <i class="fa fa-user-circle" aria-hidden="true" title="Login to you Account"></i>
              </a></li>
            </ul>
          </nav>
</header>
';  
}

function profileHeader(){
  echo '
  <style>.fa, .far, .fas {
    font-family: "Font Awesome 5 Free";
    font-size: 30px;
}</style>
  ';
echo '
          
            <div class="burger">
              <div class="line1"></div>
              <div class="line2"></div>
              <div class="line3"></div>
            </div>
            <ul class="nav-bar">
              <li><a href="../index.php">HomePage</a></li>
              <li><a href="../php/products.php">Products</a></li>
              <li><a href="../php/orders.php">ViewCart</a></li>
              <li><a href="../php/profile.php">My Profile</a></li>
              
            </ul>
          
';  
}



