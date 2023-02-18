<?php 

namespace General;

// Les namespace (espace de nom) permettent de ranger nos classes (un peu comme des dossiers)
// Il est possible que 2 classes possèdent le même nom mais proviennent de namespace différents, de ce fait, il n'y aura pas de conflits entre ces deux classes.
// Intéressant dans le cas de travail en équipe ! Deux développeurs qui travaillent sur le même projet, tant qu'ils utilisent des namespaces, n'auront pas de conflit sur le nom de leurs classes/méthodes 
// On essaiera dans de gros projets d'utiliser au maximum les namespace 

require("namespace_commerce.php");

// Permet de dire quel namespace je souhaite importer du fichier namespace_commerce.php
use Commerce1, Commerce2, Commerce3;


echo __NAMESPACE__ . '<hr>'; // Constant magique me permettant de voir dans quel namespace je me trouve actuellement

$commande = new Commerce1\Commande; // Syntaxe pour piocher dans un namespace appelé par use, ici instanciation d'un objet de la classe Commande venant du namespace Commerce1
echo '<pre>';
print_r($commande);
echo '</pre>';
echo "Nombre de commandes : " . $commande->nbCommande . '<hr>';

$produit = new Commerce2\Produit;
echo '<pre>';
print_r($produit);
echo '</pre>';

$produit2 = new Commerce3\Produit;
echo '<pre>';
print_r($produit2);
echo '</pre>';



$pdo = new \PDO('mysql:host=localhost;dbname=entreprise', 'root', '');
// Sans l'antislash, cela recherche la classe PDO dans le namespace General, dans une namespace, on est en quelque sorte à l'extérieur de l'espace global de php.
// l'ajout de l'antislash me permet de revenir d'un niveau et donc dans l'espace global d'origine de php et donc il retrouve bien la classe PDO, LE TEMPS DE LA LIGNE !

