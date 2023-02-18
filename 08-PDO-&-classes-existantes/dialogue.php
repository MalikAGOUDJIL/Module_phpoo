<?php
/* 

    // Pour éviter les injections XSS (du code css et/ou js mis dans les commentaires)
    // Il est possible de modifier les caractères notamment les < > qui représentent des balises, pour ce faire nous allons les transformer en entités html &lt;  &gt;  
    // à l'affichage (voir en bas de page) on appelle htmlspecialchars() qui permet de transformer ces caractères problématiques en entités html

    // Outils proche de htmlspecialchars() : htmlentities() / strip_tags()

    // Pour faire une injection SQL depuis le champ message il faut y saisir :   ', ''); TRUNCATE commentaire; 
    //  <style>body{display:none;}</style>
    // <script>while(true){alert("installez notre antivirus");}</script>





    EXERCICES:
    -------------

    - Création d'un espace de dialogue / de tchat en ligne

    - 01 - Création de la BDD : dialogue 
         - Table : commentaire 
         - Champs de la table commentaire :
            - id_commentaire           INT(3) PK AI 
            - pseudo                   VARCHAR(255)
            - message                  TEXT
            - date_enregistrement      DATETIME

    - 02 - Créer une connexion à cette base avec PDO (instanciation d'un objet PDO)
    - 03 - Création d'un formulaire permettant de poster un message  (voir chapitre post php)
        - Champs du formulaire :
                - pseudo (input text)
                - message (textarea)
                - bouton de validation
    - 04 - Récupération des saisies du form avec controle (chapitre post)
    - 05 - Déclenche une requete d'enregistrement pour enregistrer la saisie dans la BDD
    - 06 - Requete de récupération des messages afin de les afficher dans cette page 
    - 07 - Affichage des commentaires avec un peu de mise en forme
    - 08 - Affichage en haut des messages du nombre de messages présents dans la BDD
    - 09 - Affichage de la date en français
    - 10 - Amélioration du design
*/


// - 02 - Créer une connexion à cette base avec PDO 
$host = 'mysql:host=localhost;dbname=dialogue';
$login = 'root';
$password = '';
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // gestion des erreurs
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // On force l'utf8 pour les données provenants de la BDD
);
try
{
    $pdo = new PDO($host, $login, $password, $options);
    // echo '<pre>';
    // print_r($pdo);
    // echo '</pre>';
}
catch (PDOException $e)
{
    echo "Oups problème de bdd";
    die;
}

$content = '';
$req = '';

// - 04 - Récupération des saisies du form avec controle 
if (isset($_POST['pseudo']) && isset($_POST['message'])) {
    // print_r($_POST);
    $pseudo = trim($_POST['pseudo']);
    $message = trim($_POST['message']);

    $erreur = false;

    // Controle sur le fait que les champs ne soient pas vide 
    // Que pour les champs obligatoires
    if (empty($pseudo) || empty($message)) {
        // Cas d'erreur
        $erreur = true;
        $content .= '<div style="background-color: red; color: white; padding: 20px;">Attention tous les champs sont obligatoires !</div><br>';
    }

    // Controle sur la taille du pseudo
    if (iconv_strlen($pseudo) < 3 || iconv_strlen($pseudo) > 20) {
        // Cas d'erreur
        $erreur = true;
        $content .= '<div style="background-color: red; color: white; padding: 20px;">Désolé votre pseudo est trop court ou trop long</div><br>';
    }

    $verifCaractere = preg_match('#^[a-zA-Z0-9._-]+$#', $pseudo);
    if ($verifCaractere == false) {
        // Cas d'erreur
        $erreur = true;
        $content .= '<div style="background-color: red; color: white; padding: 20px;">Désolé votre pseudo ne respecte pas les caractères autorisés</div><br>';
    }

    if (iconv_strlen($message) > 300) {
        // Cas d'erreur
        $erreur = true;
        $content .= '<div style="background-color: red; color: white; padding: 20px;">Désolé votre message est trop long</div><br>';
    }

    if ($erreur == false) {
        // - 05 - Déclenche une requete d'enregistrement pour enregistrer la saisie dans la BDD

        // Pour éviter les injections SQL il faut ABSOLUMENT faire notre requete avec prepare() et non pas avec query(), car les informations lancées dans cette requete proviennent de l'utilisateur et pourrait contenir du code malveillant
        // Avec prepare les injections ne sont pas possibles
        $enregistrement = $pdo->prepare("INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES (:pseudo, :message, NOW())");
        $enregistrement->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $enregistrement->bindParam(':message', $message, PDO::PARAM_STR);
        $enregistrement->execute();
        $req = "INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES ('$pseudo', '$message', NOW())";
        // $enregistrement = $pdo->query($req);
    }
}

//  06 - Requete de récupération des messages afin de les afficher dans cette page
$listeCommentaires = $pdo->query("SELECT pseudo, message, date_format(date_enregistrement, '%d/%m/%Y à %H:%i:%s') AS date_fr FROM commentaire ORDER BY date_enregistrement DESC");

// print_r($listeCommentaires);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- Playfair display -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
    <!-- Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        * {
            font-family: 'Roboto', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Playfair Display', serif;
        }
    </style>

    <title>Dialogue</title>
</head>

<body class="bg-secondary">
    <div class="container bg-light g-0">
        <div class='row '>
            <div class="col-12">
                <h2 class="text-center text-dark fs-1 bg-light p-5 border-bottom"><i class="far fa-comments"></i> Espace de dialogue <i class="far fa-comments"></i></h2>
                <!-- - 03 - Création d'un formulaire permettant de poster un message   -->
                <?= $content; ?>
                <form method="post" class="mt-5 mx-auto w-50 border p-3 bg-white">
                <?= $req; ?>
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo</label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <input type="text" class="form-control" id="message" name="message">
                    </div>
                    <button type="submit" class="btn btn-secondary w-100">Enregistrer <i class="fas fa-keyboard"></i></button>
                </form>


            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
            <p class="w-75 mx-auto mb-3">
                <?php 
                // - 08 - Affichage en haut des messages du nombre de messages présents dans la BDD
                echo "Il y a : <b>" . $listeCommentaires->rowCount() . '</b> messages';
                ?>
            </p>
                <?php

                // - 07 - Affichage des commentaires avec un peu de mise en forme
                while ($commentaire = $listeCommentaires->fetch(PDO::FETCH_ASSOC)) {
                    // print_r($commentaire);
         echo '<div class="card w-75 mx-auto mb-3">
                        <div class="card-header bg-dark text-white">
                            Par : ' . htmlspecialchars($commentaire['pseudo']) . ', le : ' . $commentaire['date_fr'] . '
                                </div>
                    <div class="card-body">
          <p class="card-text">' . htmlspecialchars($commentaire['message']) . '</p>
                     </div>
             </div>';
                }

                ?>

            </div>
        </div>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>