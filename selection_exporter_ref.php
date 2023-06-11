<?php
	session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <link rel="stylesheet" href="./style/selection_envoi_ref.css"> <!--c'est le même fichier que pour l'envoi parce que j'ai juste fait un copié-collé-->
    </head>
    <body>
            <?php
                echo 
                "<header>
			        <div id='logo'>
				        <a href='page_accueil2.html'><img src='media/logo.png' alt='Logo site'></a>
			        </div>
			        <div id='texte'>Je donne de la valeur à mon engagement</div>
			        <div id='bouton'>
				        <a href='voir_profil.php'>Jeune</a>
			        </div>
		        </header>
                <main>
                    <a href='liste_demande.php'><img  id='arrow' src='./media/arrow.png' alt='arrow'></a>
                    <p>Sélectionner les références que vous souhaitez exporter</p>";
                $liste_demande=$_SESSION['liste_demande'];//Liste des références du jeune
                if (count($liste_demande)==0){//Si le jeune n'a aucune référence
                    echo "<br><br><br><br><br><br><div ALIGN=center>Vous n'avez aucune demande de référence</div><br></main>";
                }else{
                    $demandes_repondues=array();
                    for ($i=0;$i<count($liste_demande);$i++){
                        if ($liste_demande[$i][11]=="Répondu"){
                            array_push($demandes_repondues,$liste_demande[$i]);
                            if (count($demandes_repondues)==1){//Si c'est la première référence répondu de la liste
                                echo "<form action='choix_exportation.php' method='post'>";
                            }
                            $id=$liste_demande[$i][0];
                            $milieu=$liste_demande[$i][2];
                            $nom_ref=$liste_demande[$i][7];
                            $prenom_ref=$liste_demande[$i][8];
                            $statut=$liste_demande[$i][11];
                            $date=$liste_demande[$i][10];
                            echo 
                            "<table style='position:absolute;left:27%;'>
                                <td><input style='width:100%;' name='ref_$id' type='checkbox'>
                            </table>
                            <table style='border:2px solid black; align:center;margin-right:30%;margin-left:30%;width:40%;padding:5px;'>
                                <tr style='font-size:20px;'>
                                    <td>Milieu : $milieu<br>Référent(e) : $prenom_ref $nom_ref<br>Date d'envoi : $date</td>
                                    <td style='vertical-align:top;text-align:right;'>Statut : $statut</td>
                                </tr>
                            </table><br>";//Affichage de la référence
                        }
                    }
                    if (count($demandes_repondues)==0){//Si le jeune n'a aucune référence répondue
                        echo "<br><br><br><br><br><br><div ALIGN=center>Vous n'avez aucune demande de référence répondues</div><br></main>";
                    }else{
                        echo 
                                "<br>
                                <div ALIGN=center> 
                                    <input style='font-size:20px;' type='submit' value='Valider'>
                                </div>
                            </form>  
                        </main>";//Affichage de la fin du HTML
                    }
                }
                
            ?>
    </body>
</html>

