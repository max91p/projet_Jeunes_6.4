<?php

session_start();

//la fonction trim enlève les caractères invisibles de fin et de début dans une saisie
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

//ouverture du fichier people.csv, le fichier est crée si il n'existe pas
 $fp = fopen('people.csv', 'a+');
 
 while(feof($fp) == false) {
 
    //utilisation de la fonction fgets pour lire tous les caractères du fichier
     $csv = fgets($fp);
     
     //prend une chaine csv et le transforme en tableau
     $user = str_getcsv($csv, ';');
 
     //boucle permettant de savoir si un utilisateur existe ou pas
     if ($username == $user[3]) {
         echo 'utilisateur déjà existant';
         fclose($fp);
         
         header('Location: page_creation_compte.php');
         exit();
         break;
     }
 }
 
 fclose($fp);
//si l'utilisateur n'existe pas, il est ajouté au fichier people.csv
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
