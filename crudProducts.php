<?php
if (isset($_POST["submit"])) {
    require "php/connexion.php";

    $allowed = array('jpg', 'jpeg', 'png');



    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "images/" . $filename;
    $name = $_POST["name"];
    $desc = $_POST["desc"];
    $price = $_POST["price"];
    $rrp = $_POST["rrp"];
    $quantity = $_POST["quantity"];
    // $date = date('Y-m-d h:i:s', time());



    // Get all the submitted data from the form
    $sql = "INSERT INTO `products` (`name`,`desc`,`price`,`rrp`,`quantity`,`img`,`date_added`) VALUES ('$name','$desc','$price','$rrp','$quantity','$filename',current_timestamp());";

    // Execute query
    mysqli_query($connect, $sql);

    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
        $msg = "Image uploaded successfully";
    } else {
        $msg = "Failed to upload image";
    }
}
?>

<?php
require "php/connexion.php";

if (isset($_POST['delete_data_btn'])) {

    $delete_id = $_POST["delete_id"];
    $query = " DELETE FROM `products` WHERE `id`='$delete_id'";
    $query_run = mysqli_query($connect, $query);


    if ($query_run) {
        header('Location: index.php?page=crudProducts');
    }
}

?>

<?php

// session_start();

// require 'php/connexion.php';
// //  include 'functionsNoDB.php';
// // start session
// // query back all the results from users table
// $sql = "SELECT * FROM users";
// $result = mysqli_query($connect, $sql);
// $resultCheck = mysqli_num_rows($result);
// if ($resultCheck > 0) {
//     while ($row = mysqli_fetch_assoc($result)) {
//         $sessionName = $row['login'];
//         if (@$_SESSION[$sessionName] == "ok") {    //	
//             $username = $sessionName;
//             //$date=$row['date'];
//             $id = $row['id'];
//             $fname = $row['fname'];
//             $lname = $row['lname'];
//         }
//     }
//     if ($_SESSION[$username] != "ok") {
//         header("location:index.php?page=login");
//         exit();     // in order to not reach the html tags so the page wont load for the user.
//     }
// }


// //Get the amount of items in the shopping cart, this will be displayed in the header
// $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <title>CRUD Products</title>
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
                // if ($_SESSION[$username] == "ok") {
                // } else {
                ?>
                // <a href="index.php?page=login">Login</a>
                <?php
                //  }
                ?>

                <a href="index.php?page=logout">Logout</a>
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



    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <form method="post" autocomplete="off" enctype="multipart/form-data">

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Type a name">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="desc" class="form-control" placeholder="Type a desc">
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" name="price" class="form-control" placeholder="Type a price">
                            </div>
                            <div class="form-group">
                                <label>RRP</label>
                                <input type="text" name="rrp" class="form-control" placeholder="Type a rrp">
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" name="quantity" class="form-control" placeholder="Type a quantity">
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="uploadfile" id="uploadfile" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>


    <div style="margin-left: 10%;" class="btn-group" role="group" aria-label="Basic example"><button type="button" id="Modal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal">
            ADD
        </button></div>
    <div class="row justify-content-center">
        <!-- Button trigger modal -->

        <table class="table" style="width: 80%;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>RRP</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>date_added</th>
                </tr>
            </thead>
            <tbody>

                <?php

                require 'php/connexion.php';

                $checkDB = "SELECT * FROM products;";
                $result = mysqli_query($connect, $checkDB);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td> <?php echo $row['id'] ?> </td>
                            <td> <?php echo $row['name'] ?> </td>
                            <td> <?php echo $row['desc'] ?> </td>
                            <td> <?php echo $row['price'] ?> </td>
                            <td> <?php echo $row['rrp'] ?> </td>
                            <td> <?php echo $row['quantity'] ?> </td>
                            <td> <img src="<?php echo 'images/', $row['img'] ?>" height="100px" width="100px" alt="Image"> </td>
                            <td> <?php echo $row['date_added'] ?> </td>
                            <td>
                                <form action="index.php?page=productEdit" method="POST">
                                    <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                                    <button type="submit" class="btn btn-success" name="edit_data_btn"> Edit </button>
                                </form>
                            </td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>">
                                    <button type="submit" class="btn btn-danger" name="delete_data_btn" onclick=" return confirm('Are you sure?');"> Delete </button>
                                </form>
                            </td>
                        </tr>
                <?php

                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script>
        var myModal = document.getElementById('Modal')
        var myInput = document.getElementById('exampleModal')

        myModal.addEventListener('shown.bs.modal', function() {
            myInput.focus()
        })
    </script>
</body>

</html>