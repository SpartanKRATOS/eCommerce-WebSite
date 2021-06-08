<?php

require "php/connexion.php";

session_start();


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
		if ($_SESSION[$username] != "ok") { // lorsque nous avons vérifié les noms d'utilisateur et que nous ne trouvons pas de session, cette page redirigera n'importe qui vers la page login.php
		header("location: index.php?page=login");
		exit();     // in order to not reach the html tags so the page wont load for the user.
	 }
	}

// The amounts of products to show on each page
$num_products_on_each_page = 8;
// The current page, in the URL this will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
// Select products ordered by the date added
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT ?,?');
// bindValue will allow us to use integer in the SQL statement, we need to use for LIMIT
$stmt->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the products from the database and return the result as an Array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of products
$total_products = $pdo->query('SELECT * FROM products')->rowCount();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Products</title>
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
                    if(isset($_SESSION[$username])){

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
<div class="products content-wrapper">
    <h1>Products</h1>
    <p><?=$total_products?> Products</p>
    <div class="products-wrapper">
        <?php foreach ($products as $product): ?>
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
    <div class="buttons">
        <?php if ($current_page > 1): ?>
        <a href="index.php?page=products&p=<?=$current_page-1?>">Prev</a>
        <?php endif; ?>
        <?php if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($products)): ?>
        <a href="index.php?page=products&p=<?=$current_page+1?>">Next</a>
        <?php endif; ?>
    </div>
</div>

<?=template_footer()?>