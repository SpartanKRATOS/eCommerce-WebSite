<?php

require "php/connexion.php";

session_start();

$username = '';
$sql = "SELECT * FROM users";
$result = mysqli_query($connect, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $sessionName = $row['login'];
    if (@$_SESSION[$sessionName] == "ok") {    // nous vérifions le nom de la session en recherchant dans notre base de données et trouver le bon, par exemple: si le nom d'utilisateur est nassim la session ressemble bien à: $ _SESSION ['nassim'] = "ok"
      // nous prenons également certaines données de la base de données pour les afficher sur la page de l'utilisateur actuel comme le nom d'utilisateur, la date, le prénom, le nom de famille 
      $username = $sessionName;
    }
  }
  //     if(empty($username)){

  //     }
  // 	if ($_SESSION[$username] != "ok") { // lorsque nous avons vérifié les noms d'utilisateur et que nous ne trouvons pas de session, cette page redirigera n'importe qui vers la page login.php
  // 	//header("location: index.php?page=login");
  // 	//exit();     // in order to not reach the html tags so the page wont load for the user.
  //  }
}


// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 4');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Get most popular products
$stmt1 = $pdo->prepare('SELECT * FROM products ORDER BY clicks DESC LIMIT 4');
$stmt1->execute();
$popular_products = $stmt1->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
include 'inc.php/html_body.php';
if (isset($_SESSION['id']) || isset($_SESSION['type'])) {
  $iddd = $_SESSION['id'];
  $type = $_SESSION['type'];
  $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
} else {
  $iddd = "";
  $type = "";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Home</title>

  <link rel="stylesheet" href="old_css/all.css">
  <script src="https://kit.fontawesome.com/e1af7c97bd.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="homepage.css">
  <link rel="stylesheet" type="text/css" href="header.css">
  <link rel="stylesheet" type="text/css" href="ftr.css">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">


</head>

<body>
  <?php
  //$iddd = $_SESSION['id'];
  //$type = $_SESSION['type'];
  if (empty($iddd)) {
    $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

    sub_headers($num_items_in_cart);
  } else
    if ($type != 'admin') {
    sub_headers1($iddd, $type, $num_items_in_cart);
  } else {
    admin_headers($iddd, $type, $num_items_in_cart);
  }


  ?>

  <main>
    <div class="wrapit">
      <div class="slider">
        <div class="slidee active">
          <img src="images/mouse.png" alt="">
          <div class="info">
            <h2>Logitec G502</h2>
            <p>G502 HERO features an advanced optical sensor for maximum tracking accuracy, customizable RGB lighting, custom game profiles, from 200 up to 25,600 DPI, and repositionable weights.</p>
          </div>
        </div>
        <div class="slidee">
          <img src="images/keyboard1.png" alt="">
          <div class="info">
            <h2>SteelSeries Apex</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>
        </div>
        <div class="slidee">
          <img src="images/mouse11.png" alt="">
          <div class="info">
            <h2>GAMDIAS ZEUS M2 RGB </h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>
        </div>
        <div class="slidee">
          <img src="images/keyboard2.png" alt="">
          <div class="info">
            <h2>SteelSeries Apex 7</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>
        </div>
        <div class="slidee">
          <img src="images/gpu2.png" alt="">
          <div class="info">
            <h2>MSI GeForce RTX 2080Ti SEA HAWK</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>
        </div>
        <div class="slidee">
          <img src="images/keyboard3.png" alt="">
          <div class="info">
            <h2>SteelSeries Apex 350</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>
        </div>
        <div class="slidee">
          <img src="images/gpu1.png" alt="">
          <div class="info">
            <h2>MSI GeForce RTX 2080 TI GAMING X TRIO</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>
        </div>
        <div class="slidee">
          <img src="images/keyboard3.png" alt="">
          <div class="info">
            <h2>Egypt Pyramids</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>
        </div>
        <div class="navigation">
          <i class="fas fa-chevron-left prev-btn"></i>
          <i class="fas fa-chevron-right next-btn"></i>
        </div>
        <div class="navigation-visibility">
          <div class="slide-icon active"></div>
          <div class="slide-icon"></div>
          <div class="slide-icon"></div>
          <div class="slide-icon"></div>
          <div class="slide-icon"></div>
          <div class="slide-icon"></div>
          <div class="slide-icon"></div>
          <div class="slide-icon"></div>
        </div>
      </div>
    </div>

    <section class="featured section " id="featured">
      <h2>Recently Added Products</h2>
      <div class="featured__container bd-grid">
        <?php foreach ($recently_added_products as $product) : ?>
          <a href="index.php?page=product&id=<?= $product['id'] ?>" class="product">
            <div class="productnew">New</div>
            <img src="images/<?= $product['img'] ?>" width="200" height="200" alt="<?= $product['name'] ?>">
            <span class="name"><?= $product['name'] ?></span>
            <span class="price">
              &dollar;<?= $product['price'] ?>
              <?php if ($product['rrp'] > 0) : ?>
                <span class="rrp">&dollar;<?= $product['rrp'] ?></span>
              <?php endif; ?>
            </span>
          </a>
        <?php endforeach; ?>
      </div>
    </section>
    <hr>
    <!-- Adding most popular products -->
    <section class="featured section " id="featured">
      <h2>Popular Products</h2>
      <div class="featured__container bd-grid">
        <?php foreach ($popular_products as $product) : ?>
          <a href="index.php?page=product&id=<?= $product['id'] ?>" class="product">
            <img src="images/<?= $product['img'] ?>" width="200" height="200" alt="<?= $product['name'] ?>">
            <span class="name"><?= $product['name'] ?></span>
            <span class="price">
              &dollar;<?= $product['price'] ?>
              <?php if ($product['rrp'] > 0) : ?>
                <span class="rrp">&dollar;<?= $product['rrp'] ?></span>
              <?php endif; ?>
            </span>
          </a>
        <?php endforeach; ?>
      </div>
    </section>
    <script type="text/javascript">
      const slider = document.querySelector(".slider");
      const nextBtn = document.querySelector(".next-btn");
      const prevBtn = document.querySelector(".prev-btn");
      const slides = document.querySelectorAll(".slidee");
      const slideIcons = document.querySelectorAll(".slide-icon");
      const numberOfSlides = slides.length;
      var slideNumber = 0;

      //image slider next button
      nextBtn.addEventListener("click", () => {
        slides.forEach((slide) => {
          slide.classList.remove("active");
        });
        slideIcons.forEach((slideIcon) => {
          slideIcon.classList.remove("active");
        });

        slideNumber++;

        if (slideNumber > (numberOfSlides - 1)) {
          slideNumber = 0;
        }

        slides[slideNumber].classList.add("active");
        slideIcons[slideNumber].classList.add("active");
      });

      //image slider previous button
      prevBtn.addEventListener("click", () => {
        slides.forEach((slide) => {
          slide.classList.remove("active");
        });
        slideIcons.forEach((slideIcon) => {
          slideIcon.classList.remove("active");
        });

        slideNumber--;

        if (slideNumber < 0) {
          slideNumber = numberOfSlides - 1;
        }

        slides[slideNumber].classList.add("active");
        slideIcons[slideNumber].classList.add("active");
      });

      //image slider autoplay
      var playSlider;

      var repeater = () => {
        playSlider = setInterval(function() {
          slides.forEach((slide) => {
            slide.classList.remove("active");
          });
          slideIcons.forEach((slideIcon) => {
            slideIcon.classList.remove("active");
          });

          slideNumber++;

          if (slideNumber > (numberOfSlides - 1)) {
            slideNumber = 0;
          }

          slides[slideNumber].classList.add("active");
          slideIcons[slideNumber].classList.add("active");
        }, 4000);
      }
      repeater();

      //stop the image slider autoplay on mouseover
      slider.addEventListener("mouseover", () => {
        clearInterval(playSlider);
      });

      //start the image slider autoplay again on mouseout
      slider.addEventListener("mouseout", () => {
        repeater();
      });
    </script>
  </main>
  <script src="js/slideNav.js"></script>

</body>
<?php sub_footer(); ?>

</html>