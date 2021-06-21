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
<?php
include 'inc.php/html_body.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="old_css/all.css">
    <script src="https://kit.fontawesome.com/e1af7c97bd.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="crud.css">
    <link rel="stylesheet" type="text/css" href="header.css">
    <link rel="stylesheet" type="text/css" href="ftr.css">
    <link rel="stylesheet" type="text/css" href="boot.scss">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <title>CRUD Products</title>
</head>

<body>
    <?php
    $iddd = $_SESSION['id'];
    $type = $_SESSION['type'];
    if (empty($iddd)) {
        header('location:index.php');
        exit();
    }
    if ($type != 'admin') {
        header('location:index.php');
        exit();
    }
    $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

    admin_headers($iddd, $type, $num_items_in_cart);

    ?>





    <!-- Modal -->
    <div class="wrapping">
        <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                        <button type="button" style=" border-radius:3.25em;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                    <button type="submit" style=" border-radius:3.25em;" class="btn btn-primary" name="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" style=" border-radius:3.25em;" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold " style="text-align: center;">Products</h3>
                </div>
            </div>
            <div class="card-body">
                <div style="margin-left: 9%;" class="btn-group" role="group" aria-label="Basic example"><button type="button" id="Modal" style=" border-radius:3.25em;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal">
                        ADD
                    </button></div>
                <div class="row justify-content-center">
                    <!-- Button trigger modal -->

                    <table class="table table-responsive" style="width: 80%;">
                        <thead class="thead">
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
                                                <button type="submit" style=" border-radius:3.25em;" class="btn btn-success" name="edit_data_btn"> Edit </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="POST">
                                                <input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>">
                                                <button type="submit" style=" border-radius:3.25em;" class="btn btn-danger" name="delete_data_btn" onclick=" return confirm('Are you sure?');"> Delete </button>
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
            </div>
        </div>
        <script src="js/slideNav.js"></script>

</body>
<?php sub_footer(); ?>

</html>