<?php

// echo "<pre>";
// print_r(get_declared_classes());
// echo "</pre>";


//----------------------------------------------
//----------------------------------------------
//----------------------------------------------
//----- PDO : PHP DATA OBJET -------------------
//----------------------------------------------
//----------------------------------------------
//----------------------------------------------
// https://www.php.net/manual/en/class.pdo
// https://www.php.net/manual/en/class.pdostatement.php

/* 
PDO est une classe prédéfinie de PHP qui nous permet de gérer la connexion à une base de données.
Cette classe possède tout un tas de méthodes, nous allons utiliser les suivantes :

    query() :
    ----------
    - Nous permet de lancer immédiatement, une requête de n'importe quel type
        Echec :
        --------
            - Erreur de syntaxe dans la requête
        Succès :
        -------
            - On obtient un nouvel objet issu de la classe PDOStatement (représente la réponse à une requête) cet objet possède des méthodes et propriétés différentes de PDO 

    prepare() : A PRIVILEGIER POUR LA SECURITE
    -----------
    - Nous permet de lancer tout type de requête MAIS ne lance pas la requête tout de suite.
    - Dans un premier temps, on "prepare" la requête, pour pouvoir l'exécuter par la suite
    - Dès le lancement de la méthode on obtient un PDOStatemet sur lequel nous devrons appliquer les notions de sécurité, après ça, on exécute la requête
        Echec :
        --------
            - Erreur de syntaxe dans la requête
        Succès :
        -------
            - On obtient un nouvel objet issu de la classe PDOStatement (représente la réponse à une requête) cet objet possède des méthodes et propriétés différentes de PDO 
*/

echo "<h2>01 - Connexion à la BDD</h2>";
// Pour créer une connexion à la BDD, nous avons besoin de plusieurs informations
// - Le serveur (local : localhost)
// - Login de connexion à la BDD (root)
// - MdP de connexion à la bdd (rien ou root sur mamp)
// - Le nom de la bdd
// - + eventuellement des options 

$host = 'mysql:host=localhost;dbname=entreprise'; // hôte + nom bdd
$login = 'root';  // login
$password = ''; // mdp (il faut mettre root si vous êtes sur mamp)
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // gestion des erreurs
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // On force l'utf8 pour les données provenants de la BDD
);

// Création de l'objet PDO
$pdo = new PDO($host, $login, $password, $options);

echo '<pre>';
print_r($pdo);
echo '</pre>';

echo "<h2>02 - Requete de type action (INSERT / UPDATE / DELETE)</h2>";

// Enregistrement d'un nouvel employé dans la BDD entreprise

// $reponse = $pdo->query("INSERT INTO employes (id_employes, prenom, nom, salaire, sexe, date_embauche, service) VALUES (NULL, 'Pierral', 'Lacaze', 12000, 'm', CURDATE(), 'Web')");

// $reponse est un PDOStatement, sur une requete de type action, il n'y a pas vraiment de réponse, en revanche il est possible de demander le nombre de lignes impactées par la derniere requete

// echo "Nombre de lignes impactées par la requete d'enregistrement : " . $reponse->rowCount() . "<hr>";

echo "<h2>03 - SELECT pour une seule ligne de résultat</h2>";

// on selectionne l'employé id_employes 990
$reponse = $pdo->query("SELECT * FROM employes WHERE id_employes = 990");
/*
    Réponse de la console :
+-------------+-----------+--------+------+-----------+---------------+---------+
| id_employes | prenom    | nom    | sexe | service   | date_embauche | salaire |
+-------------+-----------+--------+------+-----------+---------------+---------+
|         990 | Stephanie | Lafaye | f    | assistant | 2017-03-01    |    1775 |
+-------------+-----------+--------+------+-----------+---------------+---------+
*/

// echo $reponse; Je ne peux pas faire ça pour afficher le résultat, $reponse est un objet !

// echo '<pre>';
// print_r($reponse); // PDOStatement possède une seule propriété qui contient uniquement la requête qui a été demandée
// echo '</pre>';

// En l'état, la réponse de la BDD est bien contenue dans l'objet PDOStatement $reponse mais est inexploitable
// Pour la rendre exploitable via PHP, il faut transformer la ligne de résultat en utilisant la méthode fetch() 
// fetch() me permet de "filtrer" une ligne de résultat récupérée dans l'objet PDOStatement et de le transformer en un tableau array !

// FETCH_ASSOC : pour un tableau array associatif (le nom des colonnes comme indice du tableau array)
$donnees = $reponse->fetch(PDO::FETCH_ASSOC);
echo '<pre>';
print_r($donnees);
echo '</pre>';
// Array
// (
//     [id_employes] => 990
//     [prenom] => Stephanie
//     [nom] => Lafaye
//     [sexe] => f
//     [service] => assistant
//     [date_embauche] => 2017-03-01
//     [salaire] => 1775
// )

