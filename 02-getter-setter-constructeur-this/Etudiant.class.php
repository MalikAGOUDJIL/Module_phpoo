<?php

class Etudiant
{
    private $prenom;

                                // Bob
    public function __construct($newPrenom) // Méthode magique, attention à bien mettre deux underscore __  ,  le construct nous permet d'automatiser un traitement dès l'instanciation de la classe
    // Le constructeur se lance dès l'instanciation de l'objet
    {
        echo "Instanciation... Nous avons bien reçu l'information suivante : $newPrenom<hr>";
                            // Bob
        $this->setPrenom($newPrenom);
    }

                                // Jack 
    public function setPrenom($newPrenom)
    { // setter l'information = la controler puis la renseigner
        // est ce que Jack c'est un string ? Si oui je rentre dans l'accolade
        if (is_string($newPrenom)) {
            $this->prenom = $newPrenom; // Cette ligne indique dans l'objet en cours d'utilisation, pour l'exemple ci-dessous : $etudiant1->prenom = $newPrenom;

            // $prenom = $newPrenom; // Je ne peux pas faire ça, car le systeme comprends $prenom comme étant une variable dans l'espace local de la méthode setPrenom, donc undefined ici...
        } else {
            // Fonction prédéfinie qui génère des erreurs utilisateurs
            trigger_error("Ce n'est pas une chaine de caractères", E_USER_ERROR);
        }
    }

    public function getPrenom(){ // getter permet d'exploiter une donnnée private
        return $this->prenom; // return $prenom; ne fonctionnerait pas car on ne connait pas $prenom dans l'espace local de getPrenom
    }
}

// $etudiant1 = new Etudiant;
// echo '<pre>';
// print_r($etudiant1);
// echo '</pre>';
// // $etudiant1->prenom = 'Jack'; // Je ne peux pas exécuter cette opération car la propriété est private 
// $etudiant1->setPrenom('Jack');
// echo '<pre>';
// print_r($etudiant1);
// echo '</pre>';

// echo "Le prénom de l'étudiant1 est : " . $etudiant1->getPrenom() . "<hr>";

/*
    Les getters / setters permettent de controler l'intégrité des données
    Si nous devons controler les données saisies dans un formulaire, chaque donnée devra être transmise à une fonction setter qui permettra de la controler 

    setter = controle et affectation des données
    getter = permet de voir/récupérer/exploiter les données finales précédemment contrôlées

    Si nous avons 10 champs dans un formulaire, nous aurons 10 setters et 10 getters
    Cela nous permet d'avoir des données cohérentes dans les propriétés déclarées

    $this représente l'objet en cours d'utilisation à l'intérieur de la classe / représente les objets futurement créés 

    Mettre les propriétés en private permet d'éviter qu'elles ne soient modifiées dans le code, nous sommes obligés de passer par les setters = c'est une contrainte saine

*/

$etudiant2 = new Etudiant("Bob");
echo '<pre>';
print_r($etudiant2);
echo '</pre>';

/* 

    __construct() est une méthode magique en PHP 
    Elle s'exécute automatiquement lors d'une instanciation de classe (lorsque l'on fait un new)
    Si la méthode magique __construct() attend un argument, nous devons obligatoirement lui envoyer à l'instanciation, sinon, cela provoquera une erreur 
    Le construct permet d'automatiser un traitement
    On déclare toujours le constructeur comme première méthode de notre classe
    Il ne peut y avoir qu'un seul constructeur par classe

    Les méthodes magiques sont toujours appelées avec 2 '__' suivi du nom de la méthode magique


*/
