<?php 

class A 
{
    public $maprop = 10;

    public function direBonjour()
    {
        return "Bonjour";
    }
}

//////////////////////////////////////////////////////////////////////////

class B // pas d'héritage ici
{
    public $mavariable;

    public function __construct()
    {
        $this->mavariable = new A; // Je créé un objet A que je place dans l'attribut $mavariable de mon objet B 
    }

    public function uneMethode()
    {
        return $this->mavariable->direBonjour();
        // Dans mon objet B ($this), je peux appeler des méthodes de mon objet A ($this->mavariable)
        // B -> A -> direBonjour()
        // Habituellement, nous ne mettons qu'une seule flèche mais là, mavariable contenant un objet, on poursuit avec une nouvelle flèche
        // C'est un objet, dans un objet, tout comme un array dans un array avec une succession de crochet(voir plus bas)
        // Un objet dans un objet, pas d'héritage ici ! Quand même j'ai accès à l'objet A depuis l'objet B
    }
}

$b = new B; 
echo '<pre>';
var_dump($b);
echo '</pre>';
echo '<pre>';
print_r($b);
echo '</pre>';
  // B      A    
    echo $b->mavariable->maprop;
    echo $b->mavariable->direBonjour();



// Revision Tableau Array 
$array = array('prenom' => array('bob', 'jack', 'pol'), 'nom' => 'leponge');
echo '<pre>';
print_r($array);
echo '</pre>';
echo $array['prenom'][2];



