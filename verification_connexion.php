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
    if ($username == $csv[0] && $password == $csv[1]) {
        $_SESSION['email'] = $username;
        header('Location: accueil_compte.html');
        exit();
    }
}
header('Location: page_connexion.php');
$_SESSION['error'] = 'Login ou mot de passe incorrect';

?>


