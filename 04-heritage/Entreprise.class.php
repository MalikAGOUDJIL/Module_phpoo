<?php 

class Plombier 
{
    public function getSpecialite()
    {
        return "Plombier : Tuyaux, robinets etc";
    }

    public function getHoraires()
    {
        return "8h/19h";
    }
}
######################################################
class Electricien
{
    public function getSpecialite()
    {
        return "Electricien : Panneaux electriques, cablages etc";
    }

    public function getHoraires()
    {
        return "10h/21h";
    }
}

class Entreprise  // La classe entreprise n'hérite pas d'une autre classe
{
    public $nbrEmploye = 0;       // Plombier
    public function appelUnEmploye($employe)
    {
        $this->nbrEmploye++;     // Plombier
        // $newEmploye = "monEmploye" . $this->nbrEmploye;

               // monEmploye1
               // monEmploye2  
               // etc
               // etc
        $this->{"monEmploye" . $this->nbrEmploye} = new $employe;
        // Ici à chaque appel de la methode appelUnEmploye, le nbrEmploye prends +1 et on créé une nouvelle propriété qui va contenir à chaque fois un nouvel objet de type Plombier ou Electricien.
        // Les accolades me permettent de stopper l'execution de php pour prioriser cette portion de code là et ainsi de pouvoir faire la concaténation de "monEmploye1" "monEmploye2" etc 
      
    }
}
#############################################
$entreprise = new Entreprise;
echo '<pre>'; 
print_r($entreprise); 
echo '</pre>';
$entreprise->appelUnEmploye('Plombier');
echo '<pre>'; 
print_r($entreprise); 
echo '</pre>';
$entreprise->appelUnEmploye('Electricien');
echo '<pre>'; 
print_r($entreprise); 
echo '</pre>';
$entreprise->appelUnEmploye('Electricien');
echo '<pre>'; 
print_r($entreprise); 
echo '</pre>';

echo $entreprise->monEmploye1->getSpecialite();

