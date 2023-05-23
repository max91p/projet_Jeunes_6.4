<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$firstname  = trim($_POST['firstname']);
$lastname   = trim($_POST['lastname']);
$birth      = trim($_POST['birth']);
$username   = trim($_POST['username']);
$password   = trim($_POST['password']);

 // Vérification des champs vides  
 if($firstname == '' || $lastname == '' || $birth == '' || $username == '' || $password == '')
 {  
    $_SESSION['message'] = "Veuillez remplir tous les champs du formulaire.";
    header('Location: page_creation_compte.php');
    exit();
 }  
 else {
     echo "Le formulaire a été soumis avec succès.";
 }

$csv = $firstname . ';' . $lastname . ';' . $birth . ';' . $username . ';' . $password . "\n";

//écriture dans le fichier csv des données entrées
$data = file_put_contents('people.csv', $csv, FILE_APPEND);

$_SESSION['email'] = $username;
header('Location: accueil_compte.html');
exit();
?>