<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	</head>

	<body>
		<div>
			<table id="tableau">

			</table>
		</div>
		<div>
			<table id="User">

			</table>
		</div>


		<script>

			$(function(){ // document ready en Jquery (on attend que tout soit chargé avant de lancer le script)
					var utilisateur = $().val();


					// Requête AJAX - Récupération infos d'une page
					var request = $.ajax({
					  url: "http://jsonplaceholder.typicode.com/users", // page de la requête
					  method: "GET" // méthode de la requête
					});
					

					request.done(function( mike ) { //Success - on stocke les retours dans la variable Mike.
						var tableau = "<tr>"; // Initiation variable tableau

						// 1st Boucle : Récupère les titres du tableau - En bouclant sur le premier élément de notre réponse (mike[0]), il récupère les keys.
						$.each(mike[0], function(index, value){
							if(index=="name" || index=="username" || index=="email" || index=="phone" || index=="company"){
								tableau += "<th>";
								tableau += index; // Affiche la key -> index de notre objet.
								tableau += "</th>";
							}
						});
						tableau += "</tr>";
						
						// 2nd Boucle : Parcourt chaque ligne de notre tableau.
						for(var i=0; i<mike.length ; i++){
							tableau += "<tr>";
							// 3rd Boucle : Parcourt chaque colonne du tableau.
							$.each(mike[i], function(index, value){
								if(index=="name" || index=="username" || index=="email" || index=="phone" || index=="company"){
									if(index=="name"){ // si l'index est le nom, on rajoute une balise <a>
										
										tableau += "<td class='nameUser'><a href='#'>";
										tableau += value;
										tableau += "</a></td>";

									}
								}
								else{
									tableau += "<td>";
									if(index=="company"){ // Company est un Objet
										tableau += value.name;
									}
									else{
										tableau += value;
									}
									tableau += "</td>";
								}

							});
							tableau += "</tr>";
						}
						
						$("#tableau").html(tableau); // Affiche le tableau dans la balise qui a pour id "table"
						

						$("a").click(function(e){ // Evénement Jquery - Evénement qui se déclenche au clic d'une balise "a" - variable e stocke l'événement
							e.preventDefault(); // Annulation de l'actualisation de la page

							var nameUser = $(this).next();
							var request = $.ajax({
								url: "http://jsonplaceholder.typicode.com/users", // page de la requête
					  			method: "GET" // méthode de la requête
							});


							request.done(function( mike ) { //Success - on stocke les retours dans la variable Mike.
								newTableau = "";
								for(var i=0; i<mike.length ; i++){
									console.log();

									if(mike[i].name == nameUser){
										newTableau="<table><tr>";

										$.each(mike[i], function(index, value){
											newTableau+="<td>";
													
											if(index=="company"){
												newTableau += value.name;
											}
											else if(index=="address"){
												newTableau += value.street + " " + value.city + " " + value.zipcode;
											}
											else{
												newTableau += value;
											}
											newTableau += "</td>";
											

										});
										newTableau += "</tr></table>";
									}
								}
								$("#User").html(newTableau);
							});
						})
					});

					request.fail(function( XPDDR, data ) { // En cas d'erreur de communication avec le serveur ou de code erreur
					  alert( "Request failed" );
					});

  


						
			})


			
		</script>
	</body>

</html>