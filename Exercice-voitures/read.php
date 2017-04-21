<?php

header("Access-Control-Allow-Origin: *");

$retour = array("erreur" => true); // Initialisation de la variable de retour


if(isset($_POST["marqueVoiture"]) && isset($_POST["modeleVoiture"]) && isset($_POST["anneeConstruction"]) && isset($_POST["couleurVoiture"])){
	
	if(!empty($_POST["marqueVoiture"]) && !empty($_POST["modeleVoiture"]) && !empty($_POST["anneeConstruction"]) && !empty($_POST["couleurVoiture"])){


		// Connexion bases de données
		$pdo = new PDO('mysql:host=localhost;dbname=exo_ajax', 'root', '', array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
		));

		// Requête SQL
		$resultat = $pdo -> prepare("INSERT INTO voiture (marque, modele, annee, couleur) VALUES($_POST["marqueVoiture"], $_POST["modeleVoiture"], $_POST["anneeConstruction"], $_POST["couleurVoiture"])");
		
		if($resultat -> execute()){

			$utilisateurs = $resultat->fetchAll(PDO::FETCH_ASSOC);

		

			// Création de la variable $voiture
			$newVoiture = "<div>
				<div>
					<p>Marque : <span id='marque_voiture'></span></p>
					<p>Modèle : <span id='modele_voiture'></span></p>
					<p>Année : <span id='annee_voiture'></span></p>
					<p>Couleur : <span id='couleur_voiture'></span></p>
				</div>
				<div>" ;

			echo $newVoiture;

			$retour["erreur"] = false;
					$retour["message"] = $newVoiture;
		}
		else{
			$retour["message"] = $resultat->errorInfo()[2];
		}
	}
	else{
		$retour["message"] = "Parametre vide!";  // Gestion erreur if empty variable POST
	}
}
else{
	$retour["message"] = "Parametre manquant!";  // Gestion erreur if isset variable POST
}

echo json_encode($retour);




?>