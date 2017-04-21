<?php

	/******* START recuperation de la liste des base de donnée *******/
		// CONNEXION BDD
		$pdo = new PDO('mysql:host=localhost;dbname=exo_ajax', 'root', '', array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
		));

		// Requete SQL
		$resultat = $pdo->prepare("SELECT * FROM voiture");
		$resultat->execute();

		// Tri de la requete
		$dataBase = $resultat->fetchall(PDO::FETCH_ASSOC);
	/******* END *******/

?>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	</head>
	<body>
		<div id="contenu">
			<form>
				<label>Marque :</label>
				<input type="text" name="marque" id="marque"/><br/><br/>

				<label>Modèle :</label>
				<input type="text" name="modele" id="modele"/><br/><br/>

				<label>Année :</label>
				<select name="annee" id="annee">
				<?php
					$i = date('Y');
					while($i >= 1900 ){
						echo '<option value="'. $i .'">'. $i .'</option>';
						$i--;
					}
				?>
				</select><br/><br/>

				<label>Couleur :</label>
				<input type="text" name="couleur" id="couleur"/><br/><br/>

				<input type="submit" value="Ajouter voiture" />
			</form>
		</div>
		<div id="voitures">
		</div>
		<div>
			<p id="message"></p>
		</div>



		<script>
			$(function() { // document ready en Jquery
				$( "input[type=submit]" ).click(function(e) { // Evenement Jquery - Evenement qui se déclenche au click d'une balise "input" - variable e stocke l'evenement

					// Annulation de l'actualisation de la page
					e.preventDefault();


					// Récuperation des valeurs du formulaire
					var marque = $("#marque").val(); 
					var modele = $("#modele").val();
					var annee = $("#annee").val(); 
					var couleur = $("#couleur").val();

						
					// Requete Ajax - Envoi des infos du formulaire vers une autre page de traitement
					var request = $.ajax({
						url: "read.php", // Page de la requete
						method: "POST", // Methode de la requete
						data: {marqueVoiture : marque, modeleVoiture : modele, anneeConstruction : annee, couleurVoiture : couleur} // Datas envoyées à la page
					});
						
					request.done(function( msg ) { // Success


						console.log(msg); // Affichage dans la console avant la conversion en un Object - msg est une String

						msg = JSON.parse(msg); // Conversion Json en Object Javascript

						console.info(msg); // Affichage dans la console par la conversion en un Object - msg est un Object Javascript

						if(msg.erreur == false)
						{
							$( "#voitures" ).html( msg.message ); // Mise à jour du contenu de la div qui a pour id "voitures"
							$( "#marque_voiture" ).html( marque ); // Mise à jour du contenu de la span qui a pour id "requet" generer dans le tableau envoyer par le php
							$( "#modele_voiture" ).html( modele );
							$( "#annee_voiture" ).html( annee );
							$( "#couleur_voiture" ).html( couleur);
								
							$("#message").text("Nouvelle voiture ajoutée avec succès");
							$("#message").css( "background-color", "green" );

						}else
						{
							$("#message").text(msg.message);
							$("#message").css( "background-color", "red" );
						}
					});
						
					request.fail(function( jqXHR, textStatus ) {
						alert( "Request failed: " + textStatus ); // En cas d'error de communication avec le serveur ou de code erreur
					});
				});
			});
		</script>
	<body>
<html>