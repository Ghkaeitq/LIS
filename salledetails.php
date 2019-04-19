<?php include("connectdbr.php");?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>JULIAdmin - Detail d'une salle</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">
		<div id="wrapper">			
			<div id="main">
				<div class="inner">
					<?php include("header.php");?>
						<section id="banner">
							<div class="content">
							<?php if (isset($_GET['idsalle']) && ($_GET['idsalle'])!=""){
									try
									{$bdd = new PDO('mysql:host=localhost;dbname=juliadb;charset=utf8', 'root', '');}
									catch(Exception $e)
									{die('Erreur : '.$e->getMessage());}
									$info = $bdd->prepare('
											SELECT * FROM salle  
											WHERE id = ?');
									$info->execute(array($_GET['idsalle']));
									$infosalle = $info->fetch();								
									?>
								<header>
									<h1><?php echo ($infosalle['nom']);?></h1>									
								</header>
								<H2>Informations de <?php echo ($infosalle['nom']);?></H2>
									<table style="width:100%">
									<tr><td>Nom de la salle </td><td><?php echo ($infosalle['nom']);?></td></tr>
									<tr><td>Nombre de postes </td><td><?php echo ($infosalle['nbpostes']);?></td></tr>
									<tr><td>Bâtiment </td><td>
											<?php 
												$reqbat = $bdd->query('SELECT * FROM batiment');
												while ($listbat = $reqbat->fetch()){
												if($listbat['id']==$infosalle['idbatiment']){echo $listbat['nom'];}}
												$reqbat->closeCursor(); // Termine le traitement de la requête
											?>
									</td></tr>
									<tr><td>Commentaires </td><td><?php echo ($infosalle['commentaire']);?></td></tr>									
									</table>					
								<BR><BR><BR>
								<h2> Liste des logiciels </h2>
										<?php							
																												
										$req = $bdd->prepare('
											SELECT l.id as idlogiciel, l.nom, l.version FROM linklogicielsalle ls 
											INNER JOIN logiciels l ON ls.idlogiciel=l.id
											WHERE idsalle = ?');
										$req->execute(array($_GET['idsalle']));
										
											?><table style="width:100%"><tr><th>Nom</th><th>Version</th></tr><?php
											while ($donnees = $req->fetch()){
												?><tr><td><?php echo $donnees['nom']; ?></td><td><?php echo $donnees['version']; ?></td></tr><?php
											}
											$req->closeCursor(); // Termine le traitement de la requête
											$info->closeCursor();
										?>
										</table>
									<HR>	

									<?php									
							}?>
							</div>
						</section>			
				</div>
			</div>
			<?php include("menus.php"); ?>
		</div>
	</body>
</html>