<?php

$nom = "Gerard"; // LE NOM DE L'UTILISATEUR

$url = "http://localhost/cinema_api/index.php/users/".$nom; // L'URL DE L'INDEX DE l'API

// Complétez le tableau associatif $postFields avec les variables qui seront envoyées par POST au serveur
$postFields=array('name' => $nom);
 
// Tableau contenant les options de téléchargement
$options=array(
      CURLOPT_URL            => $url,       // Url cible (l'url de la page que vous voulez télécharger)
      CURLOPT_RETURNTRANSFER => true,       // Retourner le contenu téléchargé dans une chaine (au lieu de l'afficher directement)
      CURLOPT_HEADER         => false,      // Ne pas inclure l'entête de réponse du serveur dans la chaine retournée
      CURLOPT_FAILONERROR    => true,       // Gestion des codes d'erreur HTTP supérieurs ou égaux à 400
      CURLOPT_POST           => true,       // Effectuer une requête de type POST
      CURLOPT_POSTFIELDS     => $postFields // Le tableau associatif contenant les variables envoyées par POST au serveur
);

$CURL=curl_init();

curl_setopt_array($CURL,$options);

// Exécution de la requête
$content=curl_exec($CURL);            // Le contenu téléchargé est enregistré dans la variable $content. Libre à vous de l'afficher.

 echo $content;

curl_close($CURL);
?>

