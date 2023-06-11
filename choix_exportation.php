<?php
	session_start();
?>
<!DOCTYPE html>
<html>
    <?php
        $ref_a_exporter=array(); //Liste des références sélectionnées
        $liste_demande=$_SESSION['liste_demande'];
        //Le but est de récupérer les informations des références qui ont été sélectionnées
        for ($i=0;$i<count($liste_demande);$i++){
            $id=$liste_demande[$i][0];
            if (isset($_POST["ref_$id"])){ //Si la référence apparaissait sur la page d'avant c'est à dire si elle faisait partie des références répondues de l'utilisateur
                $selection=$_POST["ref_$id"];
                if ($selection=="on"){ //Si la référence a été sélectionnée
                    array_push($ref_a_exporter,$liste_demande[$i]);
                }
            }
        }
        if (count($ref_a_exporter)==0){ //Si aucune référence a été sélectionnée
            header("Location: selection_exporter_ref.php", true); //renvoi à la page précédente
            exit();
        }
        $_SESSION["ref_a_exporter"]=$ref_a_exporter; //Conservation de la liste pour l'exportation
    ?>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <link rel="stylesheet" href="./style/choix_exportation.css">
    </head>
    <body style="margin: 0;">
        <header>
        <div id="logo">
		    <a href=page_accueil2.html><img src="./media/logo.png" alt="Logo site"></a>
			
		</div>
		<div id="texte">Je donne de la valeur à mon engagement</div>
		
		<div id="bouton">
			<a href="voir_profil.php">Jeune</a>
		</div>
        </header>
        <br>
        <main>
            <a href='selection_exporter_ref.php'><img  id='arrow' src='./media/arrow.png' alt='arrow'></a>
            <div id="content">
                <form method='post' action='exporter_fichier.php'>
                    <fieldset>
                        <legend>Choisissez le format </legend>
                    <div class="form">
                        <input id="pdf" name="format" type="radio" value="pdf" checked>
                        <label for="pdf">Format PDF</label>
                    </div>

                    <div class="form">
                        <input id="html" name="format" type="radio" value="html" >
                        <label for="html">Format HTML</label>
                    </div>
                    <div id="submit" class="form"> 
                        <input type="submit" value="Exporter" name="bouton_exporter">
                    </div>
                    </fieldset>
                </form> 
            </div> 
        </main>
    </body>
</html>