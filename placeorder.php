<?php
session_start();
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
    <title>Completed Order!</title>
    <link rel="stylesheet" href="old_css/all.css">

    <link rel="stylesheet" type="text/css" href="homepage.css">
    <link rel="stylesheet" type="text/css" href="header.css">
    <link rel="stylesheet" type="text/css" href="ftr.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <script src="https://kit.fontawesome.com/e1af7c97bd.js" crossorigin="anonymous"></script>

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

        <div class="placeorder content-wrapper">
            <h1>Your Order Has Been Placed</h1>
            <p>Thank you for ordering with us, we'll contact you by email with your order details.</p>
        </div>

        </main>
</body>
<?php sub_footer(); ?>
</html>
