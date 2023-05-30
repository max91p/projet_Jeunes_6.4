<!DOCTYPE html>
<html>
<head>
	
</head>
<body>

<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

session_start();

$username = $_POST['email'];
$password = $_POST['password'];

// récupération de toutes les lignes du fchier dans un tableau
$data = file('people.csv');

//débug
var_dump($_POST);

foreach ($data as $item) {
    //on décide chaque ligne comme étant du csv
    $csv = str_getcsv($item, ';');
    var_dump($item);
    //if ($username == $csv[3] && $password == $csv[4]) {
    if ($username == $csv[3] && password_verify($password, $csv[4]) == true) {
        $_SESSION['email'] = $username;
        $_SESSION["prenom"] = $csv[0];
        $_SESSION["nom"] = $csv[1];
        $_SESSION["naissance"] = $csv[2];
        $_SESSION["mdp"] = $password;
        ?>
            <p>
                 compte valide
            </p>

<meta http-equiv="refresh" content="3; URL=accueil_compte.html">
        <?php 
        //header('Location: accueil_compte.html');
        exit();
    }
}
header('Location: page_connexion.php');
$_SESSION['error'] = 'Login ou mot de passe incorrect';

?>
</body>

</html>



