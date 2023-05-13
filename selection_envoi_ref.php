<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <style>
            header{
                width: 100%;
                height: 100px;
                left: 0px;
                top: 0px;
                background: #D9D9D9;
            }
            a{
                all: unset;
            }
        </style>
        <script>
            function clic_ref(table){
                var id=table.getAttribute("id");
                var td_statut=document.querySelector("#"+id+" > tbody > tr > td:nth-child(2)>span");
                var statut=td_statut.innerHTML;
                console.log(statut);
                if (statut=="Répondu"){
                    location.href='voir_demande_repondu.php';
                }else{
                    location.href='voir_demande_attente.php';
                }
            }
        </script>
    </head>
    <body style="margin: 0;">
        <header>
            <div align=left style="vertical-align: middle;">
                <a href=page_accueil2.html><img style="max-height: 100px;" src="logo.png" alt="Logo site"></a>
            </div>
            <div align=right style="vertical-align: middle;position:absolute;right:40px;top:25px;height:50px;line-height: 50px;">
                <a href="voir_profil.php" style="vertical-align: middle;font-size: 30px;">Jeune</a>
            </div>
        </header>
        <br>
        <main>
            <a href="liste_demande.php"><--</a>
            <h2 style="text-align:center;">Sélectionner les références que vous souhaitez envoyer</h2>
            <!--A ne pas écrire dans le html directement, ça sera écrit par le php. MAIS CSS à faire pour changer la couleur du statut ou mettre la bordure-->
            <form action="infos_consultant.php" method="post">
                <table style="position:absolute;left:27%;">
                    <td><input style="width:100%;" name="ref1_selectionne" type="checkbox">
                </table>
                <table id="ref1" onclick="clic_ref(this)" style="border:2px solid black; align:center;margin-right:30%;margin-left:30%;width:40%;padding:5px;">
                    <tr style="font-size:20px;">
                        <td>Milieu : <span class="milieu_experience_liste">Lieu</span><br>Référent(e) : <span class="nom_referent_liste_ref">Prénom NOM</span><br>Date d'envoi : <span class="date_experience_ref_liste">01/01/1970</span></td>
                        <td style="vertical-align:top;text-align:right;">Statut : <span class="statut_ref">Répondu</span></td>
                    </tr>
                </table>
                <br>
                <br>
                <div ALIGN=center> 
                    <input style="font-size:20px;" type="submit" value="Valider">
                </div>
            </form>  
        </main>
    </body>
</html>