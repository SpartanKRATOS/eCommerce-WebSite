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
<?php
include 'inc.php/html_body.php';

session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>History - User - <?php $_GET['id'] ?></title>
        <link rel="stylesheet" type="text/css" href="history.css">

    <link rel="stylesheet" type="text/css" href="header.css">
    <link rel="stylesheet" type="text/css" href="ftr.css">
    <link rel="stylesheet" type="text/css" href="boot.scss">    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/e1af7c97bd.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="old_css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
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

    admin_headers($iddd, $type,$num_items_in_cart);

    ?>
<div class="wrapping">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h3 class="m-0 font-weight-bold " style="text-align: center;">History</h3>
            </div>
        </div>
        <div class="card-body">


            <div class="row justify-content-center">
                <!-- Button trigger modal -->

                <table class="table table-responsive-sm" style="width: 80%;">
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
                                //echo 'sesssion ID exists';
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
    </div>

</body>


<?php sub_footer(); ?>

</html>