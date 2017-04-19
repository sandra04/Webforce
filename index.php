<?php

// Connexion bases de données
		$pdo = new PDO('mysql:host=localhost;dbname=mike', 'root', '', array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
		));

		// Requête SQL
		$resultat = $pdo -> prepare("SHOW DATABASES;");
		$resultat -> execute();

		// Tri de la requete
		$dataBase = $resultat->fetchAll(PDO::FETCH_ASSOC);


?>


<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	</head>

	<body>
		<div id="mike">
			<form>
				<select id="databaseSelect">

					<?php foreach($dataBase as $key=>$value){

						echo '<option value="'. $value['Database'].'">' . $value['Database'] . '</option>';
					}
					?>
				</select><br/>
				
				<fieldset>
					<legend>Requete</legend>

					<textarea name="sql" id="sql" rows="4" cols="50"></textarea>
					<br/>
					<input type="submit" value="Envoyer"/>
				</fieldset>
			</form>
		</div>

		<script>

			$(function(){
				$("input").click(function(e){
					// Annulation de l'actualisation de la page
					e.preventDefault();
					console.log("Mike")


					// Récupération de la valeur de notre textarea
					var myRequest = $("#sql").val();

					var dataBase = $("#databaseSelect").val();


					// Requête AJAX - Envoi des infos du formulaire
					var request = $.ajax({
					  url: "read2.php", // page de la requête
					  method: "POST", // méthode de la requête
					  data:{Requet : myRequest, data: dataBase} // data envoyée à la page
					});
					
					request.done(function( msg ) {
					  $( "#mike" ).html( msg );
					  $( "#requet" ).html( myRequest );
					});
					 
					request.fail(function( jqXHR, textStatus ) {
					  alert( "Request failed: " + textStatus );
					});
						
				});
			});


			
		</script>
	</body>
</html>