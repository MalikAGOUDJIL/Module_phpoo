<?php 

class Ecole 
{
    public $nom = "Doranco";
    public $cp = 94;
    public function __clone()
    {
        // Un clone peut se faire en l'absence de cette méthode. Elle s'exécute en cas de clone demandé et s'applique sur l'objet cloné (et non pas celui qui sert au clonage)
        $this->cp = 'à définir';
    }

}

$ecole1 = new Ecole;
// $ecole1 c'est Doranco dans le 94
echo '<pre>';
var_dump($ecole1); // objet #1
echo '</pre>';

$ecole2 = new Ecole;
$ecole2->nom = "PierralFormation";
$ecole2->cp = 65;
// $ecole2 c'est PierralFormation dans le 65
echo '<pre>';
var_dump($ecole2);  // objet #2
echo '</pre>';

// $ecole3 tout comme $ecole1 c'est Doranco dans le 75
$ecole3 = $ecole1; // Ici je pense copier l'objet $ecole1 pour en faire un nouvel objet dans $ecole3 MAIS NON ! Cela rajoute simplement le marqueur $ecole3 comme nouveau représentant de l'objet #1 
// Lorsque je modifie $ecole1 ou $ecole3 cela modifie en fait réellement l'objet #1 donc une modification sur l'un ou sur l'autre, impactera forcement les deux (car ils representent le meme objet !)
$ecole3->cp = 75; // Ici, modifie le cp de l'objet #1 donc $ecole1 et $ecole3 en meme temps
echo '<pre>';
var_dump($ecole3);
echo '</pre>';

echo "L'ecole 1 c'est " . $ecole1->nom . " dans le " . $ecole1->cp . "<hr>";
echo "L'ecole 2 c'est " . $ecole2->nom . " dans le " . $ecole2->cp . "<hr>";
echo "L'ecole 3 c'est " . $ecole3->nom . " dans le " . $ecole3->cp . "<hr>";
echo 'ECOLE1<pre>';
var_dump($ecole1);
echo '</pre>';
echo 'ECOLE2<pre>';
var_dump($ecole2);
echo '</pre>';
echo 'ECOLE3<pre>';
var_dump($ecole3);
echo '</pre>';

$ecole4 = clone $ecole2; // clone créé un nouvel objet et récupère les informations de $ecole2 comme référence
echo 'ECOLE4<pre>';
var_dump($ecole4);
echo '</pre>';

/* 

    En conclusion, j'ai 3 objets et 4 variables qui les réprésentent

                MEMOIRE
        |-----------------------|
        |______Objet#1 Doranco94| <--------- représenté par $ecole1 et $ecole3
        |______Objet#2 Pierral65| <--------- représenté par $ecole2
        |____Objet#3 Pierralàdef| <--------- représenté par $ecole4
        |-----------------------|



*/