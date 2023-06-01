<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <link rel="stylesheet" href="./style/choix_exportation.css">
    
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
           
                <div id="content">
            <fieldset>
                <legend>Choisissez le format </legend>
            <a href="selection_exporter_ref.php"><--</a>
            
            <div class="form">
                <input id="pdf" name="format" type="radio" >
                <label for="pdf">Format PDF</label>
            </div>

            <div class="form">
                <input id="html" name="format" type="radio" >
                <label for="html">Format HTML</label>
            </div>
            <div id="submit" class="form"> 
				<input type="submit" value="Valider"> <!--Appel d'une fonction qui crée le fichier et le télécharge ?-->
			</div>
                
                </div>
            </form>  
        </main>
    </body>
</html>