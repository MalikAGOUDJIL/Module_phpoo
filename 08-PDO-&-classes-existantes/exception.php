<?php 

function recherche($tab, $elem)
{
    if(!is_array($tab))
        throw new Exception('Vous devez envoyer un ARRAY !');

    if(sizeof($tab) == 0)
        throw new Exception('Vous devez envoyer un ARRAY avec du contenu !');


    $position = array_search($elem, $tab); // Fonction cherchant le numéro d'un élément dans un tableau array
    return $position;
}

$tab1 = array();
$tab2 = 5;
$tabPerso = ['Mario', 'Kong', 'Toad', 'Yoshi'];
echo '<pre>';
print_r($tabPerso);
echo '</pre>';
// Array
// (
//     [0] => Mario
//     [1] => Kong
//     [2] => Toad
//     [3] => Yoshi
// )


try // C'est un bloc d'essai pour tenter d'executer du code 
// Si une erreur est rencontrée dans ce bloc là, et si l'erreur "lance" une Exception, elle sera attrapée (catch) dans le bloc catch
{
    echo "Kong se trouve à la position : " . recherche($tabPerso, 'Kong') . '<hr>';
    echo "Yoshi se trouve à la position : " . recherche($tabPerso, 'Yoshi') . '<hr>';
    echo recherche($tab2, 'yoshi'); // Erreur ! Lancement d'exception, on sort du bloc try pour passer dans le catch 
    // echo recherche($tab1, 'yoshi');
    echo "<hr>La suite du bloc try...<hr>"; // Ne s'affiche pas car on est sorti du bloc try au lancement de l'exception à la ligne ci dessus 
}
catch (Exception $e) // Exception est une classe prédéfinie de php, elle se fait catch/attraper si une exception est levée
// catch et try fonctionnent obligatoirement ensemble 
{
    // $e représente l'exception, donc un objet de type Exception qui possède ses propres propriétés et méthodes
    echo "Oups ! On est tombé dans le catch ! Il y a une erreur<hr>";
    // echo '<pre>';
    // print_r($e);
    // echo '</pre>';
    // echo '<pre>';
    // print_r(get_class_methods($e));
    // echo '</pre>';
    echo "Erreur : " . $e->getMessage() . " dans le fichier : " . $e->getFile() . " à la ligne " . $e->getLine() . '<hr>';
    echo "Info de la trace : " . $e->getTraceAsString();
}

echo "<hr>Coucou je suis la suite de la page";

/* 

    try catch me permettent de gérer des cas d'erreur.
    Plusieurs usages, premierement, je travaille sur une page et j'ai besoin de faire des tests et que mes erreurs ne declenchent pas forcement des fatal error et un blocage de la page.
    Deuxiemement, j'ai besoin parfois de gérer des cas d'erreur sur des process qui normalement devraient toujours bien fonctionner (exemple, la connexion à la BDD avec la creation de l'objet PDO), il n'y a pas de raison que l'objet $pdo ne fonctionne plus... Mais ! On ne sait jamais, si cela advenait à arriver, il faut avoir penser à ce qu'il devrait se passer dans ce cas là. On gérerait donc ce cas d'erreur "exceptionnel" par une exception.

*/

// Le meme genre de classe existe spécifiquement pour PDO, PDOException 

try  // On tente d'executer la connexion à la BDD avec un bloc d'essai try
{
    $pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root', '');

    echo "<hr>Connexion réussie<hr>";
}

catch (PDOException $e)
// Si la connexion n'a pas pu etre établie dans le bloc try, nous tombons automatiquement dans le bloc catch et on attrape l'exception PDO
// PDOException possède exactement les mêmes methodes que Exception tout court
{
    echo "<hr>Connexion ratée<hr>";
    echo "Erreur : " . $e->getMessage() . " dans le fichier : " . $e->getFile() . " à la ligne " . $e->getLine() . '<hr>';
        echo "Info de la trace : " . $e->getTraceAsString();
}