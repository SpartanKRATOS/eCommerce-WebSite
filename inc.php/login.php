<?php

// vérifier si le bouton est enfoncé puis agir
if(isset($_POST['submit'])){

	// importer la connexion DB à partir du fichier connexion.php
	require 'connexion.php';
	
	// obtenir les valeurs des champs du formulaire de connexion et les stocker dans des variables

	// mysqli_real_escape_string(para1,para2) : juste pour échapper à un caractère pour sécuriser notre base de données de SQL Injection, para1: nous collons le paramètre du fichier connexion.php appelé $ connect, para2: la valeur du champ
	
	// strtolwer(): changer le nom d'utilisateur en minuscules parce que le nom d'utilisateur déposé ne doit pas être sensible à la casse, par exemple: si écrire nassim ou Nassim doit être la même chose, alors je le fais pour le comparer avec celui de notre base de données qui est lui-même en minuscules 
	
	$username = mysqli_real_escape_string($connect,$_POST['username']);
	$username=trim(strtolower($username));// trim pour supprimer tout espace indésirable au premier et au dernier des mots;
	$pwd = mysqli_real_escape_string($connect,$_POST['pwd']);
	
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
				header("location:profile.php");
				
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
<?php
include '../inc.php/html_body.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login.css">
   
	<link rel="icon" href="../images/login.png" type="image/png" >
    <script src="https://kit.fontawesome.com/e1af7c97bd.js" crossorigin="anonymous"></script>
    
    <link
      href="https://fonts.googleapis.com/css?family=Raleway:600,900"
      rel="stylesheet"
    />
    <title>Login</title>
</head>
<body>
<div class="all">
      <div class="full-page">
    <?php sub_headers(); ?>

    <div class="form_content">
    <form autocomplete="off" action="" method="POST">
			<h1>Login</h1>
			
			<input type="text"  name="username" placeholder="Username" />
			<input type="password" name="pwd" placeholder="Password" />
			<?php if(!empty($error)) { ?>
				<div id="error">
				<p>
					<i class="fas fa-exclamation-circle"></i>
					<?php echo $error; ?>
					</p>
				</div>
			<?php } ?>

			
            
            
            
            <button type="submit" name="submit">Login</button>
			<a href="register.php">Create new account</a>
		</form>
        </div>
    </div>
    
    <?php sub_footer(); ?>
    </div>
</body>
</html>