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
        <a href="accueil_compte.html"><--</a>
        <h5>Décrivez votre expérience et mettez en avant ce que vous en avez retiré.</h5>
        <form action="envoi_demande.php" method="post">
            <table style="width:100%;table-layout: fixed;" cellspacing=4>
                <colgroup>
                    <col span="1" style="width: 50%;">
                    <col span="1" style="width: 25%;">
                    <col span="1" style="width: 25%;">
                </colgroup>
                <tr>
                    <td style="border:2px solid black;margin:0;padding:5px 15px 5px 10px;"><div>
                        Mon engagement :<br>
                        <br>Milieu de l'engagement : <input style="width:100%;" name="milieu" type="text">
                        <br><br>Durée de l'engagement :<input style="width:100%;" name="duree" type="text">
                        <br><br>Description de l'engagement : <textarea style="width:100%;height:100px;" name="description" type="text"></textarea>
                    </div></td>
                    <td style="border:2px solid black;margin:0;padding:5px 15px 5px 10px;vertical-align:top;"><div style="height:100%;">
                        Mes savoir-faire :<br><br>
                        <textarea style="width:100%;height:233px;" name="savoir_faire"></textarea>
                    </div></td>
                    <td style="border:2px solid black;margin:0;padding:5px 15px 5px 10px;vertical-align:top;"><div style="height:100%;">
                        Mes savoir-être :<br><br>
                        <textarea style="width:100%;height:233px;" name="savoir_etre"></textarea>
                    </div></td>
                </tr>
                <tr>
                    <td style="border:2px solid black;margin:0;padding:5px 15px 10px 10px;vertical-align:top;"><div style="height:100%;">
                        Référent :
                        <br><br>Nom : <input style="width:100%;" name="nom_referent" type="text">
                        <br><br>Prénom : <input style="width:100%;" name="prenom_referent" type="text">
                        <br><br>Email :<input style="width:100%;" name="email_referent" type="text">
                    </div></td>
                </tr>
            </table>
            <br>
            <div style="text-align:center;">
            <input style="font-size:20px;" type="submit" value="Valider">
            </div>
            <br>
            <br>
            <br>
            <br>
        </form>
	</main>
</body>

</html>