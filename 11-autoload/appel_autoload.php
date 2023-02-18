<?php 

// le but de l'autoload est d'éviter de faire à la main des require comme ceci :
// require('A.class.php');
// require('B.class.php');
// require('C.class.php');
// require('D.class.php');
// require('X.class.php');
// Il va s'en occuper à notre place

require_once('autoload.php');

// $a = new A;
// $b = new B;
// $c = new C;
// $d = new D;
// $x = new X;
$panier = new Commerce\Panier;

print_r($panier);


// print_r($a);
// print_r($b);
// print_r($c);