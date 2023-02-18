<?php 

// require('A.class.php');
                                // A 
function inclusionAutomatique($nomDeLaClasse)
{
    echo "<hr>On passe dans la fonction inclusion automatique<hr>";

    require(str_replace('\\', '/', $nomDeLaClasse) . '.class.php');

    echo "require(" . str_replace('\\', '/', $nomDeLaClasse) . ".class.php)<hr>";
   
}

spl_autoload_register('inclusionAutomatique');

// $a = new A;
// $b = new B;
// $c = new C;
// $d = new D;
// $x = new X;

/* 
    spl_autoload_register() : Est une fonction prédéfinie qui permet d'executer une fonction choisie entre les parenthèsees, lorsque l'interpreteur comprends la creation d'un nouvel obet (en gros dès qu'il voit un mot "new")
    Le  nom à côté du 'new' (namespace\classe) est récupéré et automatiquement transmit en argument de la fonction inclusionAutomatique
    Il est indispensable de respecter une convention de nommage sur nos fichiers pour que l'autoload fonctionne correctement

    l'autoload permet d'automatiser l'inclusions des fichiers contenant les classes, nous n'avons plus besoin de faire des tas et des tas de require pour importer nos classes, c'est l'autoload qui se charge de le faire à notre place.

*/