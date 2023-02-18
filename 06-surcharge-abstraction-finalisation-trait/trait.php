<?php

trait TPanier
{
    private $nbProduit = 5;
    public function affichageProduits()
    {
        return "Affichage des produits<hr>";
    }
}

trait TMembre
{
    public function affichageMembres()
    {
        return "Affichage des membres<hr>";
    }
}

###############################################

// $panier = new TPanier; // Erreur je ne peux pas instancier un trait 

class Site 
{
    use TMembre, TPanier; // Importation des traits déclarés ci-dessus via le mot clé 'use'
}

###############################################

$site = new Site;

echo '<pre>';
print_r($site);
echo '</pre>';
echo '<pre>';
print_r(get_class_methods($site));
echo '</pre>';

// Site Object
// (
//     [nbProduit:Site:private] => 5
// )
// Array
// (
//     [0] => affichageMembres
//     [1] => affichageProduits
// )

// echo "Nombre de produits dans le panier : " . $site->nbProduit . "<hr>";
echo $site->affichageMembres();
echo $site->affichageProduits();

/* 

    Les traits ont été inventés pour repousser les limites de l'héritage
    Une classe ne peut hériter que d'une seule autre classe à la fois.
    En revanche, elle peut importer plusieurs traits à la fois.
    Un trait est un regroupement de méthodes et propriétés pouvant être importées dans une classe.

    Petit détail, contrairement à l'héritage, on va récupérer également les propriétés et méthodes de visibilité 'private' 

    Aussi, on ne peut pas instancier un trait seul, on doit l'importer avec 'use'

*/

// Un trait peut utiliser un autre trait :

trait A 
{
    public function a()
    {
        return "a";
    }
}
trait B 
{
    use A;
    public function b() 
    {
        return "b";
    }
}

class Test 
{
    use B;
}
$objet = new Test;
echo '<pre>';
print_r(get_class_methods($objet));
echo '</pre>';

// Si une classe déclare une méthode de même nom qu'une méthode récupérée dans un trait (si on surchage), alors la méthode de la classe cours l'emporte sur la méthode déclarée dans le trait et impossibilité de récupérer la méthode venant du trait (contrairement à l'héritage où on peut récupérer la méthode via parent::)

trait MonTrait
{
    public function DireBonjour()
    {
        echo "Hello !";
    }
}

class MaClasse
{
    use MonTrait;

    public function DireBonjour()
    {
        echo "Bonjour !<br>";
    }
}

$objet = new MaClasse;
$objet->DireBonjour(); // Affiche "Bonjour !"

#####################################################

// Il est possible de donner un alias à une méthode d'un trait 

trait F 
{
    public function saySomething()
    {
        echo "Hi<hr>";
    }
}

class MyClass
{
    use F 
    {
        saySomething as disQqchoz;
    }
}

$o = new MyClass;
$o->saySomething();
$o->disQqchoz();