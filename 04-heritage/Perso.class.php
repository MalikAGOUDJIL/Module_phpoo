<?php 

class Perso 
{
    protected function deplacement()
    {
        return "Je me déplace vite";
    }

    public function sauter()
    {
        return "Je saute haut";
    }
}

#################################################

// extends est un mot clé qui permet d'hériter d'une classe
// La classe Mario hérite de tous les éléments de la classe Perso pour peu qu'ils soient public ou protected
// Toutes les méthodes de la classe Perso sont accessibles directement dans la classe Mario

class Mario extends Perso // Il est n'est pas possible d'hériter de plusieurs classes à la fois
{
    public function quiSuisJe()
    {
        // Appel des méthodes issues de la classe Perso (on a hérité de deplacement() et sauter() car public et protected)
        return "Je m'appelle Mario et " . $this->deplacement() . " et " . $this->sauter() . "<hr>";
    }
}

###############################################

class DonkeyKong extends Perso 
{
    public function quiSuisJe()
    {
        return "Je suis Donkey Kong et " . $this->deplacement() . " et " . $this->sauter() . "<hr>";
        // parent::sauter()  me permet d'atteindre la méthode de la classe mère si jamais une méthode du même nom existe dans la classe en cours
    }

    // redéfinition de la méthode héritée, par défaut, php appelle la méthode de la classe en cours, et si seulement il ne la trouve pas, il appelera la méthode de la classe mère
    public function sauter()
    {
        return "Je ne saute pas vraiment haut";
    }
}

$mario = new Mario;
$kong = new DonkeyKong;
echo '<pre>';
print_r(get_class_methods($mario));
echo '</pre>';

// echo $mario->sauter();
// echo $mario->deplacement(); // Je ne peux pas appeler depuis l'exterieur la methode protected

echo $mario->quiSuisJe();
echo $kong->quiSuisJe();

/* 

    l'héritage représente la récupération de tous les éléments public et protected d'une classe par une autre via le mot clé extends

    Les propriétés ainsi que les méthodes tant qu'elles respectent ces niveaux de visibilité, seront récupérées

    Attention à respecter un contexte cohérent dans l'héritage ! 

    C'est à dire : Il faut pouvoir dire que A est un B 
    Par exemple :
        Mario est un Personnage
        Bateau est un Vehicule
        Chien est un Animal 

    Si je redéfinie une méthode que j'ai héritée, la méthode présente dans la classe prendra la priorité sur la méthode récupérée par héritage.
    Je peux cependant récupérer le traitement de la méthode héritée en utilisant l'appel parent::


*/