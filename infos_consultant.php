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
	<main>
        <a href="selection_envoi_ref.php"><--</a>
        <h2 style="text-align:center;">Renseigner les informations du consultant</h2>
        <br>
        <div style="border:2px solid black;margin-right:35%;margin-left:35%;padding :5px;">
            <form action="envoi_ref.php" method="post">
                <p>Nom <br><input name="nom" type="text"></p>
                <p>Prénom <br><input name="prenom" type="text"></p>
                <p>Email <br><input name="email" type="email"></p>
                <input type="submit" value="Envoyer">
            </form>
        </div>
	</main>
</body>

</html>
