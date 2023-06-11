<?php
    session_start();
    //Importation de la bibliothèque Dompdf qui convertit un fichier html en pdf
    require_once 'dompdf/autoload.inc.php';
    use Dompdf\Dompdf;
    $ref_a_exporter=$_SESSION["ref_a_exporter"];
    $fichier=fopen("livret_references.html","w");//Ouverture du fichier html qui sera téléchargé par le site en écrasant tout contenu potentiel
    $debut="<!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv='content-type' content='text/html;charset=UTF-8' />
            <style>
                h3 {
                    text-decoration: underline;
                }
            </style>
        </head>
        <body>";
    fwrite($fichier,$debut);
    for ($i=0;$i<count($ref_a_exporter);$i++){//Ecriture dans le fichier de chaque références sélectionnées
        $ref=$ref_a_exporter[$i];
        $descr=str_replace("\n","<br>",$ref[4]);
        $sf=str_replace("\n","<br>",$ref[5]);
        $se=str_replace("\n","<br>",$ref[6]);
        $sfv=str_replace("\n","<br>",$ref[12]);
        $sev=str_replace("\n","<br>",$ref[13]);
        $comment=str_replace("\n","<br>",$ref[14]);
        $contenu_ref="<h3>Engagement :</h3>
        <u>Milieu</u> : $ref[2]<br>
        <u>Durée</u> : $ref[3]<br>
        <u>Description</u> :<br>$descr<br><br>
        <u>Savoir-faire</u> :<br>$sf<br><br>
        <u>Savoir-être</u> :<br>$se<br><br>
        <h3>Référence : </h3>
        <u>Référent(e)</u> :<br>
        $ref[8] $ref[7] <br>
        $ref[9] <br><br>
        <u>Savoirs-faire validés</u> :<br>$sfv<br><br>
        <u>Savoir_être validés</u> :<br>$sev<br><br>
        <u>Commentaires</u> :<br>$comment<br><hr><br>";
        fwrite($fichier,$contenu_ref);
    }
    $fin="</body></html>";
    fwrite($fichier,$fin);
    fclose($fichier);
    if ($_POST['format']=="pdf"){
        $dompdf = new Dompdf(); //Initialise la variable comme un objet de la classe Dompdf
        $html = file_get_contents("livret_references.html"); //Récupère le contenu de livret_references.html
        $dompdf->loadHtml($html);//Charge le code html

        //Configure la taille du pdf et son orientation
        $dompdf->setPaper('A4', 'portrait');

        //transforme le html en pdf
        $dompdf->render();

        //Exporter le PDF généré vers le navigateur
        $dompdf->stream("livret_references");
    }else{
        //Definit les informations du header
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename("livret_references.html").'"');
        header('Content-Length: ' . filesize("livret_references.html"));
        header('Pragma: public');

        //Vide le buffer de sortie du système
        flush();

        //Lit la taille du fichier
        readfile("livret_references.html");

        //Termine
        die();
    }
?>