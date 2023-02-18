<?php 

// Créer des variables dynamiques à chaque tour de boucle grâce aux accolades {}

for($i = 1; $i <= 10 ; $i++)
{
    ${"tour" . $i} = "C'est le tour numéro : " . $i;
    // A chaque tour de boucle on créé une variable nommée dynamiquement en fonction du numéro du tour ! 
    // d'abord $tour1 puis $tour2 puis $tour3 etc jusqu'à $tour10
    // Qui contiennent chacunes une valeur elle aussi dynamique, le string :
    // C'est le tour numéro : 1
    // C'est le tour numéro : 2
    // C'est le tour numéro : 3  etc etc etc
}

echo $tour1 . "<hr>";
echo $tour4 . "<hr>";
echo $tour7 . "<hr>";
echo $tour10 . "<hr>";

