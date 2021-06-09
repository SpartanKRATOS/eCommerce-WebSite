<?php require "php/connexion.php"; ?>

<?php

if (isset($_POST['product_update_btn'])) {

    $filename = $_FILES['uploadedfile']['name'];

    //$folder = "images/" . $filename;

    $edit_id = $_POST['id'];
    $edit_name = $_POST['name'];
    $edit_desc = $_POST['desc'];
    $edit_price = $_POST['price'];
    $edit_rrp = $_POST['rrp'];
    $edit_quantity = $_POST['quantity'];

    if ($_FILES['uploadedfile']['size'] == 0) {
        $edit_img = $_POST["preview_name"];
    } else {
        $edit_img = $_FILES["uploadedfile"]["name"];
    }

    $query = " UPDATE products SET `name`='$edit_name', `desc`='$edit_desc', `price`='$edit_price', `rrp`='$edit_rrp', `quantity`='$edit_quantity', `img`='$edit_img', `date_added`=current_timestamp() WHERE `id`='$edit_id'";
    $query_run = mysqli_query($connect, $query);

    if ($query_run) {
        header('Location: index.php?page=crudProducts');
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Profile</title>
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

            <?php
            if (isset($_POST['edit_data_btn'])) {
                $id = $_POST['edit_id'];

                $query = "SELECT * FROM products where id='$id' ";
                $query_run = mysqli_query($connect, $query);

                foreach ($query_run as $row) {
            ?>
                    <form method="POST" enctype="multipart/form-data" autocomplete="off">
                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" name="id" class="form-control" readonly placeholder="Type a name" value="<?php echo $row['id'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Type a name" value="<?php echo $row['name'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="desc" class="form-control" placeholder="Type a desc" value="<?php echo $row['desc'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control" placeholder="Type a price" value="<?php echo $row['price'] ?>">
                        </div>
                        <div class="form-group">
                            <label>RRP</label>
                            <input type="text" name="rrp" class="form-control" placeholder="Type a rrp" value="<?php echo $row['rrp'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="text" name="quantity" class="form-control" placeholder="Type a quantity" value="<?php echo $row['quantity'] ?>">
                        </div>
                        <div class="form-group">
                            <label>ImagePreview</label>
                            <input type="hidden" value="<?php echo $row['img'] ?>" name="preview_name">
                            <img src="images/<?php echo $row['img'] ?>" height="100px" width="100px" alt="" id="preview">
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="uploadedfile" class="form-control">
                        </div>
                        <a href="index.php?page=crudProducts" class="btn btn-danger"> Cancel</a>
                        <button type="submit" name="product_update_btn" class="btn btn-primary">Update</button>

                    </form>

            <?php
                }
            }

            ?>



        </div>
    </div>


</body>

</html>