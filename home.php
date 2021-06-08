<?php

require "php/connexion.php";

session_start();

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
    //     if(empty($username)){

    //     }
	// 	if ($_SESSION[$username] != "ok") { // lorsque nous avons vérifié les noms d'utilisateur et que nous ne trouvons pas de session, cette page redirigera n'importe qui vers la page login.php
	// 	//header("location: index.php?page=login");
	// 	//exit();     // in order to not reach the html tags so the page wont load for the user.
	//  }
	}


// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 4');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home</title>
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
                        ?>
                        <a href="index.php?page=logout">Logout</a>
                        <?php
                    }else{
                      
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

<div class="featured">
    <h2></h2>
    <p></p>
</div>
<div class="recentlyadded content-wrapper">
    <h2>Recently Added Products</h2>
    <div class="products">
        <?php foreach ($recently_added_products as $product): ?>
        <a href="index.php?page=product&id=<?=$product['id']?>" class="product">
            <img src="images/<?=$product['img']?>" width="200" height="200" alt="<?=$product['name']?>">
            <span class="name"><?=$product['name']?></span>
            <span class="price">
                &dollar;<?=$product['price']?>
                <?php if ($product['rrp'] > 0): ?>
                <span class="rrp">&dollar;<?=$product['rrp']?></span>
                <?php endif; ?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<?=template_footer()?>