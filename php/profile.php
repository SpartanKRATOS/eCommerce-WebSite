<?php
	require 'connexion.php';
  // start session
	session_start();
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
		if ($_SESSION[$username] != "ok") { // lorsque nous avons vérifié les noms d'utilisateur et que nous ne trouvons pas de session, cette page redirigera n'importe qui vers la page login.php
            echo "<script>console.log('Username != ok' );</script>";
            header("location:login.php");
		exit();     // in order to not reach the html tags so the page wont load for the user.
	 }
	}
	
 ?>

<?php
include '../inc.php/html_body.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
    <link rel="stylesheet" type="text/css" href="../css/session.css" />
    
    <script src="https://kit.fontawesome.com/e1af7c97bd.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="icon" href="../images/private.png" type="image/png" >
    
    <link
      rel="shortcut icon"
      href="images/icon/icons.jpg"
      type="image/x-icon"
    />
    
    <link
      href="https://fonts.googleapis.com/css?family=Raleway:600,900"
      rel="stylesheet"
    />
	<!-- nous faisons un titre du prénom de l'utilisateur -->
    <title>Profile of <?php echo $fname ?></title>
  </head>
  <body>
  <!-- <div class="nav-bar"> -->
  
  <header>
          
          <nav>
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
              <li><i class="fas fa-sign-out-alt"></i><a href="logout.php">Log out</a></li>
            </ul>
          </nav>
</header>

    	<!-- <nav>
      <div class="header">
         nous imprimons son nom et prénom -->
     <!-- <h1>Welcome to your Store <span id="name"><?php // echo $fname . " ". $lname?></span></h1>	
    	</nav>
        
        <ul class="logout">
        <li><a href="../index.php">HomePage</a></li>
        <li><a href="../php/products.php">Products</a></li>
        <li><a href="../php/orders.php">ViewCart</a></li>
        <li><a href="../php/profile.php">My Profile</a></li>
        <li><i class="fas fa-sign-out-alt"></i><a href="logout.php">Log out</a></li>
        </ul>
      </div> -->


    	
  	<section>
      <span class="thead"></span>
      <div class="profil-img">
        <i class="fas fa-user-circle"></i>
      </div>
      <div class="delete-user" >
      	
      	<!-- here we use javascript the check if the user wats really to delete its account or not with a good looking design by using the library sweetAlert
      	you can find the javascript file under js/delUserConfirmation.-->
      	<!-- we run the function called deleteme(parameter) with the parameter of username -->
      	<button onClick="deleteme('<?php echo $username ?>');"  name="deluser"  class="delete-user" type="submit">
      	<i class="far fa-trash-alt"></i>
      	<h3>Delete My Account</h3>
      	</button>
      	

      </div>
		
		<!-- nous avons affiché des informations de base sur l'utilisateur actuel, mais pas le mot de passe, car il n'est pas sécurisé de le faire. -->
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
    <!-- </div> -->
    </div>
     <script src="../js/slideNav.js"></script>
</body>
</html>