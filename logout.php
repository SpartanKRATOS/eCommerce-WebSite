<?php
	

	session_start();

	// nous détruisons la session puis redirige l'utilisateur vers la page de login.php
	session_destroy();
	header("location:index.php?page=login");