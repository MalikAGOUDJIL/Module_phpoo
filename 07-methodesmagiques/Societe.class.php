<?php 

class Societe
{
    public $adresse;
    public $ville;
    public $cp;

    public function __construct(){} // Celle ci, déjà vu ! Son comportement est qu'elle se lance directement à l'instanciation de l'objet
    public function __set($nom, $valeur){ // Se déclenche uniquement en cas de tentative d'affectation sur une propriété qui n'existe pas / Empeche la creation de nouvelle propriété dans notre objet 
        echo "La propriété '$nom' n'existe PAS, la valeur '$valeur' n'a donc pas été affectée !<hr>";
    }
    public function __get($nom){ // Se déclenche en cas de tentative d'affichage/d'appel sur une propriété qui n'existe pas 
        echo "La propriété '$nom' n'existe PAS, pas d'affichage possible ! <hr>";
    }

    public function __call($nom, $argument) { // Se déclenche en cas de tentative d'execution sur une méthode qui n'existe pas 
        echo "Tentative d'executer la méthode '$nom' mais elle n'existe PAS.<br> Les arguments étaient " . implode(" - ", $argument) . "<hr>";

    }

}

$soc = new Societe; 

echo "<pre>";
print_r($soc);
echo "</pre>";

$soc->marque = "Uniqlo"; // Si nous n'utilisons pas la methode magique __set cela va créer une nouvelle propriété dans l'objet. Pourtant, on veut potentiellement bloquer cette possibilité. 
echo "<pre>";
print_r($soc);
echo "</pre>";

echo $soc->marque; // Affichage d'une erreur car marque n'est plus définie du fait d'avoir créer la méthode magique __set
                    // En définissant __get j'évite l'erreur php et j'affiche plutôt un message d'erreur "propre"

$soc->ajoutEmploye(123, 'jack', 'sparrow', 2000); // Affichage d'une erreur car la methode n'existe pas !   en definissant __call  on évite cette erreur ! 

    /* 
        Il existe de nombreuses autres méthodes magiques en PHP OO :
        __callStatic($nom, $argument) : Lorsque l'on tente d'appeler une méthode statique qui n'existe pas
        __isset($nom) : Lorsque l'on fait un isset sur une propriété qui n'existe pas
        __destruct() : Se lance à la fin de l'exécution d'un script, lorsque l'objet est détruit de la mémoire. On peut lancer des derniers traitements (par exemple, une sauvegarde en bdd ?)
        __toString() : Se lance lorsqu'un objet est tenté d'être affiché par un "echo"


    */

