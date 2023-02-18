<?php

/* 

    1. Faire en sorte de ne pas avoir d'objet Vehicule (abstract sur class Vehicule)
    2. Obligation pour la Renault et la Peugeot de posséder EXACTEMENT la même méthode démarrer(), on veut qu'elles démarrent exactement de la même façon (final sur la méthode demarrer)
    3. Obligation pour la Renault de déclarer un carburant diesel, et obligation pour la Peugeot de déclarer un carburant essence (abstract sur la methode carburant)
    4. La Renault doit effectuer 30 tests de plus qu'un vehicule de base, la Peugeot quant à elle doit effectuer 70 tests de plus qu'un véhicule de base   surcharge de la methode nombreDeTestObligatoire en appelant parent::
    5. Faites des tests/des affichages



*/

abstract class Vehicule
{
    final public function demarrer()
    {
        return "Je démarre comme ça";
    }

    abstract public function carburant();

    public function nombreDeTestObligatoire()
    {
        return 500;
    }
}

class Peugeot extends Vehicule
{
    public function carburant()
    {
        return "essence";
    }

    public function nombreDeTestObligatoire()
    {
        return parent::nombreDeTestObligatoire() + 70;
    }
}

class Renault extends Vehicule
{
    public function carburant()
    {
        return "diesel";
    }

    public function nombreDeTestObligatoire()
    {
        return parent::nombreDeTestObligatoire() + 30;
    }
}

// $vehicule = new Vehicule; // Ok pour la question 1 

$renault = new Renault;
$peugeot = new Peugeot;

echo $renault->demarrer();
echo "<hr>";
echo $peugeot->demarrer();// Ok pour la question 2 
echo "<hr>";


echo "carburant de la renault : " . $renault->carburant() . "<hr>";
echo "carburant de la peugeot : " . $peugeot->carburant() . "<hr>"; 
// Ok pour la question 3 

echo "Nombre de tests pour la renault : " . $renault->nombreDeTestObligatoire() . "<hr>";
echo "Nombre de tests pour la peugeot : " . $peugeot->nombreDeTestObligatoire() . "<hr>"; 
// Ok pour la question 4