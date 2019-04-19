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
									<h1>Tests pour le dev<br />
								</header>
								<div style="
								display: flex;
								flex-direction: row;">		
									<form method="post" action="test.php" style="background-color:lightblue";>
										<select name="idlogiciel" class="js-example-basic-single" id="selectlogiciel">
												<?php 
													$reqsoftw = $bdd->query('SELECT * FROM logiciels GROUP BY nom');
													while ($listsoftw = $reqsoftw->fetch()){
													?>
													<option value="<?php echo $listsoftw['id']; ?>"><?php echo ($listsoftw['nom']); ?></option>
													<?php
													}
													$reqsoftw->closeCursor(); // Termine le traitement de la requête
												?>										
										</select>
										<script type="text/javascript">
										$(document).ready(function() {
											$('.js-example-basic-single').select2();
										});</script>
										<input type="submit" value="Trouver une salle" />
										
									</form>
								</div>
								<div>
									J'écrinimp
									<img src="images/icon_suppr25px.png" alt="Photo de montagne" />
								</div>
<!--								<script>
									console.log("Bonjour en JavaScript !");
									var selection = document.getElementById('selectlogiciel');
									var display = document.getElementById('selectversion');
									selection.addEventListener('click', function() {          // On écoute l'événement click
													console.log( selection.value );
													display.innerHTML = selection.value;  
									});
								</script> !-->
							</div>
						</section>			
				</div>
			</div>
			<?php include("menus.php"); ?>
		</div>
	</body>
</html>