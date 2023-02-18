<?php 

// Surchage ou Override : Une redéfinition d'une méthode dont on a hérité, la surcharge permet d'écraser le comportement de la méthode d'origine et/ou éventuellement y appliquer un traitement complémentaire/différent

class A 
{
    public function calcul()
    {
        return 1456;
    }
}

class B extends A 
{
    public function calcul() // Je redéfini/surcharge ma méthode, j'ai besoin de lui apporter un traitement complémentaire
    {
        $nb = parent::calcul(); // Ici on récupère 10 de la méthode calcul() de la classe mère et on stocke le résultat dans $nb 
        // On utilise pas $this->calcul() car cela rappelerait la même méthode (celle de la classe B) et donc on aurait une boucle infini !
        if ($nb <= 100) return "le chiffre récupéré : $nb, est inférieur ou égal à 100<hr>";
        else return "le chiffre récupéré : $nb, est supérieur à 100<hr>";
    }

    public function autreCalcul()
    {
        $nb = parent::calcul(); // Il est possible d'atteindre une méthode de mon parent dans une autre méthode ne portant pas forcement le meme nom et donc sans surcharge
    }
}

$b = new B;

echo $b->calcul();

/* 
    Une surcharge permet de prendre en compte le comportement de la méthode héritée afin d'en bénéficier tout en apportant un traitement complémentaire.
    On peut également totalement écraser son comportement si on le souhaite.
*/