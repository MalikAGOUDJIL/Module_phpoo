<?php 

class Maison 
{
    public $couleur = "blanche"; // Une propriété qui appartient à l'objet
    public static $espaceTerrain = "500m²"; // Une propriété statique appartient à la classe et non pas à l'objet, n'est pas changeable sur l'objet directement
    const HAUTEUR = "10m"; // Déclaration d'une constante qui appartient à la classe et non pas à ses instances. Par défaut la constante est publique

    private static $nbPiece = 7; // Une propriété statique mais private ! Impossible de l'appeler à l'extérieur, nous devons donc passer par des getter/setter 
    private $nbPorte = 10; // Ici appartient à l'objet 

    public static function setNbPiece($nbr) // Methode static appartient à la classe
    {
       self::$nbPiece = $nbr; // On utilise non pas $this-> car cette syntaxe est propre au contexte des objets, ici on est dans un contexte d'element static, donc on doit utiliser l'équivalent pour le static à savoir : self::$ 
    }

    public static function getNbPiece() // Methode static appartient à la classe
    {
        return self::$nbPiece; // On utilise non pas $this-> car cette syntaxe est propre au contexte des objets, ici on est dans un contexte d'element static, donc on doit utiliser l'équivalent pour le static à savoir : self::$ 
    }

    public function getNbPorte() // Methode appartient à l'objet
    {
        return $this->nbPorte; // ici on utilise bien $this comme dans le chapitre 2 car nbPorte appartient à l'objet
    }


}

// $maison10 = new Maison;
// // Insertion de la maison 10 dans la BDD on insère maison10 couleur blanche, espace terrain 500
// $maison11 = new Maison;
// $maison11->couleur = "Rouge";
// // Insertion de la maison 11 dans la BDD on insère maison11 couleur rouge, espace terrain 500
// $maison12 = new Maison;
// $maison12->couleur = "Noire";
// // Insertion de la maison 12 dans la BDD on insère maison12 couleur noire, espace terrain 500
// Maison::$espaceTerrain = '600m²'; 
// $maison13 = new Maison;
// $maison13->couleur = "Beige";
// // Insertion de la maison 13 dans la BDD, on insère maison13 couleur beige, espace terrain 600



// echo $couleur;
// echo $espaceTerrain;  // Tout ces éléments sont dans l'espace local de Maison
// echo HAUTEUR;

echo "Espace terrain : " . Maison::$espaceTerrain . '<hr>'; // Avec les :: on peut appeler des propriétés/méthodes de la classe sans avoir instancié d'objet
echo "Hauteur de la maison : " . Maison::HAUTEUR . "<hr>";
Maison::$espaceTerrain = '600m²'; // Pas de soucis pour modifier une propriété statique tant qu'elle est publique 
echo "Espace terrain après modif : " . Maison::$espaceTerrain . '<hr>';
// Maison::HAUTEUR = "50m"; // Ne fonctionne pas, c'est une constante, on ne peut plus la modifier par la suite. Modifiable uniquement dans sa déclaration

$maison1 = new Maison;
echo '<pre>';
print_r($maison1); // Les propriétés static n'apparaissent pas (les méthodes non plus si on fait get_class_methods)
echo '</pre>';

// Maison::$nbPiece = 8; // Impossible car private ! il faut passer par le setter/getter

Maison::setNbPiece(8); // Il faut que notre setter soit statique aussi sinon on ne pourrait pas l'appeler sans instanciation

echo "Nombre de pièces après modification : " . Maison::getNbPiece() . "<hr>";

// Faisons quelques tests pour voir à quel point php peut être permissif sur l'orienté objet

// echo $maison1->espaceTerrain . '<hr>'; // ERREUR, pas possible d'appeler une propriété static d'une classe via un objet
// echo Maison::$couleur; // ERREUR, pas possible d'appeler une propriété non static via la classe
// echo Maison::getNbPorte(); // ERREUR, je ne peux pas appeler une méthode appartenant à l'objet de façon static
// echo $maison1->getNbPiece(); // PAS D'ERREUR, php est permissif... Il devrait déclencher une erreur car on appelle une méthode statique comme une méthode appartenant à l'objet
// echo $maison1::$espaceTerrain; // PAS D'ERREUR, ici php est TRES PERMISSIF ! Devrait déclencher une erreur, syntaxe totalement incohérence

// ATTENTION ! Nous ne sommes pas à l'abri d'une correction de PHP sur ces éléments là... Ne jamais utiliser les syntaxes "exotiques"

/******************************************** 
 
    Petit rappel de syntaxe :

        $objet->element d'un objet à l'extérieur de la classe
        $this->element d'un objet à l'intérieur de la classe 
        Class::element static d'une classe à l'extérieur de la classe
        self::element static d'une classe à l'intérieur de la classe 

        2 questions à se poser pour retrouver ça :
            - Est ce que c'est static ?
                - Si oui (self::, Class::)
                    - Est ce que c'est DANS la classe ?
                        si oui, self:: 
                        si non, Class::
                - Si non static ($objet->, $this->)
                    - Est ce que c'est DANS la classe ?
                        si oui, $this->
                        si non, $objet-> 

    static indique qu'un élément appartient A LA CLASSE :
        - Si c'est une propriété, on pourra la modifier
        - Si c'est une constante, on ne peut pas la redéfinir

    Lorsque l'on appelle une propriété via l'objet, il ne faut pas mettre le signe $ devant 
    Lorsque l'on appelle une propriété via la classe (static) il faut mettre le $ devant 



 */