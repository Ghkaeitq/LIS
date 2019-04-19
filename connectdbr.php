<?php 
	try
		{$bdd = new PDO('mysql:host=localhost;dbname=juliadb;charset=utf8', 'root', '');}
	catch(Exception $e)
		{die('Erreur : '.$e->getMessage());}
?>