<?php

if($_POST){
	if(isset($_POST["Mike"]) && !empty($_POST["Mike"])){
		$valeurs = explode(" ", $_POST["Mike"]);
		if(sizeof($valeurs)<=2){
			echo "Nombre de paramètres insuffisants";
		}
		elseif(sizeof($valeurs)>3){
			echo "Nombre de paramètres trop important";
		}
		elseif($valeurs[0]!="Mike"){
			echo "Première valeur incorrecte";
		}
		else{
			$n=1;
			for($i=0; $i<(sizeof($valeurs));$i++){
				
				if($valeurs[$i]!="Mike"){
					if(!is_numeric($valeurs[$i]) && $valeurs[$i]<=0){
						echo "Votre paramètre " . $valeurs[$i] . " n'est pas correct.";
					}
					
				}
				elseif(is_numeric($valeurs[$i]) && $valeurs[$i]>0){
						echo "Paramètre " . $n . " : " . $valeurs[$i] . "<br/>";
						$n=$n+1;
					}
				
			}
			
		}

	}
}

?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title> Piscine </title>
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	</head>
	<body>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form action="" method="post">
					<div class="form-group">
						<label for="text">Entre votre valeur:</label>
						<input type="text" class="form-control" id="Mike" name="Mike">
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
			</div>
		</div>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	</body>
</html>