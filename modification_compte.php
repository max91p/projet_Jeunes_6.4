<!DOCTYPE html>
<html>
<head>
	
</head>
<body>

<?php

session_start();
$username = $_SESSION['email'];
//session_unset();
//session_destroy();

//enlever les caractères invisibles de fin et de début dans une saisie
$firstname  = trim($_POST['firstname']);
$lastname   = trim($_POST['lastname']);
$birth      = trim($_POST['birth']);
$password   = trim($_POST['password']);

//var_dump($_POST);

echo 'username' . $username;
var_dump($username);


$fp = fopen('people.csv', 'r+');

$counter = 0;

while(feof($fp) == false) {

    $csv = fgets($fp);
    
    //prend une chaine csv et le transforme en tableau
    $user = str_getcsv($csv, ';');

    if ($username == $user[3]) {
        echo 'utilisateur trouvé';
        $newCsv = $lastname . ';' . $firstname . ';' . $birth . ';' . $username . ';' . password_hash($password, null, []) . "\n";
        fseek($fp, $counter, SEEK_SET);
        fwrite($fp,$newCsv);
        fclose($fp);
       ?>
        <meta http-equiv="refresh" content="3; URL=accueil_compte.html">

        <?php break;

    }
    $counter += strlen($csv);

    //var_dump($csv);
}

fclose($fp);

?>

</body>
</html>
