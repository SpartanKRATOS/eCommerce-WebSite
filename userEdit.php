<?php require "php/connexion.php"; ?>

<?php

if (isset($_POST['user_update_btn'])) {

    $filename = $_FILES['uploadedfile']['name'];

    //$folder = "images/" . $filename;
    $edit_id = $_POST['id'];
    $edit_firstname = $_POST['firstname'];
    $edit_lastname = $_POST['lastname'];
    $edit_login = $_POST['login'];
    $edit_password = $_POST['password'];
    $edit_type = $_POST['type'];

    if ($_FILES['uploadedfile']['size'] == 0) {
        $edit_img = $_POST["preview_name"];
    } else {
        $edit_img = $_FILES["uploadedfile"]["name"];
    }

    $query = " UPDATE users SET `fname`='$edit_firstname', `lname`='$edit_lastname', `login`='$edit_login', `password`='$edit_password', `type`='$edit_type', `image`='$edit_img', `date`=current_timestamp() WHERE `id`='$edit_id'";
    $query_run = mysqli_query($connect, $query);

    if ($query_run) {
        header('Location: index.php?page=crudUsers');
    }
}

?>
<?php
include 'inc.php/html_body.php';
session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="crud.css">

    <link rel="stylesheet" type="text/css" href="header.css">
    <link rel="stylesheet" type="text/css" href="ftr.css">
    <link rel="stylesheet" type="text/css" href="boot.scss">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
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

    admin_headers($iddd, $type, $num_items_in_cart);

    ?>



    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h3 class="m-0 font-weight-bold " style="text-align: center;">Edit User</h3>
            </div>
        </div>
        <div class="card-body">

            <?php
            if (isset($_POST['edit_data_btn'])) {
                $id = $_POST['edit_id'];

                $query = "SELECT * FROM users where id='$id' ";
                $query_run = mysqli_query($connect, $query);

                foreach ($query_run as $row) {
            ?>
                    <form method="POST" enctype="multipart/form-data" autocomplete="off">
                        <div class="form-group">
                            <label>ImagePreview</label>
                            <input type="hidden" value="<?php echo $row['image'] ?>" name="preview_name">
                            <img src="images/<?php echo $row['image'] ?>" style="border-radius: 50%;" height="100px" width="100px" alt="" id="preview">
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="uploadedfile" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Id</label>
                            <input type="text" id="idreadonly" name="id" class="form-control" readonly placeholder="id" value="<?php echo $row['id'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Firstname</label>
                            <input type="text" name="firstname" class="form-control" placeholder="Type a firstname" value="<?php echo $row['fname'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Lastname</label>
                            <input type="text" name="lastname" class="form-control" placeholder="Type a lastname" value="<?php echo $row['lname'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="login" class="form-control" placeholder="Type a username" value="<?php echo $row['login'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control" placeholder="Type a password" value="<?php echo $row['password'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <input type="text" name="type" class="form-control" placeholder="Type a type" value="<?php echo $row['type'] ?>">
                        </div>

                        <a href="index.php?page=crudUsers" style=" border-radius:3.25em;" class="btn btn-danger"> Cancel</a>
                        <button type="submit" style=" border-radius:3.25em;" name="user_update_btn" class="btn btn-primary">Update</button>

                    </form>

            <?php
                }
            }

            ?>



        </div>
    </div>

    <script src="js/slideNav.js"></script>

</body>
<?php sub_footer(); ?>

</html>