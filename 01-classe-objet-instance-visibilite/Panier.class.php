<?php 

// Par convention d'écriture, on écrira toujours une classe avec sa première lettre en majuscule

// La classe est un modèle de construction, c'est un regroupement d'informations dans lequel nous allons trouver plusieurs éléments

// Un objet (issu d'une classe), est un nouveau type de données, comme les tableaux on peut y retrouver plusieurs éléments, mais pas uniquement des valeurs ! Un objet peut aussi contenir du fonctionnel ! 

class Panier {

    // Des propriétés (et non pas des variables)
    public $nbProduit;
    protected $prixProduit;
    private $totalPanier;

    // Des méthodes (et non pas des fonctions)
    public function ajouterArticle(){
        return "L'article a bien été ajouté.<hr>";
    }

    protected function retirerArticle(){
        return "L'article a bien été retiré.<hr>";
    }

    private function affichageArticle(){
        return "Voici les articles";
    }

}

// echo $nbProduit; // Ceci ne fonctionne pas, dans une classe nous sommes dans un espace local 

// Il faut d'abord instancier la classe Panier, c'est à dire créer un objet de cette classe

$panier1 = new Panier;

// Me retourne les propriétés uniquement (affiche tous les niveaux de visibilité)
echo '<pre>';
var_dump($panier1);
echo '</pre>';
echo '<pre>';
print_r($panier1);
echo '</pre>';

// Me retourne les méthodes uniquement (affiche uniquement les méthodes de visibilité public)
echo '<pre>';
var_dump(get_class_methods($panier1));
echo '</pre>';
echo '<pre>';
print_r(get_class_methods($panier1));
echo '</pre>';

$panier1->nbProduit = 5; // Attention à ne pas mettre le $, car lors d'un appel sur l'objet, le système comprends que l'on parle de sa propre propriété
echo '<pre>';
print_r($panier1);
echo '</pre>';

echo "Nombre de produits dans le panier1 : " . $panier1->nbProduit . "<hr>";

// $panier1->totalPanier = 25;

// On tente maintenant d'appeler les méthodes de l'objet 

echo $panier1->ajouterArticle();

// echo $panier1->retirerArticle(); // Fatal error, impossible d'appeler depuis l'extérieur une méthode ou propriété protected

// echo $panier1->affichageArticle(); // Fatal error, impossible d'appeler depuis l'extérieur une méthode ou propriété private

// Autrement dit, depuis l'extérieur de la classe on ne peut appeler que les éléments de visibilité public
// Nous sommes limité pour pouvoir atteindre les éléments protected/private qui eux seront directement accessible dans l'espace LOCAL de la classe.

$panier2 = new Panier;
$panier2->nbProduit = 1850;
echo '<pre>';
var_dump($panier1);
echo '</pre>';
echo '<pre>';
var_dump($panier2);
echo '</pre>';
// Ce nouvel objet $panier2 est totalement indépendant du premier, identifiant différent, nombre d'articles différent

/* 

    Une classe est un plan de construction, un modèle qui permet de regrouper des données, des informations (valeurs + fonctionnel)
    Pour exploiter ce qui est déclaré dans les classes, nous devons créer une instance, c'est à dire un objet, issu de cette classe grâce au mot clé "new"
    Une classe peut produire plusieurs objets. On appelera ça aussi un enfant de la classe.
    $panier1 et $panier2 représente des objets issues de la classe Panier

    ********************************************

        public : Accessible de partout (aussi bien à l'intérieur qu'à l'extérieur des classes)

        protected : Accessible uniquement dans la classe où cela a été déclaré MAIS AUSSI dans les classes héritières.

        private : Accessible uniquement dans la classe où cela a été déclaré.

        // Les niveaux de visibilité permettent de protéger les données d'une potentielle intrusion ou modification accidentelle ou non prévue dans le cadre de développement.

    *******************************************
        Quand vous instanciez une classe, la variable stockant l'objet ne stocke pas exactement l'objet lui même, mais, un identifiant qui représente cet objet.


*/
