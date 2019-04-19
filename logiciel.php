<?php include("connectdbr.php");?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>JULIA</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link href="assets/css/select2.min.css" rel="stylesheet" /> 
		<script src="assets/js/jquery.js"></script>
		<script src="assets/js/select2.min.js"></script>
	</head>
	<body class="is-preload">
		<div id="wrapper">
			<div id="main">
				<div class="inner">
					<?php include("header.php");?>
						<section id="banner">
							<div class="content">
								<header>
									<h1>Rechercher une salle à partir d'un logiciel </h1>
									<p>A utiliser pour toute nouvelle page</p>
								</header>
									<form method="post" action="logiciel.php">
									<div style="display: flex;">
										<div>
										<select name="idlogiciel" class="js-example-basic-single" id="selectlogiciel">
												<?php 
													$reqsoftw = $bdd->query('SELECT * FROM logiciels GROUP BY nom');
													while ($listsoftw = $reqsoftw->fetch()){
													?>
													<option value="<?php echo $listsoftw['id']; ?>" 
														<?php if (isset($_POST['idlogiciel'])){ if($listsoftw['id']==$_POST['idlogiciel']){echo ('selected="selected"');}}?> 
													><?php echo ($listsoftw['nom']); ?></option>
													<?php
													}
													$reqsoftw->closeCursor(); // Termine le traitement de la requête
												?>										
										</select>
										<script type="text/javascript">
										$(document).ready(function() {
											$('.js-example-basic-single').select2();
										});</script>
										</div><div>
										<input type="submit" value="Trouver une salle" />
										</div>
									</div>
									</form>
									<?php if (isset($_POST['idlogiciel'])){
										$result = $bdd->prepare('SELECT s.nom as nomsalle, b.nom as nombatiment, nbpostes, s.commentaire as commentairesalle, version FROM `salle` s 
											INNER JOIN `batiment` b ON b.id=s.idbatiment
											INNER JOIN `linklogicielsalle` ls ON s.id=ls.idsalle 
											INNER JOIN `logiciels` l ON l.id=ls.idlogiciel
											WHERE ls.idlogiciel = ?');
										$result->execute(array($_POST['idlogiciel']));
										
										if ($result->rowCount() > 0) {
											echo("<table><tr><th>Nom de la salle</th><th>Batiment</th><th>Nombre de postes</th><th>Commentaire</th><th>Version du logiciel</th></tr>");
											while ($row = $result->fetch()) {
												echo ("<tr><td>" . $row["nomsalle"] . "</td><td>" . $row["nombatiment"] . "</td><td>". $row["nbpostes"]."</td><td>" . $row["commentairesalle"]. "</td><td>". $row["version"]. "</td></tr>");
											}
											echo("</table>");
										} else {
											echo ("Désolé. Ce logiciel n'est actuellement installé dans aucune des salles pédagogiques");
										}
										$result->closeCursor();
									}
									?>
							</div>
						</section>			
				</div>
			</div>
			<?php include("menus.php"); ?>
		</div>
	</body>
</html>