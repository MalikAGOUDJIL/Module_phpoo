<?php 

final class Application
{
    public function lancementApplication()
    {
        return "L'appli se lance de cette façon !<hr>";
    }
}

// class Extension extends Application { } // ATTENTION ! Il n'est pas possible d'hériter d'une classe finale !
// Une classe finale a pour but d'être FINALE, pour qu'elle ne soit plus modifiable par la suite dans ses héritages, elle a été prévue pour être utilisée telle quelle.

// Il est tout de même possible d'instancier une classe finale 
$app = new Application;
echo $app->lancementApplication();

class Application2 
{
    final public function lancementApplication2()
    {
        return "L'appli se lance AUSSI de cette façon là ! <hr>";
    }
}

$app2 = new Application2;
echo $app2->lancementApplication2();

class Extension2 extends Application2 
{
    // On hérite sans problemes de la méthode finale lancementApplication2()
    // public function lancementApplication2() {}
    // Par contre, impossible de surcharger une méthode finale
}

$ext2 = new Extension2;
echo '<pre>';
print_r(get_class_methods($ext2));
echo '</pre>';
echo $ext2->lancementApplication2();

/* 

    - Une classe finale ne peut pas être héritée
    - Une classe finale aura forcément des méthodes qui ne pourront pas être surchargées ou redéfinies (pas d'intérêt de rajouter le mot final aux méthodes d'une classe déjà finale)
    - Une classe finale reste instanciable
    - Une méthode finale peut être présente dans une classe normale, l'intérêt étant de vérouiller la méthode afin d'empêcher toute sous classe de la surcharger et modifier son comportement (quand nous voulons être sûr que le comportement d'une méthode soit préservé durant l'héritage)

    Encore une fois, ce sont des contraintes saines, afin de s'assurer que les équipes de développement travaillent toutes dans le même contexte et dans la même direction.


*/