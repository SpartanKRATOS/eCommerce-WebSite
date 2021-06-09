<?php
if (isset($_POST["submit"])) {
    require "php/connexion.php";

    $allowed = array('jpg', 'jpeg', 'png');



    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "images/" . $filename;
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $login = $_POST["login"];
    $password = $_POST["password"];
    $type = $_POST["type"];
    // $date = date('Y-m-d h:i:s', time());



    // Get all the submitted data from the form
    $sql = "INSERT INTO `users` (`fname`,`lname`,`login`,`password`,`type`,`image`,`date`) VALUES ('$firstname','$lastname','$login','$password','$type','$filename',current_timestamp());";

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
    $query = " DELETE FROM `users` WHERE `id`='$delete_id'";
    $query_run = mysqli_query($connect, $query);


    if ($query_run) {
        header('Location: index.php?page=crudUsers');
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
    <link rel="stylesheet" type="text/css" href="crud.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
    <title>CRUD Users</title>
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
    <div class="wrapping">
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" style=" border-radius:3.25em;"class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <form method="post" autocomplete="off" enctype="multipart/form-data">
                        <img id="output"  style="border-radius: 50%;" height="200px" width="200px" />
                            <div class="form-group">
                                <label>Profile Image</label>
                                <input type="file" name="uploadfile" id="uploadfile" class="form-control" required onchange="loadFile(event)">
                            </div>
                            <div class="form-group">
                                <label>Firstname</label>
                                <input type="text" name="firstname" class="form-control" placeholder="Type the firstname">
                            </div>
                            <div class="form-group">
                                <label>Lastname</label>
                                <input type="text" name="lastname" class="form-control" placeholder="Type the lastname">
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="login" class="form-control" placeholder="Type the username">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control" placeholder="Type a password">
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <input type="text" name="type" class="form-control" placeholder="Choose a type">
                            </div>
                            <div class="form-group">
                                <button type="submit"  style=" border-radius:3.25em;"class="btn btn-primary" name="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"  style=" border-radius:3.25em;" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

                </br>
    <div style="margin-left: 9%;" class="btn-group" role="group" aria-label="Basic example"><button type="button" style=" border-radius:3.25em;"id="Modal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal">
            ADD
        </button></div>
    <div class="row justify-content-center">
        <!-- Button trigger modal -->

        <table class="table" style="width: 80%;">
            <thead class="thead">
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Firstame</th>
                    <th>Lastname</th>
                    <th>Login</th>
                    <th>Password</th>
                    <th>Type</th>
                    <th>Registration date</th>
                </tr>
            </thead>
            <tbody>

                <?php

                require 'php/connexion.php';

                $checkDB = "SELECT * FROM users;";
                $result = mysqli_query($connect, $checkDB);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td> <?php echo $row['id'] ?> </td>
                            <td> <img id="profilepic" src="<?php echo 'images/', $row['image'] ?>" style="border-radius: 50%;" height="100px" width="100px" alt="Image"> </td>
                            <td> <?php echo $row['fname'] ?> </td>
                            <td> <?php echo $row['lname'] ?> </td>
                            <td> <?php echo $row['login'] ?> </td>
                            <td> <?php echo $row['password'] ?> </td>
                            <td> <?php echo $row['type'] ?> </td>
                            <td> <?php echo $row['date'] ?> </td>
                            <td>
                                <form action="index.php?page=userEdit" method="POST">
                                    <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                                    <button type="submit" style=" border-radius:3.25em;" class="btn btn-success" name="edit_data_btn"> Edit </button>
                                </form>
                            </td>
                            <td> <form method="POST">
                                    <input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>">
                                    <button type="submit" style=" border-radius:3.25em;" class="btn btn-danger" name="delete_data_btn" onclick=" return confirm('Are you sure?');"> Delete </button>
                                </form> </td>
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
</body>

</html>