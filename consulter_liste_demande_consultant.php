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
			<div align=left style='vertical-align: middle;'>
				<a href=page_accueil2.html><img style='max-height: 100px;' src='../media/logo.png' alt='Logo site'></a>
			</div>
			<div align=right style='vertical-align: middle;position:absolute;right:40px;top:25px;height:50px;line-height: 50px;'>
				<a style='vertical-align: middle;font-size: 30px;'>Consultant</a>
			</div>
	</header><br><br>
    <?php
        if (isset($_GET['references_id'])){
            $liste_id_references=explode(',',$_GET['references_id']);
            if (file_exists("references.txt")){
				$liste_references=array();
				$fichier=fopen("references.txt","r");
				$toutes_trouve=false;
				while ($toutes_trouve==false && !feof($fichier)){
					$ligne_entiere="";
					$fin=false;
					$nb_saut=0;
					while ($fin==false && !feof($fichier)){
						$ligne=fgets($fichier);
						if ($ligne=="\n"){
							if ($nb_saut==1){
								$fin=true;
							}else{
								$nb_saut=$nb_saut+1;
							}
						}elseif ($nb_saut==1){
							$nb_saut=0;
							$ligne_entiere .= "\n$ligne";
						}else{
							$ligne_entiere .= "$ligne";
						}
					}
					if (strlen($ligne_entiere)>2){
						$ligne_decoupee=explode('|',$ligne_entiere);
						$id_ligne=$ligne_decoupee[0];
						if (in_array($id_ligne,$liste_id_references)){
							array_push($liste_references,$ligne_decoupee);
							if (count($liste_references)==count($liste_id_references)){
								$toutes_trouve=true;
							}
						}
					}
				}
				if ($toutes_trouve==false){
					echo "Une de ces références n'existe pas";
				}else{
					$email_jeune=$liste_references[0][1];
					$infos_jeune=recup_infos_jeune($email_jeune);
					echo "<main>
					<h2>Consultez les informations et les références du candidat</h2>
					<table style='width:98%;margin:1%;'>
						<colgroup>
							<col span='1' style='width: 50%;'>
							<col span='1' style='width: 50%;'>
						</colgroup>
						<tr>
							<td style='margin:0;vertical-align:top;padding-right:5px;'><div style='padding:5px 15px 1% 1%;border:2px solid black;height:100%;'>
									<u>Informations du candidat :</u><br><br>
									Nom :<br> $infos_jeune[1] <br><br>
									Prénom : <br> $infos_jeune[0] <br><br>
									Email : <br> $email_jeune <br>
								</div></td>
							<td rowspan='2' style='margin:0;vertical-align:top;padding-left:5px;'><div style='padding:5px 15px 1% 1%;border:2px solid black;height:100%;'>
								<u>Références du candidat :</u><br><br>";
					for ($i=0;$i<count($liste_references);$i++){
						$nom_ref=$liste_references[$i][7];
						$prenom_ref=$liste_references[$i][8];
						$date=$liste_references[$i][10];
						$milieu=$liste_references[$i][2];
						echo 	"<div style='border:2px solid black; align:center;width:99%;padding:5px;'>
									Milieu : $milieu<br><br>
									Référent(e) : $prenom_ref $nom_ref<br>
									Date d'envoi : $date
								</div>
								<br>";
					}
					echo 	"</div></td>
						</tr>
				</main>";
                }
            }
        }
		function recup_infos_jeune($email){
			$fichier_compte=fopen("people.csv","r");
			$infos_jeune=array();
			$trouve=false;
			while(feof($fichier_compte) == false and !$trouve) {
				$csv = fgets($fichier_compte);
				$user = str_getcsv($csv, ';');
			
				if ($email == $user[3]) {
					$infos_jeune=array($user[0],$user[1]);
					$trouve=true;
				}
			}
			fclose($fichier_compte);
			return $infos_jeune;
		}
    ?>
</body>

</html>