// FETCH_NUM : pour un tableau array indexé numériquement 
// $donnees = $reponse->fetch(PDO::FETCH_NUM);
// echo '<pre>';
// print_r($donnees);
// echo '</pre>';
// Array
// (
//     [0] => 990
//     [1] => Stephanie
//     [2] => Lafaye
//     [3] => f
//     [4] => assistant
//     [5] => 2017-03-01
//     [6] => 1775
// )

// FETCH_BOTH : Cas par défaut si non précisé : Mélange de FETCH_ASSOC et FETCH_NUM
// $donnees = $reponse->fetch();
// echo '<pre>';
// print_r($donnees);
// echo '</pre>';
// Array
// (
//     [id_employes] => 990
//     [0] => 990
//     [prenom] => Stephanie
//     [1] => Stephanie
//     [nom] => Lafaye
//     [2] => Lafaye
//     [sexe] => f
//     [3] => f
//     [service] => assistant
//     [4] => assistant
//     [date_embauche] => 2017-03-01
//     [5] => 2017-03-01
//     [salaire] => 1775
//     [6] => 1775
// )

// FETCH_OBJ : Pour obtenir un nouvel objet avec les colonnes comme propriétés publiques de l'objet
// $donnees = $reponse->fetch(PDO::FETCH_OBJ);
// echo '<pre>';
// print_r($donnees);
// echo '</pre>';
// stdClass Object
// (
//     [id_employes] => 990
//     [prenom] => Stephanie
//     [nom] => Lafaye
//     [sexe] => f
//     [service] => assistant
//     [date_embauche] => 2017-03-01
//     [salaire] => 1775
// )

echo $donnees['prenom'] . '<hr>'; // Avec FETCH_ASSOC
// echo $donnees[1] . '<hr>'; // Avec FETCH_NUM
// echo $donnees->prenom . '<hr>'; // Avec FETCH_OBJ

// Une ligne traitée avec fetch n'existe plus dans la réponse, après un fetch la ligne est "consommée"

echo "<h2>04 - SELECT pour plusieurs lignes de resultat</h2>";

$reponse = $pdo->query("SELECT * FROM employes");

// Pour connaitre le nombre de lignes récupérées par la requete : rowCount()
// Nous avons 21 employés
echo "Nombre d'employés : " . $reponse->rowCount() . "<hr>";

// fetch() ne traite qu'une seule ligne à la fois !
// Pour traiter plusieurs lignes ? Une boucle !
// La boucle while va tourner autant de fois qu'il y a de lignes dans la réponse
// A chaque appel de fetch, on fait une affectation dans notre variable recevant le tableau array
// Une affectation réussie = true
// Lorsque fetch ne trouve plus de résultat, alors, il retourne false = la boucle s'arrête

while ($ligne = $reponse->fetch(PDO::FETCH_ASSOC)) {
    echo "<pre>";
    print_r($ligne);
    echo '</pre><hr>';
}

// Il n'est pas possible de revenir sur une ligne déjà consommée par fetch
// Si on veut manipuler plusieurs fois le même résultat, il faudra relancer la requête

$reponse = $pdo->query("SELECT * FROM employes");
echo '<div style="display:flex; flex-wrap: wrap; justify-content: space-between">';
while ($ligne = $reponse->fetch(PDO::FETCH_ASSOC)) {
    echo '<div style="margin-top:20px; padding: 1%; width: 20%; background-color:steelblue; color:white">';
    echo "ID : " . $ligne['id_employes'] . '<br>';
    echo "Prénom : " . $ligne['prenom'] . '<br>';
    echo "Nom : " . $ligne['nom'] . '<br>';
    echo "Service : " . $ligne['service'] . '<br>';
    echo "Salaire : " . $ligne['salaire'] . '<br>';
    echo "Sexe : " . $ligne['sexe'] . '<br>';
    echo "Date embauche : " . $ligne['date_embauche'] . '<br>';
    echo '</div>';
}
echo '</div>';

echo "<h2>05 - SELECT pour plusieurs lignes de résultats affichées dans un tableau html qui s'adapte à n'importe quelle requete !</h2>";

$reponse = $pdo->query("SELECT * FROM employes");

// D'abord, script ne s'adaptant pas entièrement, nous allons écrire les entêtes de colonnes nous même 

echo '<style>th, td {padding:10px}</style>';
echo '<table border="1" style="border-collapse : collapse; width:100%;">';

