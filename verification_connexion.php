<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php

session_start();

$username = $_POST['email'];
$password = $_POST['password'];

// récupération de toutes les lignes du fichier dans un tableau
$data = file('people.csv');

foreach ($data as $item) {

    //on décode chaque ligne comme étant du csv
    $csv = str_getcsv($item, ';');
   
    //vérification que le mail et le mot de passe correspondent bien 
    if ($username == $csv[3] && password_verify($password, $csv[4]) == true) {
        //transmission des variables de session pour les pages suivantes
        $_SESSION['email'] = $username;
        $_SESSION["prenom"] = $csv[0];
        $_SESSION["nom"] = $csv[1];
        $_SESSION["naissance"] = $csv[2];

        header('Location: accueil_compte.html');
    
        exit();
    }
}
header('Location: page_connexion.php');
$_SESSION['error'] = 'Login ou mot de passe incorrect';

?>
</body>

</html>



