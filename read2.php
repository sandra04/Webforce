<?php

header("Access-Control-Allow-Origin: *");



if(isset($_POST["Requet"]) && isset($_POST["data"])){
	
	if(!empty($_POST["Requet"]) && !empty($_POST["data"])){


		// Connexion bases de données
		$pdo = new PDO('mysql:host=localhost;dbname='.$_POST["data"], 'root', '', array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
		));

		// Requête SQL
		$resultat = $pdo -> prepare($_POST["Requet"]);
		$resultat -> execute();

		$utilisateurs = $resultat->fetchAll(PDO::FETCH_ASSOC);

		// Création de la variable $tableau
		$tableau = "<div>
			<div>
				<p>Requet <span id='requet'></span></p>
				<p>Nombre de lignes <span id='lignes'>".$resultat->RowCount()."</span></p>
			</div>
			<div>
				<table>
					<tr>" ;

		// Même syntaxe. Tri du PREMIER et SEUL élément
		foreach($resultat->fetchAll(PDO::FETCH_ASSOC) as $key => $value){
			$tableau.="<th>".$key."</th>";
		}

		$tableau.="</tr>";

		foreach($utilisateurs as $key => $value){
			$tableau.="<tr>";
			foreach($utilisateurs[$key] as $key => $value){
				$tableau.="<td>".$value."</td>";
			}
			$tableau.="</tr>";
		}
		$tableau.="</table></div></div>";

		echo $tableau;


	}
}

//sleep(20);
//var_dump($utilisateurs);


?>