<?php
    session_start();
    require_once 'dompdf/autoload.inc.php';
    use Dompdf\Dompdf;
    $ref_a_exporter=$_SESSION["ref_a_exporter"];
    $fichier=fopen("livret_references.html","w");
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
    for ($i=0;$i<count($ref_a_exporter);$i++){
        // 0         1         2       3         4            5            6             7               8               9          10    11             12                    13                14  
		//"$id|$email_jeune|$milieu|$duree|$description|$savoir_faire|$savoir_etre|$nom_referent|$prenom_referent|$email_referent|$date|$statut|$savoir_faire_valides|$savoir_etre_valides|$commentaires\n\n\n";
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
        $dompdf = new Dompdf();
        $html = file_get_contents("livret_references.html");
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("livret_references");
    }else{
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header('Content-Disposition: attachment; filename="'.basename("livret_references.html").'"');
        header('Content-Length: ' . filesize("livret_references.html"));
        header('Pragma: public');

        //Clear system output buffer
        flush();

        //Read the size of the file
        readfile("livret_references.html");

        //Terminate from the script
        die();
    }
?>