
<?php
require "php/connexion.php";

if (isset($_POST['delete_data_btn'])) {

    $delete_id = $_POST["delete_id"];
    $query = " DELETE FROM `orders` WHERE `id`='$delete_id'";
    $query_run = mysqli_query($connect, $query);


    if ($query_run) {
        header('Location: index.php?page=orders');
    }
}

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
    <link rel="stylesheet" type="text/css" href="ftr.css">
    <link rel="stylesheet" type="text/css" href="boot.scss">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="header.css">

    
    <title>Orders</title>
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

        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold " style="text-align: center;">Orders</h3>
                </div>
            </div>
            <div class="card-body">

               
                <div class="row justify-content-center">
                    <!-- Button trigger modal -->

                    <table class="table table-responsive" style="width: 75%;">
                        <thead class="thead">
                            <tr>
                                <th>Id</th>
                                <th>User Id</th>
                                <th>Quantity</th>
                                <th>Order Description</th>
                                <th>Total</th>
                                <th>Date and time of order</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            require 'php/connexion.php';

                            $checkDB = "SELECT * FROM orders;";
                            $result = mysqli_query($connect, $checkDB);
                            $resultCheck = mysqli_num_rows($result);
                            if ($resultCheck > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <tr>
                                        <td> <?php echo $row['id'] ?> </td>
                                        <td> <?php echo $row['user_id'] ?> </td>
                                        <td> <?php echo $row['qutt'] ?> </td>
                                        <td> <?php echo $row['descri'] ?> </td>
                                        <td> <?php echo $row['total'] ?> </td>
                                        <td> <?php echo $row['dattime'] ?> </td>
        
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

            

</body>
<?php sub_footer(); ?>

</html>