<?php 
// die c'est la meme chose que exit
function recherche($tab, $elem)
{
    if(!is_array($tab))
        die('Vous devez envoyer un ARRAY !'); // die arrête les traitements et écrit simplement le message d'erreur

    $position = array_search($elem, $tab); // Fonction cherchant le numéro d'un élément dans un tableau array
    return $position;
}

//----------------------------------------

$liste = array('orange', 'cerise', 'melon');

    echo recherche($liste, 'cerise') . '<hr>';
    echo recherche($liste, 'melon') . '<hr>';
    echo recherche('azert', 'orange') . '<hr>';
    echo "suite du code<hr>";
    echo "suite du code<hr>";
    echo "suite du code<hr>";   // on ne voit pas ces lignes car le code a die un peu plus tôt
    echo "suite du code<hr>";
    echo "suite du code<hr>";
    echo "suite du code<hr>";


    /* 

        On utilise généralement die/exit pour ne pas afficher le contenu de notre page à un utilisateur qui aurait peut être tenté d'y acceder frauduleusement

        Par exemple, un utilisateur qui n'est pas admin qui tenterait d'acceder à une page backoffice en tapant l'adresse directement dans l'url.
        Cela évite à l'utilisateur de pouvoir récupérer le contenu de notre page admin.

    */