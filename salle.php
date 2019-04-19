<?php include("connectdbr.php");?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>JULIAdmin - Salles</title>
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
								<header>
									<h1>Contenu des salles</h1>
									<p>Liste des salles</p>
								</header>
									<p>Selectionnez une salle pour avoir accès à la liste des logiciels présents dans la salle</p>
									<?php 			
									$reponse = $bdd->query('SELECT s.id, s.nom as nomsalle, s.nbpostes, b.nom as nombatiment, s.commentaire, count(ls.id) 
															FROM salle s 
															LEFT JOIN linklogicielsalle ls on s.id=ls.idsalle
															LEFT JOIN logiciels l on ls.idlogiciel=l.id
															LEFT JOIN batiment b on s.idbatiment=b.id
															GROUP BY (s.nom)
															ORDER BY b.id');
									?><table style="width:100%"><tr><th>Nom</th><th>Nb de postes</th><th>Batiment</th><th>Commentaires</th><th>Nb de Logiciels</th></tr><?php
									while ($donnees = $reponse->fetch()){
										?>
										<tr>
										<td><a href="salledetails.php?idsalle=<?php echo $donnees['id']; ?>"><?php echo $donnees['nomsalle']; ?></a></td>
										
										<td><?php echo $donnees['nbpostes']; ?></td><td><?php echo $donnees['nombatiment']; ?></td><td><?php echo $donnees['commentaire']; ?></td><td><?php echo $donnees['count(ls.id)']; ?></td></tr>
										<?php
									}
									$reponse->closeCursor(); // Termine le traitement de la requête
								?>

								</table>
								</table>
							</div>
						</section>			
				</div>
			</div>
			<?php include("menus.php"); ?>
		</div>
	</body>
</html>
