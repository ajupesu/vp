<?php
	require_once "../../config.php";
	
	//loon andmebaasiga ühenduse
		//serv, kasutaja, parool, andmebaas
		$conn = new mysqli($server_host, $server_user_name, $server_password, $database);
		//määran suhtlemisel kasutatava kooditabeli
		$conn->set_charset("utf8");
		
		//valmistame ette andmete saatmise SQL käsu
		$stmt = $conn->prepare("SELECT comment, grade, added FROM vp_daycomment");
		echo $conn->error;
		//seome saadavad andmed muutujatega
		$stmt->bind_result($comment_from_db, $grade_from_db, $added_from_db);
		//täidame käsu
		$stmt->execute();
		//kui saan ühe kirje
		//if($stmt->fetch()){
			//mis selle ühe kirjega teha
		//}
		//kui tuleb teadmata arv kirjeid
		$comment_html = null;
		while($stmt->fetch()){
			//echo $comment_from_db;
			//<p>kommentaar, hinne päevale: 6, lisatud xxxxxx</p>
			$comment_html .= "<p>" $comment_from_db .", hinne päevale: " .$grade_from_db;
			$comment_html .= ", lisatud " .$added_from_db .".</p> \n";
		}
		
?>


<!DOCTYPE html>
<html lang="et">


<head>
    <meta charset="utf-8">
	<title>Aksel Talvoja programmeerib veebi</title>
</head>


<body>
<h1>Aksel Talvoja programmeerib veebi</h1>
<p>See leht on loodud õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
<p>Õppetöö toimus <a href="https://www.tlu.ee" target="_blank">Tallinna Ülikoolis</a></p>
<a href="https://www.tlu.ee" target="_blank"><img src="pildid/tlu_32.jpg" alt="Tallinna ülikooli Terra õppehoone"></a>

<p> <button>lihtsalt nupp</button>
<button><a href="https://www.youtube.com/"target="_blank">link to youtube</a></button></p>

<p> 1 lõik teksti enda kohta. </p>
<?php echo $comment_html; ?>
</body>
</html>