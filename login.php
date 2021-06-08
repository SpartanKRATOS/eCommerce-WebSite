<?php

// session_start();

 if (isset($_SESSION)) { // lorsque nous avons vérifié les noms d'utilisateur et que nous ne trouvons pas de session, cette page redirigera n'importe qui vers la page login.php
		header("location:index.php?page=profile");
		exit();     // in order to not reach the html tags so the page wont load for the user.
	 }

// vérifier si le bouton est enfoncé puis agir
if(isset($_POST['submit'])){

	// importer la connexion DB à partir du fichier connexion.php
	require 'php/connexion.php';
	
	// obtenir les valeurs des champs du formulaire de connexion et les stocker dans des variables

	// mysqli_real_escape_string(para1,para2) : juste pour échapper à un caractère pour sécuriser notre base de données de SQL Injection, para1: nous collons le paramètre du fichier connexion.php appelé $ connect, para2: la valeur du champ
	
	// strtolwer(): changer le nom d'utilisateur en minuscules parce que le nom d'utilisateur déposé ne doit pas être sensible à la casse, par exemple: si écrire nassim ou Nassim doit être la même chose, alors je le fais pour le comparer avec celui de notre base de données qui est lui-même en minuscules 
	
	$username = mysqli_real_escape_string($connect,$_POST['username']);
	$username=trim(strtolower($username));// trim pour supprimer tout espace indésirable au premier et au dernier des mots;
	$pwd = mysqli_real_escape_string($connect,$_POST['password']);
	
	// on vérifie d'abord si les champs sont vides
	if(empty($username) || empty($pwd) ){
		$error="Please entre the username & password to log in";
	}else{
		// le résumé de tous ces codes est:
		// nous avons sélectionné la ligne qui contient le nom d'utilisateur cible, puis nous le comparons avec la même ligne, mais cette fois, nous voyons le mot de passe si vous pouvez vous connecter, sinon vous ne pouvez pas vous connecter
		$checkDBUsername="SELECT * FROM users WHERE login='$username';";
		$result=mysqli_query($connect,$checkDBUsername);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck > 0){
			while($row = mysqli_fetch_assoc($result)){
				if($row['login'] == $username){
					$foundUsername=$row['login'];
					$foundPwd=$row['password'];
					break;
				}
			}
			if($foundUsername == $username && $foundPwd == $pwd ){
				// lorsque le nom d'utilisateur et le mot de passe sont corrects, nous faisons une session prendre le nom du nom d'utilisateur afin de garantir l'unicité du nom de la session 
				session_start();
				$_SESSION[$username] = "ok";
				header("location: index.php?page=profile");
				
			}else{
				
				$error="Username or password is incorrect";
				
			}

		}else{
				$error="Username or password is incorrect";
				}
		
	}
	// nous avons fermé la connexion à DB
	mysqli_close($connect);
}
 
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width , initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="css/Authentication.css">
    </head>
    <body>
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
                        <input type="text" placeholder ="Username" name="username">
                        <input type="password" placeholder ="Password" name="password">
                        <input type="submit" name="submit" value="Login">
                        <a href="#" class="forgot">Forgot Password</a>
                    </form>
                </div>
                <div class="form signupForm">
                    <form method="POST" autocomplete="off">
                        <h3>Sign Up</h3>
                        <input type="text" placeholder ="Username">
                        <input type="text" placeholder ="Email Address">
                        <input type="password" placeholder ="Password">
                        <input type="password" placeholder ="Confirm Password">
                        <input type="submit" value="Register">
                    </form>
                </div>
            </div>
        </div>
        <script>
            const signinBtn = document.querySelector('.signinBtn');
            const signupBtn = document.querySelector('.signupBtn');
            const formBx = document.querySelector('.formBx');
            const body = document.querySelector('body');

            signupBtn.onclick = function(){
                formBx.classList.add('active');
                body.classList.add('active');
            }
            signinBtn.onclick = function(){
                formBx.classList.remove('active');
                body.classList.remove('active')
            }
        </script>
    </body>
</html>