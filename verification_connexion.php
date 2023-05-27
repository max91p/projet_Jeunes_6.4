<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$username = $_POST['email'];
$password = $_POST['password'];

$data = file('people.csv');

var_dump($_POST);

foreach ($data as $item) {
    $csv = str_getcsv($item, ';');
    var_dump($item);
    if ($username == $csv[3] && $password == $csv[4]) {
        $_SESSION["prenom_jeune"] = $csv[0];
        $_SESSION["nom_jeune"] = $csv[1];
        $_SESSION["email_jeune"] = $username;
        $_SESSION["naissance"] = $csv[2];
        $_SESSION["mdp"] = $password;
        header('Location: accueil_compte.html');
        exit();
    }
}
header('Location: page_connexion.php');
$_SESSION['error'] = 'Login ou mot de passe incorrect';

?>


