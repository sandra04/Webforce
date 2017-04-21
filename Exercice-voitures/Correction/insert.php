<?php

if(isset($_POST)){

	if(!empty($_POST)){
		try{
			$PDO = new PDO("mysql:host=localhost;dbname=exo_ajax", "root", "");
			$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		}
		catch(PDOException $e){
			echo "La table n'existe pas";
		}
		$insertRequet = $PDO->prepare("INSERT INTO `voiture`(`marque`, `modele`, `annee`, `couleur`) VALUES (:marque,:modele,:annee,:couleur)");

		$insertRequet -> bindParam(":marque", $_POST["marque"]);
		$insertRequet -> bindParam(":modele", $_POST["modele"]);
		$insertRequet -> bindParam(":annee", $_POST["annee"]);
		$insertRequet -> bindParam(":couleur", $_POST["couleur"]);

		$insertRequet -> execute();

		echo "<p style='color:green'>OK - 270 KAA</p>";

	}
	else{
		echo "<p style='color:red'>FAIL</p>";
	}
}
else{
	echo "<p style='color:red'>FAIL</p>";
}



?>