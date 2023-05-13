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
	<br>
	<main>
        <a href="liste_demande.php"><--</a>
        <table style="width:100%;table-layout: fixed;" cellspacing=4>
            <colgroup>
                <col span="1" style="width: 50%;">
                <col span="1" style="width: 25%;">
                <col span="1" style="width: 25%;">
            </colgroup>
            <tr>
                <td style="border:2px solid black;margin:0;padding:5px 15px 5px 10px;"><div>
                    Mon engagement :<br>
                    <br>Milieu de l'engagement :<br> <span id="milieu">Lieu</span>
                    <br><br>Durée de l'engagement :<br> <span id="duree">Un temps certain</span>
                    <br><br>Description de l'engagement : <div style="height:100px;overflow-y:scroll">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam tincidunt porttitor eros non efficitur. 
                    Fusce volutpat augue sit amet elit tempus porta. Nunc tincidunt urna a convallis porttitor. Sed eu lacinia nisi. In facilisis ex elit, a dapibus tortor pellentesque sed. 
                    Maecenas laoreet mi ac porttitor venenatis. Fusce nibh justo, lobortis in accumsan ac, dapibus eget ligula. Nunc nec tempor nulla. Phasellus eu justo libero. Duis quis fermentum nisl. 
                    Aliquam porttitor justo ut bibendum auctor. Nulla mi eros, porta sed orci sed, tristique iaculis nibh. Mauris in tortor finibus tellus semper aliquet ut vel leo. Fusce iaculis interdum enim, 
                    eget posuere orci auctor eu. Suspendisse fringilla diam non nisl semper, eget faucibus erat porta.</div>
                </div></td>
                <td style="border:2px solid black;margin:0;padding:5px 15px 5px 10px;vertical-align:top;"><div style="height:100%;">
                    Mes savoir-faire :<br><br>
                    <div id="savoir_faire" style="height:233px;overflow-y:scroll">- Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    <br>- Phasellus vel mauris sed nunc varius euismod.
                    <br>- Nam blandit ante in ligula tincidunt, sit amet imperdiet eros aliquam.
                    <br>- Integer pellentesque ante quis accumsan efficitur.
                    <br>- Cras eu mauris ultricies, sollicitudin massa eu, viverra nulla.</div>
                </div></td>
                <td style="border:2px solid black;margin:0;padding:5px 15px 5px 10px;vertical-align:top;"><div style="height:100%;">
                    Mes savoir-être :<br><br>
                    <div id="savoir_etre" style="height:233px;overflow-y:scroll">- Fusce<br>- malesuada<br>- quam<br>- eumi<br>- egestas<br>- faucibus</div>
                </div></td>
            </tr>
            <tr>
            <td style="border:2px solid black;margin:0;padding:5px 15px 10px 10px;vertical-align:top;"><div style="height:100%;">
                    Référent :
                    <br><br>Nom : <br><span id="nom_referent">Truc</span>
                    <br><br>Prénom : <br><span id="prenom_referent">Machin</span>
                    <br><br>Email : <br><span id="email_referent">machin.truc@quelquechose.fr</span>
                </div></td>
            </tr>
        </table>
        <br>
        <p>Envoyé le <span id="date_envoi">01/01/1970</span><br>Statut : <span id="statut">En attente</span></p>
        <br>
        <br>
        <br>
        <br>
	</main>
</body>

</html>