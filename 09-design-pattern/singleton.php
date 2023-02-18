<?php 


// Les design pattern :

// Un design pattern/patron de conception, est un arrangement de modules reconnus comme bonne pratique en réponse à une problématique de conception.
// Il s'agit d'un concept destiné à resoudre des problèmes récurrents.

    // 3 familles de pattern :

        // Construction : Pour définir comment faire l'instanciation et la configuration des classes et objets 

        // Structuraux : Ils définissent comment oragniser les classes d'un programme dans une structure plus large

        // Comportementaux : Pour définir comment organiser les objets pour que ceux-ci collaborent entre eux

    // Pattern du Singleton :

    // Le Singleton, en programmation OO, répond à la problématique de n'avoir qu'une seule et unique instance d'une même classe dans un programme

    class Singleton 
    {
        private static $instance = null;

        private function __construct() {}

        public static function creation() 
        {
            if (is_null(self::$instance))
            {
                self::$instance = new Singleton();
            }
            return self::$instance;
        }
    }

    // $a = new Singleton; // le construct private m'empêche de faire une instanciation

    $a = Singleton::creation(); // Ici premier appel de la méthode creation, le premier et unique objet de la classe Singleton est créé et stocké dans la propriété statique $instance de notre classe. La methode de creation nous fait un return de cette propriété donc $a est le premier pointeur de mon objet singleton #1 
    var_dump($a);
    $b = Singleton::creation(); // Ici deuxième appel de la méthode création, l'objet ayant déjà été instancié, on ne rentre pas dans le if ! La méthode me fait simplement un return de l'objet déjà créé, ainsi $b est un deuxième pointeur vers le même objet singleton#1 
    var_dump($b);
    $c = Singleton::creation(); // Ici troisième appel de la méthode création, l'objet ayant déjà été instancié, on ne rentre pas dans le if ! La méthode me fait simplement un return de l'objet déjà créé, ainsi $c est un deuxième pointeur vers le même objet singleton#1 
    

    // La classe n'est pas instanciable de l'extérieur, puisque le constructeur est déclaré volontairement comme étant private
    // On execute la méthode static creation() de la classe Singleton (static, comme cela nous n'avons pas besoin d'avoir une instance de cette classe pour pouvoir l'appeler), la première fois l'instance possède la valeur "null", donc nous créons un objet Singleton à l'intérieur de la classe qui est retourné ensuite.
    // $a représente un objet issu de la classe Singleton #1 en mémoire
    // La seconde fois, l'instance n'est pas null, nous ne rentrons pas dans le if et l'objet est retourné immédiatement
    // $a $b $c représente un objet issue de la classe Singleton avec la même référence #1 en mémoire

    // De cette manière, impossible de créer plusieurs objets de type Singleton

    // Nous avons donc, grâce au pattern Singleton, réussi à créer une instance unique de cette classe et en préserver l'unicité

    // Un singleton est composé de 3 caractéristiques :
        // - Un attribut private et static qui conservera l'instance unique de la classe
        // - Un constructeur privé afin d'empêcher la création d'objet depuis l'extérieur de la classe
        // - Une méthode static qui permet soit d'instancier la classe soit de retourner l'unique instance créée