echo '<tr>';
echo '<th>Id employés</th>';
echo '<th>Prénom</th>';
echo '<th>Nom</th>';
echo '<th>Sexe</th>';
echo '<th>Service</th>';
echo '<th>Date embauche</th>';
echo '<th>Salaire</th>';
echo '</tr>';

while ($ligne = $reponse->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr>';
    foreach ($ligne as $valeur) {
        echo "<td>$valeur</td>";
    }
    echo '</tr>';
}

echo '</table><hr><hr><hr>';

$reponse = $pdo->query("SELECT * FROM employes");
// Avec un script qui s'adaptera à n'importe quelle requête et qui va gérer tout seul les colonnes
// columnCount() est une méthode de PDOStatement qui nous renvoie le nombre de colonne dans la réponse
// getColumnMeta($numColonne) est une méthode qui nous renvoie les informations de la colonne notamment son nom (à l'indice name)
// echo $reponse->columnCount();
echo '<pre>';
print_r($reponse->getColumnMeta(2));
echo '</pre>';
echo '<table border="1" style="border-collapse : collapse; width:100%;">';
echo '<tr>';
for ($i = 0; $i < $reponse->columnCount(); $i++) {
    $infosColonne = $reponse->getColumnMeta($i);
    echo "<th>" . str_replace('_', ' ', ucfirst($infosColonne['name'])) . '</th>';
}
echo '</tr>';
while ($ligne = $reponse->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr>';
    foreach ($ligne as $valeur) {
        echo "<td>$valeur</td>";
    }
    echo '</tr>';
}
echo '</table><hr><hr><hr>';

echo "<h2>EXERCICE : Récupérez les prénoms et noms des employés de la BDD pour les afficher dans une liste ul li</h2>";

$req = "SELECT prenom, nom FROM employes";

$reponse = $pdo->query($req);

echo '<ul>';
while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC)) {
    echo "<li>" . $donnees['prenom'] . ' ' . $donnees['nom'] . '</li>';
}
echo '</ul>';

echo "<h2>06 - SELECT pour plusieurs lignes de résultat avec fetchAll()</h2>";

// fetch() permet de traiter une seule ligne à la fois
// fetchAll() traite toutes les lignes en une seule fois sauf que l'on obtient en résultat un tableau array multidimensionnel !
// chaque ligne de résultat sera contenu dans un sous tableau, à un index numérique

$reponse = $pdo->query("SELECT * FROM employes");

$listeEmployes = $reponse->fetchAll(PDO::FETCH_ASSOC);

echo '<pre>';
print_r($listeEmployes);
echo '</pre>';

// EXERCICE : En utilisant le tableau array multidimensionnel $listeEmployes, affichez les prénoms des employés dans une liste ul li

// Avec foreach

echo 'Avec foreach : <ul>';
foreach ($listeEmployes as $sousTableau) {
    echo "<li>"  . $sousTableau['prenom'] . '</li>';
}
echo '</ul>';

echo "Avec for : <ul>";
for ($i = 0; $i < count($listeEmployes); $i++) {
    echo "<li>" . $listeEmployes[$i]['prenom'] . '</li>';
}
echo '</ul>';

echo 'Avec while : <ul>';
$i = 0;
while ($i < count($listeEmployes)) {
    echo "<li>" . $listeEmployes[$i]['prenom'] . '</li>';
    $i++;
}
echo '</ul>';

echo "<h2>07 - prepare() + bindParam() + execute() pour sécuriser nos requêtes !</h2>";

// Si dans la requete une ou des informations proviennent de l'utilisateur, obligatoire de faire un prepare() !
// prepare() permet de sécuriser les requêtes pour éviter les injections SQL

$nom = 'laborde'; // information que l'on aurait récupérée depuis un formulaire. L'utilisateur recherche un employé selon son nom 

// On commence par préparer la requête 
$reponse = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom");
// Lors de la préparation de la requête on ne met pas la variable récupérée !
// On représente dans la requête une information attendue via un "marqueur nominatif", ce marqueur est représenté grâce aux ":"
// Un marqueur nominatif représente une variable dans la requete, que l'on assignera plus tard. On dit à notre requête "ici il manque une info, nous allons te la fournir avec un bindParam()
// bindParam() permet de donner la valeur attendue au marqueur nominatif
// une ligne de bindParam() par marqueur 

// On donne la valeur attendue :
$reponse->bindParam(':nom', $nom, PDO::PARAM_STR);
// PDO::PARAM_STR pour filtrer la saisi comme pur string (avec MySQL on peut tout envoyer en string donc toujours utiliser ce filtre là)

// Maintenant que l'information attendue est fournie à la requete, on peut exécuter
$reponse->execute();

$donnees = $reponse->fetch(PDO::FETCH_ASSOC);
echo "<pre>";
print_r($donnees);
echo '</pre>';
