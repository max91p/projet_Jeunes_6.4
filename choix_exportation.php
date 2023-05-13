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
            <a href="selection_exporter_ref.php"><--</a>
            <h2 style="text-align:center;">Choisissez le format</h2>
            <form>
                <div style="align:center;border:2px solid black;margin-left:45%;margin-right:45%;padding:5px;">
                    <input type="radio" name="format" value="pdf" checked> Format PDF<br>
                    <input type="radio" name="format" value="html" checked> Format HTML
                </div>
                <br>
                <br>
                <div ALIGN=center> 
                    <input style="font-size:20px;" type="submit" value="Valider"><!--Appel d'une fonction qui crée le fichier et le télécharge ?-->
                </div>
            </form>  
        </main>
    </body>
</html>