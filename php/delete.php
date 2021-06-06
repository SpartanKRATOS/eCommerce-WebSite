<?php 

// le script de javascript nous redirige cette page juste si l'utilisateur veut vraiment supprimer son compte
// nous prenons la valeur de la méthode GET que le code javascript nous a envoyé et utilisons del_id qui représente sur notre cas le nom d'utilisateur 
// note: nous prenons le nom d'utilisateur juste parce qu'il est unique mais s'il n'était pas unique, nous pouvons prendre la clé primaire de notre base de données qui est l'identifiant
require 'connexion.php';
$get=$_GET['del_id'];
$getusername="$get";
$sql="DELETE FROM users WHERE login='$getusername'";
$query=mysqli_query($connect,$sql) or die($sql);
header("location:index.php");
exit();