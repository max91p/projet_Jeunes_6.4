<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

//enlever les caractères invisibles de fin et de début dans une saisie
$firstname  = trim($_POST['firstname']);
$lastname   = trim($_POST['lastname']);
$birth      = trim($_POST['birth']);
$username   = trim($_POST['username']);
$password   = trim($_POST['password']);

 // Vérification des champs vides  
 if($firstname == '' || $lastname == '' || $birth == '' || $username == '' || $password == '')
 {  
    $_SESSION['message'] = "Veuillez remplir tous les champs du formulaire !";
    header('Location: page_creation_compte.php');
    exit();
 }  

 $fp = fopen('people.csv', 'r');
 
 while(feof($fp) == false) {
 
     $csv = fgets($fp);
     var_dump($csv);
     
     //prend une chaine csv et le transforme en tableau
     $user = str_getcsv($csv, ';');
 
     if ($username == $user[3]) {
         echo 'utilisateur déjà existant';
         fclose($fp);
         
         header('Location: page_creation_compte.php');
         exit();
         break;
     
        // break;
        // exit();
     }
 }
 
 fclose($fp);
 

$csv = $firstname . ';' . $lastname . ';' . $birth . ';' . $username . ';' . password_hash($password, null, []) . "\n";

//écriture dans le fichier csv des données entrées
//ajout des données en fin de fichier avec FILE_APPEND
$data = file_put_contents('people.csv', $csv, FILE_APPEND);

$_SESSION['nom'] = $lastname;
$_SESSION["prenom"] = $firstname;
$_SESSION["email"] = $username;

header('Location: accueil_compte.html');
exit();
?>
