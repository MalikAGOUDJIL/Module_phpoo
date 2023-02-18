<?php 

// class A {}

// class A {}

// function a() {}

// function a() {}
// ERREUR on ne peut pas avoir de classe ou function/methode du même...
// Mais c'est possible si je créer des namespace ! 



######################################################
namespace Commerce1;

class Commande 
{
    public $nbCommande = 3;
}
######################################################
namespace Commerce2;
// echo __NAMESPACE__;
class Produit 
{
    public $nbProduit = 22;
}
######################################################
namespace Commerce3;
class Panier 
{
    public $nbProduitPanier = 2;
}

class Commande 
{
    public $nbCommande = 58;
}

class Produit 
{
    public $nbProduit = 78;
}

$commande = new Commande;
// print_r($commande);