<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php

session_start();
$username = $_SESSION['email'];

//enlever les caractères invisibles de fin et de début dans une saisie
$firstname  = trim($_POST['firstname']);
$lastname   = trim($_POST['lastname']);
$birth      = trim($_POST['birth']);
$password   = trim($_POST['password']);

if (file_exists('people.csv') == false) {
    header('Location: page_modifier_compte.php');
}

$data = file('people.csv');

// $key = clé et $csv = valeur
foreach ($data as $key => $csv) {
    
    //prend une chaine csv et le transforme en tableau
    $user = str_getcsv($csv, ';');
	
    //empêche la modification du mot de passe quand il y a une modification dans le compte
    if (strlen($password)==0){
        $new_password=$user[4];
    }else{
        $new_password=password_hash($password, null, []);
    }
    if ($username == $user[3]) {
	//création de la liste de caractères dans la forme voulue dans le fichier csv 
        $newCsv = $firstname . ';' . $lastname . ';' . $birth . ';' . $username . ';' . $new_password . "\n";
	    $_SESSION['nom'] = $lastname;
        $_SESSION["prenom"] = $firstname;
        
        $data[$key] = $newCsv;
        header('Location: accueil_compte.html');
        break;
    }

}

file_put_contents('people.csv', $data);

?>

</body>
</html>
