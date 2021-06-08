<?php

session_start();

 require 'php/connexion.php';
//  include 'functionsNoDB.php';
  // start session
	// query back all the results from users table
	$sql="SELECT * FROM users";
	$result=mysqli_query($connect,$sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		while ($row = mysqli_fetch_assoc($result)){
			$sessionName=$row['login'];
			if(@$_SESSION[$sessionName]=="ok"){	//	
            $username=$sessionName;
//$date=$row['date'];
			$id=$row['id'];
			$fname=$row['fname'];
			$lname=$row['lname'];
			}
		}
		if ($_SESSION[$username] != "ok") { 
            header("location:index.php?page=login");
		exit();     // in order to not reach the html tags so the page wont load for the user.
	 }
	}

  
//Get the amount of items in the shopping cart, this will be displayed in the header
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile</title>
		<link href="css/cart.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
        <header>
            <div class="content-wrapper">
                <h1>Gaming Shop</h1>
                <nav>
                    <a href="index.php">Home</a>
                    <a href="index.php?page=products">Products</a>
                    <a href="index.php?page=profile">Profile</a>
                    <?php 
                    if($_SESSION[$username] == "ok"){

                    }else{
                      ?>
                      <a href="index.php?page=login">Login</a>
                      <?php
                    }
                    ?>
                    
                    <a href="index.php?page=logout">Logout</a>
                </nav>
                <div class="link-icons">
                    <a href="index.php?page=cart">
						<i class="fas fa-shopping-cart"></i>
            <?php   $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                        <span><?= $num_items_in_cart ?></span>
					</a>
                </div>
            </div>
        </header>
        <main>
<section>
      <span class="thead"></span>
      <div class="profil-img">
        <i class="fas fa-user-circle" style="font-size: 150px;"></i>
      </div>
      <div class="delete-user" >
      	
      	
      	<button onClick="deleteme('<?php echo $username ?>');"  name="deluser"  class="delete-user" type="submit">
      	<i class="far fa-trash-alt"></i>
      	<h3>Delete My Account</h3>
      	</button>
      	

      </div>
		
      <div class="card">
        <div class="th1 th">
          <span class="thead"><h1>Username:</h1></span>
          <h1><?php echo $username ?></h1>
        </div>
        <div class="th2 th">
          <span class="thead"><h1>First Name:</h1></span>
          <h1><?php echo $fname ?></h1>
        </div>
        <div class="th3 th">
          <span class="thead"><h1>Last Name:</h1></span>
          <h1><?php echo $lname ?></h1>
        </div>
        
      </div>
    </section>
<?php $year = date('Y'); ?>
    </main>
        <!-- <footer>
            <div class="content-wrapper">
                <p>&copy; $year, Shopping Cart System</p>
            </div>
        </footer> -->
        <footer>
        <div class="footer-content">
          <div class="main-footer">
            <div id="contact">
              <h4>Contact us</h4>

              <div class="contact-section">
                <p>Email &nbsp;&nbsp;:</p>
                <a href="mailto:contact@commerce.com"
                  >Contact@TravelInfo.com</a
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
                mortals worship me or die, mundane mortals!!!!
              </p>
            </div>
          </div>
        </div>
        <div class="footer-bar">
          All rights reserved to Commerce info &copy;2021
        </div>
      </footer>
        <script src="script.js"></script>
    </body>
</html>