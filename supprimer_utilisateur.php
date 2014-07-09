<?php

$id = 2; // LE NOM DE L'UTILISATEUR

$url = "http://localhost/cinema_api/index.php/users/".$id; // L'URL DE L'INDEX DE l'API

$postFields=array('id' => $id);
 
      
// Tableau contenant les options de téléchargement
$options=array(
      CURLOPT_URL            => $url,    
      CURLOPT_RETURNTRANSFER => true,    
      CURLOPT_HEADER         => false,   
      CURLOPT_CUSTOMREQUEST  => "DELETE",
      CURLOPT_POST           => true,       // Effectuer une requête de type POST
      CURLOPT_POSTFIELDS     => $postFields // Le tableau associatif contenant les variables envoyées par POST au serveur
);

$CURL=curl_init();

curl_setopt_array($CURL,$options);

// Exécution de la requête
$content=curl_exec($CURL);            // Le contenu téléchargé est enregistré dans la variable $content. Libre à vous de l'afficher.


if (!$content) {
    die("Connection Failure");
}
else
{
	 echo $content;
}

curl_close($CURL);


