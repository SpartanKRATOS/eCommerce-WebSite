<?php

// session_start();



// vérifier si le bouton est enfoncé puis agir
if (isset($_POST['submit'])) {

    // importer la connexion DB à partir du fichier connexion.php
    require 'php/connexion.php';

    // obtenir les valeurs des champs du formulaire de connexion et les stocker dans des variables

    // mysqli_real_escape_string(para1,para2) : juste pour échapper à un caractère pour sécuriser notre base de données de SQL Injection, para1: nous collons le paramètre du fichier connexion.php appelé $ connect, para2: la valeur du champ

    // strtolwer(): changer le nom d'utilisateur en minuscules parce que le nom d'utilisateur déposé ne doit pas être sensible à la casse, par exemple: si écrire nassim ou Nassim doit être la même chose, alors je le fais pour le comparer avec celui de notre base de données qui est lui-même en minuscules 

    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $username = trim(strtolower($username)); // trim pour supprimer tout espace indésirable au premier et au dernier des mots;
    $pwd = mysqli_real_escape_string($connect, $_POST['password']);

    // on vérifie d'abord si les champs sont vides
    if (empty($username) || empty($pwd)) {
        $error = "Please entre the username & password to log in";
    } else {
        // le résumé de tous ces codes est:
        // nous avons sélectionné la ligne qui contient le nom d'utilisateur cible, puis nous le comparons avec la même ligne, mais cette fois, nous voyons le mot de passe si vous pouvez vous connecter, sinon vous ne pouvez pas vous connecter
        $checkDBUsername = "SELECT * FROM users WHERE login='$username';";
        $result = mysqli_query($connect, $checkDBUsername);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['login'] == $username) {
                    $foundUsername = $row['login'];
                    $foundPwd = $row['password'];
                    $id = $row['id'];
                    break;
                }
            }
            if ($foundUsername == $username && $foundPwd == $pwd) {
                // lorsque le nom d'utilisateur et le mot de passe sont corrects, nous faisons une session prendre le nom du nom d'utilisateur afin de garantir l'unicité du nom de la session 
                session_start();
                $_SESSION[$username] = "ok";
                $_SESSION['id'] = $id;
                $_SESSION['product'] = array();
                header("location:index.php?page=profile");
            } else {

                $error = "Username or password is incorrect";
            }
        } else {
            $error = "Username or password is incorrect";
        }
    }
    // nous avons fermé la connexion à DB
    mysqli_close($connect);
}

