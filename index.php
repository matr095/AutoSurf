<!DOCTYPE HTML>
<html>
	<head>
		<title>AutoSurf | Gratuit</title>
		<style type="text/css">
			body {
				background: #224488;
				color: #fff;
				text-align: center;
			}
			iframe {
				margin: 10px;
			}
		</style>
	</head>
	<body>
		<div id="presentation">
			<p>Tu n'as rien à faire ? Regarde quelques nouveaux sites...</p>
		</div>
		<div id="site">
			<iframe src="http://matr.fr" width="640" height="480"></iframe>
		</div>

		<!--//récupérer les sites-->
		<?php
		$bdd = new PDO('mysql:host=localhost;dbname=sites;charset=utf8', 'root', 'root');

		$reponse1 = $bdd->query("SELECT url FROM sitio ORDER BY id DESC;");
		$datas = $reponse1->fetchAll();
		?>
		
		<!--//afficher la visionneuse-->
		<script>
			
			var site1 = '<?php echo $datas[0][0]; ?>';
			var site2 = '<?php echo $datas[1][0]; ?>';
			var site3 = '<?php echo $datas[2][0]; ?>';
			var site4 = '<?php echo $datas[3][0]; ?>';
			var site5 = '<?php echo $datas[4][0]; ?>';
			var sites = [site1,site2,site3,site4,site5];
			var i = 0;

			function loadwebsite(site) {
				document.getElementById("site").innerHTML = '<iframe src="'+sites[i]+'" width="640" height="480"></iframe>';
				i++;
			 	if(i>=sites.length) {
			 		i = 0;
			 	}
			}
			setInterval(loadwebsite, 15000, site);
			
		</script>

		<!--ajouter un element dans la bdd-->
		<?php
		if(isset($_POST['site'])) {
			$site = $_POST['site'];
			$req = $bdd->prepare('INSERT INTO sitio(id, url) VALUES(:id, :url)');
			$req->execute(array(
				'id' => "",
				'url' => htmlentities($site)
			));

		}
		?>
		<p>Entre ici l'URL de ton site:</p>
		<form method="POST" action="">
			<input placeholder="Ton site" id="site" name="site" value="http://"/>
			<input type="submit"/>
		</form>


	</body>
</html>