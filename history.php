<?php require "php/connexion.php"; ?>

<?php

// if (isset($_POST['product_update_btn'])) {

//     $filename = $_FILES['uploadedfile']['name'];

//     //$folder = "images/" . $filename;

//     $edit_id = $_POST['id'];
//     $edit_name = $_POST['name'];
//     $edit_desc = $_POST['desc'];
//     $edit_price = $_POST['price'];
//     $edit_rrp = $_POST['rrp'];
//     $edit_quantity = $_POST['quantity'];

//     if ($_FILES['uploadedfile']['size'] == 0) {
//         $edit_img = $_POST["preview_name"];
//     } else {
//         $edit_img = $_FILES["uploadedfile"]["name"];
//     }

//     $query = " UPDATE products SET `name`='$edit_name', `desc`='$edit_desc', `price`='$edit_price', `rrp`='$edit_rrp', `quantity`='$edit_quantity', `img`='$edit_img', `date_added`=current_timestamp() WHERE `id`='$edit_id'";
//     $query_run = mysqli_query($connect, $query);

//     if ($query_run) {
//         header('Location: index.php?page=crudProducts');
//     }
// }

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>History - User - <?php $_GET['id'] ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

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
                // if($_SESSION[$username] == "ok"){

                //  }else{
                ?>
                <a href="index.php?page=login">Login</a>
                <?php
                // }
                ?>

                <a href="index.php?page=logout">Logout</a>
            </nav>
            <div class="link-icons">
                <a href="index.php?page=cart">
                    <i class="fas fa-shopping-cart"></i>
                    <?php  // $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; 
                    ?>
                    <!--      <span><?= $num_items_in_cart ?></span> -->
                </a>
            </div>
        </div>
    </header>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Product Edit</h6>
            </div>
        </div>
        <div class="card-body">


            <div class="row justify-content-center">
                <!-- Button trigger modal -->

                <table class="table" style="width: 80%;">
                    <thead class="thead">
                        <tr>
                            <th>Id</th>
                            <th>product ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Date</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        session_start();
                        require 'php/connexion.php';
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            if (empty($_SESSION['id'])) {
                                echo 'Please log in!';
                                header('location: index.php');
                                exit();
                            } else {
                                $sessionID = $_SESSION['id'];
                            }

                            if (isset($_SESSION['id'])) {
                                echo 'sesssion ID exists';
                            }
                            $checkDB = "SELECT * FROM history where user_id='$sessionID';";
                            $result = mysqli_query($connect, $checkDB);
                            $resultCheck = mysqli_num_rows($result);
                            if ($resultCheck > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {

                        ?>
                                    <tr>
                                        <td> <?php echo $row['id'] ?> </td>
                                        <td> <?php echo $row['prod_id'] ?> </td>
                                        <td> <img id="profilepic" src="<?php echo 'images/', $row['img'] ?>" style="border-radius: 50%;" height="100px" width="100px" alt="Image"> </td>
                                        <td> <?php echo $row['name'] ?> </td>
                                        <td> <?php echo $row['date'] ?> </td>

                                        <td>
                                            <form action="index.php?page=product&id=<?php echo $row['prod_id']; ?>" method="POST">
                                                <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                                                <button type="submit" style=" border-radius:3.25em;" class="btn btn-success" name="edit_data_btn"> Go to </button>
                                            </form>
                                        </td>

                                    </tr>
                        <?php

                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>



        </div>
    </div>


</body>

</html>