if (isset($_POST['register'])) {

    // importer la connexion DB à partir du fichier connexion.php
    require 'php/connexion.php';

    // obtenir les valeurs des champs du formulaire de connexion et les stocker dans des variables

    // mysqli_real_escape_string(para1,para2) : juste pour échapper à un caractère pour sécuriser notre base de données de SQL Injection, para1: nous collons le paramètre du fichier connexion.php appelé $ connect, para2: la valeur du champ

    // strtolwer(): changer le nom d'utilisateur en minuscules parce que le nom d'utilisateur déposé ne doit pas être sensible à la casse, par exemple: si écrire nassim ou Nassim doit être la même chose, alors je le fais pour le comparer avec celui de notre base de données qui est lui-même en minuscules 

    $usrname = mysqli_real_escape_string($connect, $_POST['usrname']);
    $firstname = mysqli_real_escape_string($connect, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($connect, $_POST['lastname']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $usrname = trim(strtolower($usrname));
    $firstname = trim(strtolower($firstname));
    $lastname = trim(strtolower($lastname)); // trim pour supprimer tout espace indésirable au premier et au dernier des mots;
    $psswd = mysqli_real_escape_string($connect, $_POST['psswd']);
    $confpsswd = mysqli_real_escape_string($connect, $_POST['confpsswd']);

    // on vérifie d'abord si les champs sont vides
    if (empty($usrname) || empty($firstname) || empty($lastname) || empty($email) || empty($psswd) || empty($confpsswd)) {
        $error = "Please fill all the inputs";
    } else {

        $result = $connect->query("INSERT INTO users(fname, lname, login, password) VALUES('{$firstname}','{$lastname}','{$usrname}','{$psswd}');") or die(print_r($bdd->errorInfo()));;
        //// hena assa7ebi checki wache dazte query and ssifetou l LOGIN PAGE
        session_start();
        $_SESSION[$usrname] = "ok";
        header("location:php/profile.php");
    }
    // nous avons fermé la connexion à DB
    mysqli_close($connect);
}
?>

<?php
include 'inc.php/html_body.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="old_css/all.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" type="text/css" href="Authentication.css">
    <link rel="stylesheet" type="text/css" href="ftr.css">
    <script src="https://kit.fontawesome.com/e1af7c97bd.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap'" rel="stylesheet" />
</head>

<body>
    <?php sub_headers(); ?>
    <div class="all">
        <div class="container">
            <div class="blueBg">
                <div class="box signin">
                    <h2>Already have an account Semi-god ?</h2>
                    <button class="signinBtn">Sign in</button>
                </div>
                <div class="box signup">
                    <h2>Don't have an account mortal ? Pff</h2>
                    <button class="signupBtn">Sign up</button>
                </div>
            </div>
            <div class="formBx">
                <div class="form signinForm">
                    <form method="POST" autocomplete="off">
                        <h3>Sign In</h3>
                        <div class="form-row">
                            <input class="inp" id="usernme" type="text" required placeholder="Enter your username" name="username">
                            <label class="placehold" for="usernme">Enter your <b>Username</b> <small></small></label>
                            <div class="underline"></div>
                        </div>
                        <div class="form-row">
                            <input class="inp" id="passwd" type="password" required placeholder="Enter your Password" name="password">
                            <label class="placehold" for="passwd">Enter your <b>Password</b> <small></small></label>
                            <div class="underline"></div>
                        </div>
                        <br>
                        <input type="submit" name="submit" value="Login">
                        <a href="#" class="forgot">Forgot Password</a>
                    </form>
                </div>
                <div class="form signupForm">
                    <form method="POST" autocomplete="off">
                        <h3>Sign Up</h3>
                        <div class="form-row">
                            <input class="inp" id="firstname" type="text" required placeholder="Enter your firstame" name="firstname">
                            <label class="placehold" for="firstname">Enter your <b>FirstName</b> <small></small></label>
                            <div class="underline"></div>
                        </div>
                        <div class="form-row">
                            <input class="inp" id="lastname" type="text" required placeholder="Enter your lastname" name="lastname">
                            <label class="placehold" for="lastname">Enter your <b>LastName</b> <small></small></label>
                            <div class="underline"></div>
                        </div>
                        <div class="form-row">
                            <input class="inp" id="username" type="text" required placeholder="Enter your username" name="usrname">
                            <label class="placehold" for="username">Enter your <b>Username</b> <small></small></label>
                            <div class="underline"></div>
                        </div>
                        <div class="form-row">
                            <input class="inp" id="email" type="text" required placeholder="Enter your Email Address" name="email">
                            <label class="placehold" for="email">Enter your <b>Email Address</b> <small></small></label>
                            <div class="underline"></div>
                        </div>
                        <div class="form-row">
                            <input class="inp" id="password" type="password" required placeholder="Enter your Password" name="psswd">
                            <label class="placehold" for="password">Enter your <b>Password</b> <small></small></label>
                            <div class="underline"></div>
                        </div>
                        <div class="form-row">
                            <input class="inp" id="conf" type="password" required placeholder="Confirm your Password" name="confpsswd">
                            <label class="placehold" for="conf">Confirm your <b>Password</b> <small></small></label>
                            <div class="underline"></div>
                        </div>
                        <br>
                        <input type="submit" name="register" value="Register">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const signinBtn = document.querySelector('.signinBtn');
        const signupBtn = document.querySelector('.signupBtn');
        const formBx = document.querySelector('.formBx');
        const body = document.querySelector('.all');

        signupBtn.onclick = function() {
            formBx.classList.add('active');
            body.classList.add('active');
        }
        signinBtn.onclick = function() {
            formBx.classList.remove('active');
            body.classList.remove('active')
        }
    </script>
</body>
<?php sub_footer(); ?>

</html>