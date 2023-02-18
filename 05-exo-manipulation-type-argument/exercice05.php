<?php 


/* 

        ----------------------------
        |     Vehicule             |
        ----------------------------
        | $litresEssenceVhc        |
        ----------------------------
        | setLitresEssenceVhc()    |
        | getLitresEssenceVhc()    |
        ----------------------------

        ----------------------------
        |     Pompe                |
        ----------------------------
        | $litresEssencePmp        |
        ----------------------------
        | setLitresEssencePmp()    |
        | getLitresEssencePmp()    |
        | donnerEssence()          |
        ----------------------------


        1 - Développement de ces deux classes et de leurs méthodes
        2 - Pour faire vos tests, créez une voiture avec 5 litres d'essence
        3 - Ensuite créez une pompe avec 80 litres d'essence
        4 - On considère que le plein d'essence d'une voiture est à une valeur fixe de 50 litres ! 
        5 - Quand une voiture vient faire de l'essence, si c'est possible on lui mets forcement le plein (la voiture ne peut pas choisir combien d'essence on lui donne)
        6 - Faites des tests pour tester les cas particuliers

*/

    class Vehicule 
    {
        private $litresEssenceVhc;

        public function setLitresEssenceVhc($newLitres)
        {
            if (is_int($newLitres)){
                $this->litresEssenceVhc = $newLitres;
            }
        }

        public function getLitresEssenceVhc()
        {
            return $this->litresEssenceVhc;
        }
    }
#############################################################

    class Pompe 
    {
        private $litresEssencePmp;

        public function setLitresEssencePmp($newLitres)
        {
            if (is_int($newLitres)){
                $this->litresEssencePmp = $newLitres;
            }
        }

        public function getLitresEssencePmp()
        {
            return $this->litresEssencePmp;
        }

        public function donnerEssence(Vehicule $v)
        {
            // var_dump($v);
            $litresVhc = $v->getLitresEssenceVhc(); // Ce qu'il reste dans le vehicule
            $litresPmp = $this->getLitresEssencePmp(); // Ce qu'il reste dans la pompe

            // 3 cas d'utilisation
            // 1er cas : La pompe a assez d'essence pour faire le plein
            // 2eme cas : La pompe a de l'essence, mais pas assez pour faire le plein... (on va quand même donner tout ce qu'on peut !)
            // 3eme cas : La pompe est vide, on ne peut rien donner

            if ($litresPmp == 0) {   // Cas où la pompe est vide 
                echo "Désolé la pompe est vide<hr>";

                //     $litresPmp >=  (50 - $litresVhc)
            } elseif ( $litresPmp + $litresVhc >= 50) {   // Cas où la pompe a forcément assez pour faire le plein 
                $this->setLitresEssencePmp($litresPmp - (50 - $litresVhc));
                $v->setLitresEssenceVhc(50);
            } else {  // Cas où la pompe ne peut pas faire le plein mais peut quand meme donner un peu
                $v->setLitresEssenceVhc($litresVhc + $litresPmp);
                $this->setLitresEssencePmp(0);
            }

        }
    }

###########################################################

$voiture1 = new Vehicule(5);
$voiture1->setLitresEssenceVhc(5);
$voiture2 = new Vehicule;
$voiture2->setLitresEssenceVhc(5);
$voiture3 = new Vehicule;
$voiture3->setLitresEssenceVhc(5);
echo '<pre>';
print_r($voiture1);
echo '</pre>';

$pompe1 = new Pompe;
$pompe1->setLitresEssencePmp(80);
echo '<pre>';
print_r($pompe1);
echo '</pre>';

$pompe1->donnerEssence($voiture1);
echo 'ON DONNE ESSENCE A VOITURE1<pre>';
print_r($voiture1);
echo '</pre>';
echo '<pre>';
print_r($pompe1);
echo '</pre>';

$pompe1->donnerEssence($voiture2);
echo 'ON DONNE ESSENCE A VOITURE2<pre>';
print_r($voiture2);
echo '</pre>';
echo '<pre>';
print_r($pompe1);
echo '</pre>';

$pompe1->donnerEssence($voiture3);
echo 'ON DONNE ESSENCE A VOITURE3<pre>';
print_r($voiture3);
echo '</pre>';
echo '<pre>';
print_r($pompe1);
echo '</pre>';