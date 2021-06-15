<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Completed Order!</title>
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
                if (empty($_SESSION['id'])) { ?>
                    <a href="index.php?page=login">Login</a>
                    <?php
                } else {

                    if (!empty($_SESSION['id'])) {

                    ?>
                        <a href="index.php?page=logout">Logout</a>
                <?php

                    }
                }
                ?>
            </nav>
            <div class="link-icons">
                <a href="index.php?page=cart">
                    <i class="fas fa-shopping-cart"></i>
                    <?php $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                    <span><?= $num_items_in_cart ?></span>
                </a>
            </div>
        </div>
    </header>
    <main>

        <div class="placeorder content-wrapper">
            <h1>Your Order Has Been Placed</h1>
            <p>Thank you for ordering with us, we'll contact you by email with your order details.</p>
        </div>

        <?= template_footer() ?>