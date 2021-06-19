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
      $img=$row['image'];
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
<?php
include 'inc.php/html_body.php';
if (isset($_SESSION['id']) || isset($_SESSION['type'])){
  $iddd = $_SESSION['id'];
  $type = $_SESSION['type'];
  $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

}else{
  $iddd = "";
  $type = "";

}


?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile</title>
		<link href="profile.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="header.css">
    <link rel="stylesheet" type="text/css" href="ftr.css">
    <link rel="stylesheet" href="old_css/all.css">
    <script src="https://kit.fontawesome.com/e1af7c97bd.js" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
  <?php
    //$iddd = $_SESSION['id'];
    //$type = $_SESSION['type'];
    if (empty($iddd)) {
      $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

        sub_headers($num_items_in_cart);
    }else
    if ($type != 'admin') {
        sub_headers1($iddd, $type,$num_items_in_cart);
    }else{admin_headers($iddd, $type,$num_items_in_cart);}
    

    ?>
        <main>
<section>
  <div class="wrapitup">
      <span class="thead"></span>
      <div class="profil-img">
      <img id="profilepic" src="<?php echo 'images/', $img ?>" style="border-radius: 50%;" height="200px" width="200px" alt="&#xf007;">
      </div>

      <table>
        <tr>

          <td><span class="thead"><h1>Username  :</h1></span></td>
          <td><h1><?php echo $username ?></h1></td>

        </tr>
        <tr>

          <td><span class="thead"><h1>First Name  :</h1></span></td>
          <td><h1><?php echo $fname ?></h1></td>

        </tr>
        <tr>

          <td><span class="thead"><h1>Last Name  :</h1></span></td>
          <td><h1><?php echo $lname ?></h1></td>

      </tr>
    </table>
    </div>
      <div class="bttn" >
      	
      	
      	<button onClick="deleteme('<?php echo $username ?>');"  name="deluser"  class="delete-user" type="submit">
      	<i class="far fa-trash-alt"></i>
      	<h3>Delete My Account</h3>
      	</button>
      	

      </div>
    </section>
<?php $year = date('Y'); ?>
    </main>
    </body>
    <?php sub_footer(); ?>

</html>