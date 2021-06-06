<?php 
include 'inc.php/html_body.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- link the css file with php -->
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <!-- we import framework called fontawesome for using 
    the icons as a fonts instead of images -->
    <script src="https://kit.fontawesome.com/e1af7c97bd.js" crossorigin="anonymous"></script>
    <link
      rel="shortcut icon"
      href="images/icon/icons.jpg"
      type="image/x-icon"
    />
    
    <link
      href="https://fonts.googleapis.com/css?family=Raleway:600,900"
      rel="stylesheet"
    />

    <title>Home Page</title>
  </head>
  <body>
    <div class="all">
      <div class="full-page">
      <?php headers(); ?>
      
    
        

    <?php footer(); ?>
      
    </div>
    <script src="js/slideNav.js"></script>
  </body>
</html>
