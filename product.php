<?php

require "php/connexion.php";


$username = '';
$sql="SELECT * FROM users";
	$result=mysqli_query($connect,$sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		while ($row = mysqli_fetch_assoc($result)){
			$sessionName=$row['login'];
			if(@$_SESSION[$sessionName]=="ok"){	// nous vérifions le nom de la session en recherchant dans notre base de données et trouver le bon, par exemple: si le nom d'utilisateur est nassim la session ressemble bien à: $ _SESSION ['nassim'] = "ok"
			// nous prenons également certaines données de la base de données pour les afficher sur la page de l'utilisateur actuel comme le nom d'utilisateur, la date, le prénom, le nom de famille 
			$username=$sessionName;
			}
		}
	// 	if ($_SESSION[$username] != "ok") { // lorsque nous avons vérifié les noms d'utilisateur et que nous ne trouvons pas de session, cette page redirigera n'importe qui vers la page login.php
	// 	header("location: index.php?page=login");
	// 	exit();     // in order to not reach the html tags so the page wont load for the user.
	//  }
	}

if (isset($_GET['id'])) {
    $pdo = pdo_connect_mysql();
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
        exit('Product does not exist!');
    }
} else {
    exit('Product does not exist!');
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Product</title>
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
                    if($username==''){ ?>
                        <a href="index.php?page=login">Login</a> 
                        <?php
                     }else{
 
                     if($_SESSION[$username] == "ok"){
 
                     }else{
                       ?>
                       <a href="index.php?page=logout">Logout</a>
                       <?php
                     }}
                     ?>
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
<div class="product content-wrapper">
    <img src="images/<?=$product['img']?>" width="500" height="500" alt="<?=$product['name']?>">
    <div>
        <h1 class="name"><?=$product['name']?></h1>
        <span class="price">
            &dollar;<?=$product['price']?>
            <?php if ($product['rrp'] > 0): ?>
            <span class="rrp">&dollar;<?=$product['rrp']?></span>
            <?php endif; ?>
        </span>
        <form action="index.php?page=cart" method="post">
            <input type="number" name="quantity" value="1" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
            <input type="hidden" name="product_id" value="<?=$product['id']?>">
            <input type="submit" value="Add To Cart">
        </form>
        <div class="description">
            <?=$product['desc']?>
        </div>
    </div>
</div>

<?=template_footer()?>