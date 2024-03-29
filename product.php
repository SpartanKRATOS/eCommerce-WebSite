<?php

require "php/connexion.php";

session_start();

if (isset($_SESSION['product'])) {
    // echo 'session exits';
} else {
    //  echo 'session does not exist';
}



$username = '';
$sql = "SELECT * FROM users";
$result = mysqli_query($connect, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $sessionName = $row['login'];
        if (@$_SESSION[$sessionName] == "ok") {    // nous vérifions le nom de la session en recherchant dans notre base de données et trouver le bon, par exemple: si le nom d'utilisateur est nassim la session ressemble bien à: $ _SESSION ['nassim'] = "ok"
            // nous prenons également certaines données de la base de données pour les afficher sur la page de l'utilisateur actuel comme le nom d'utilisateur, la date, le prénom, le nom de famille 
            $username = $sessionName;
        }
    }
    // 	if ($_SESSION[$username] != "ok") { // lorsque nous avons vérifié les noms d'utilisateur et que nous ne trouvons pas de session, cette page redirigera n'importe qui vers la page login.php
    // 	header("location: index.php?page=login");
    // 	exit();     // in order to not reach the html tags so the page wont load for the user.
    //  }
}

if (isset($_GET['id'])) {
    $getID = $_GET['id'];
    $sql = "SELECT * FROM products where id='$getID'";
    $result = mysqli_query($connect, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            //echo 'fetched prodname and img';
            $prod_name = $row['name'];
            $prod_img = $row['img'];
        }
    }
    // GET PRODUCT INFORMATIONS

    $pdo = pdo_connect_mysql();
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
        exit('Product does not exist!');
    }
    ///////////////////////////////////////////////////////////////////////

    //CHECK IF SESSION ID EXISTS, IF IT DOES NOT, IT MEANS USER IN NOT AUTHENTIFICATED, SO NO NEED TO CAPTURE
    // CLICKS ON THE PRODUCT 
    if (!empty($_SESSION['id'])) {
        $userID = $_SESSION['id'];
        $checkDBUsername = "INSERT INTO history (prod_id, user_id, name, date, img) VALUES ('$getID', '$userID', ' $prod_name',current_timestamp(), '$prod_img'); ";
        $result = mysqli_query($connect, $checkDBUsername);

        // check if user already views the product
        if (isset($_SESSION['product']) && is_array($_SESSION['product'])) {

            // if (array_key_exists($_GET['id'], $_SESSION['product'])) {
            if (in_array($_GET['id'], $_SESSION['product'])) {
                // Do nothing
                //  echo 'array_key exists';
            } else {
                // Product have not been clicked before so we add a click

                //  echo 'array_key does not exists';
                array_push($_SESSION['product'], $_GET['id']);
                $anID = $_GET['id'];
                $query = " UPDATE products SET `clicks` = `clicks` + 1 WHERE `id`='$anID'";
                $query_run = mysqli_query($connect, $query);
            }
        } else {
            // $_SESSION['product'] = array();
            // echo 'created an array and incremented value';
            // array_push($_SESSION['product'], $_GET['id']);
            // $anID = $_GET['id'];
            // $query = " UPDATE products SET `clicks` += 1 WHERE `id`='$anID'";
            // $query_run = mysqli_query($connect, $query);
        }
    }
} else {
    exit('Product does not exist!');
}
?>
<?php
include 'inc.php/html_body.php';
if (isset($_SESSION['id']) || isset($_SESSION['type'])) {
    $iddd = $_SESSION['id'];
    $type = $_SESSION['type'];
    $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
} else {
    $iddd = "";
    $type = "";
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Product</title>
    <link href="product.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="header.css">
    <link rel="stylesheet" type="text/css" href="ftr.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

    <link rel="stylesheet" href="old_css/all.css">
    <script src="https://kit.fontawesome.com/e1af7c97bd.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    //$iddd = $_SESSION['id'];
    //$type = $_SESSION['type'];
    if (empty($iddd)) {
        $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

        sub_headers($num_items_in_cart);
    } else
    if ($type != 'admin') {
        sub_headers1($iddd, $type, $num_items_in_cart);
    } else {
        admin_headers($iddd, $type, $num_items_in_cart);
    }


    ?>

    <main>
        <div class="product content-wrapper">
            <img src="images/<?= $product['img'] ?>" width="500" height="500" alt="<?= $product['name'] ?>">
            <div>
                <h1 class="name"><?= $product['name'] ?></h1>
                <span class="price">
                    &dollar;<?= $product['price'] ?>
                    <?php if ($product['rrp'] > 0) : ?>
                        <span class="rrp">&dollar;<?= $product['rrp'] ?></span>
                    <?php endif; ?>
                </span>
                <form action="index.php?page=cart" method="post">
                    <input type="number" name="quantity" value="1" min="1" max="<?= $product['quantity'] ?>" placeholder="Quantity" required>
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <input type="submit" value="Add To Cart">
                </form>
                <div class="description">
                    <?= $product['desc'] ?>
                </div>
            </div>
        </div>
    </main>
    <script src="js/slideNav.js"></script>

</body>
<?php sub_footer(); ?>

</html>