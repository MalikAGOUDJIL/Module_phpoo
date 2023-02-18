<?php

/* 
    EXERCICE :
        En tenant compte des éléments appris dans ce chapitre, essayez de renseigner puis d'afficher les attributs/propriétés de cette classe :

        class Membre {
            private $prenom;
            private $age;
        }

        // On souhaite également ajouter des contraintes de saisies sur le prenom avec maximum 30 caractères et un âge forcément numérique

        // Gérer les cas d'erreur avec trigger_error();

        Une fois la classe écrite, instanciez un ou des objets pour faire des tests.

        // Une fois réussi, faites un constructeur
*/


class Membre
{
    private $prenom;
    private $age;

    public function __construct(string $newPrenom, int $newAge)
    {
        echo "Le constructeur est en train de se lancer... on récupère les valeurs : $newPrenom et $newAge merci terminé !<hr>";
        $this->setPrenom($newPrenom);
        $this->setAge($newAge);
    }

    public function setPrenom($newPrenom)
    {
        if (is_string($newPrenom)) {
            if (iconv_strlen($newPrenom) < 30) {
                $this->prenom = $newPrenom;
            } else {
                trigger_error("Attention prénom trop long", E_USER_ERROR);
            }
        } else {
            trigger_error("Attention vous devez fournir un string", E_USER_ERROR);
        }
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setAge($newAge)
    { 
        if (is_numeric($newAge))  $this->age = $newAge;
        else trigger_error("Saisi incorrecte", E_USER_ERROR);
        
    }

    public function getAge()
    {
        return $this->age;
    }
}

// $membre1 = new Membre;

// $membre1->setPrenom('Pol');
// $membre1->setAge(12);
// echo "<pre>";
// print_r($membre1);
// echo "</pre>";
// echo "Le membre " . $membre1->getPrenom() . " a " . $membre1->getAge() . "ans<hr>";

$membre2 = new Membre("Remi", 13);
echo "<pre>";
print_r($membre2);
echo "</pre>";

echo "Le membre " . $membre2->getPrenom() . " a " . $membre2->getAge() . "ans<hr>";

