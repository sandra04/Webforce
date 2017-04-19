<?php

header("Access-Control-Allow-Origin: *");

// Connexion bases de données
$pdo = new PDO('mysql:host=localhost;dbname=mike', 'root', '', array(
	PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
));

$resultat = $pdo -> prepare("SELECT * FROM utilisateurs");
$resultat -> execute();

/*
$tableau = '<table border="1">';
$tableau.= '<tr>';
for ($i=0; $i<$resultat -> columnCount(); $i++){
	$meta = $resultat -> getColumnMeta($i);
	$tableau.= '<th>' . $meta['name'] . '</th>';
}
$tableau.= '</tr>';


while($utilisateurs = $resultat -> fetchAll()){
	for($i=0; $i<sizeof($utilisateurs); $i++){
		$tableau.="<tr>";
		$tableau.="<td>".$utilisateurs[$i]["id"]."</td>";
		$tableau.="<td>".$utilisateurs[$i]["nom"]."</td>";
		$tableau.="<td>".$utilisateurs[$i]["prenom"]."</td>";
		$tableau.="<td>".$utilisateurs[$i]["poste"]."</td>";
		$tableau.="<td>".$utilisateurs[$i]["date_create"]."</td>";
		$tableau.="</tr>";
	}
}
$tableau.="</table>";
echo $tableau;*/


// CORRECTION

$utilisateurs = $resultat->fetchAll(PDO::FETCH_ASSOC);

$tableau = "<table><tr>" ;
foreach($utilisateurs[0] as $key => $value){
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
$tableau.="</table>";

echo $tableau;



//sleep(20);
//var_dump($utilisateurs);


?>