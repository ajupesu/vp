<?php
	$author_name = "Aksel Talvoja";
	$full_time_now = date("d.m.Y H:i:s");
	$weekday_now = date("N");
	//echo $weekday_now;
	$weekdaynames_et = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
	//echo $weekdaynames_et[$weekday_now - 1];
	$hours_now = date("H");
	//echo $hours_now;
	$part_of_day = "suvaline päeva osa";
	//  <   > >=  <=   ==  !=
	$vanasona = ["Allamäge on kerge minna", "Igaüks on oma rahu isand", "Koera töö, koera palk", "Elu hea, kui teised ei tea", "Iga kaupmees kiidab oma kaupa"];
	
	if($weekday_now <= 5){
		if($hours_now < 7){
		$part_of_day = "uneaeg";
		}
	//   and   or
		if($hours_now >= 8 and $hours_now < 18){
		$part_of_day = "koolipäev";
		}
		if($hours_now >= 19 and $hours_now < 23){
		$part_of_day = "õhtu nauding";
		}
	}
	if($weekday_now = 6 or 7){
		if($hours_now < 10){
		$part_of_day = "uneaeg";
		}
		if($hours_now >= 10 and $hours_now < 15){
		$part_of_day = "õppimine";
		}
		if($hours_now >= 15 and $hours_now < 2){
		$part_of_day = "vabaaeg";
		}
	}
		
		
	//uurime semestri kestmist
	$semester_begin = new DateTime("2022-9-5");
	$semester_end = new DateTime("2022-12-18");
	$semester_duration = $semester_begin->diff($semester_end);
	//echo $semester_duration;
	$semester_duration_days = $semester_duration->format("%r%a");
	$from_semester_begin = $semester_begin->diff(new DateTime("now"));
	$from_semester_begin_days = $from_semester_begin->format("%r%a");

	//juhuslik arv
	//küsin massiivi pikkust
	//echo count($weekdaynames_et);
	//echo mt_rand(0, count($weekdaynames_et) -1);
	//echo $weekdaynames_et[mt_rand(0, count($weekdaynames_et) -1)];


	//juhuslik foto
	$photo_dir = "muudpildid";
	//loen kataloogi isus
	$all_files = scandir($photo_dir);
	//var_dump($all_files);
	$all_real_files = array_slice($all_files, 2);
	//kontrollin kas ikka foto
	$allowed_photo_types = ["image/jpeg", "image/png"];
	//tükkel
	// muutuja väärtuse suurendamine $muutuja =$muutuja + 5
	// $muutuja += 5
	// kui on vaja liita 1
	// $muutuja ++
	// sama moodi $muutuja -=5  $muutuja --
	/*for($i = 0;$i < count($all_files); $i ++) {
		echo $all_files[$i];
	}*/
	$photo_files = [];
	//foreach($all_files as $filename) {
		//echo $filename;
		//$file_info = getimagesize($photo_dir ."muudpildid" .$filename);
		//var_dump ($file_info);
		//kas on lubatud tüüpide nimekirjas
	//	if(isset($fileinfo["mime"])){
	//		if(in_array($file_info["mime"], $allowed_photo_types)){
	//			array_push($photo_files, $filename);
	//		}//if in_array
	//	}//if isset
	//}//foreach
	//var_dump($photo_files);
	//	<img src="kataloog/fail" alt="tekst">
	$photo_html = '<img src="'.$photo_dir ."muudpildid" .$photo_files[mt_rand(1, count($photo_files) - 1)] .'"';
	$photo_html .= ' alt="Tallinna pilt">';
	//echo $photo_html;
	
	//loome rippmenüü valikud
	// <option value="0">tln_6.JPG</option>
	//	<option value="1">tln_10.JPG</option>
	
	
	//var_dump($_POST);
	$todays_adjective = "pole midagi sisestatud";
	if(isset($POST["todays_adjective_input"]) and !empty($_POST["todays_adjective_input"]))
		$todays_adjective = $_POST["todays_adjective_input"];

	$select_html = null;
	for($i = 0;$i < count($photo_files); $i ++) {
		$select_html .= '<option value="' .$i .'">';
		$select_html .= $photo_files[$i];
		$select_html .= "</option>";
	}
?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title><?php echo $author_name;?> programmeerib veebi</title>
</head>
<body>
<img src="pics/vp_banner_gs.png" alt="bänner">
<h1><?php echo $author_name;?> programmeerib veebi</h1>
<p>See leht on loodud õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
<p>Õppetöö toimus <a href="https://www.tlu.ee" target="_blank">Tallinna Ülikoolis</a> Digitehnoloogiate instituudis.</p>
<p>Lehe avamise hetk: <?php echo $weekdaynames_et[$weekday_now - 1] .", " .$full_time_now;?></p>
<p>Praegu on <?php echo $part_of_day;?>.</p>
<p>Semestri pikkus on <?php echo $semester_duration_days;?> päeva. See on kestnud juba <?php echo $from_semester_begin_days; ?> päeva.</p>
<img src="pics/tlu_39.jpg" alt="Tallinna Ülikooli ajalooline Terra õppehoone">

<form method="POST">
	<input type="text" id="todays_adjective_input" name="todays_adjective_input"
	placeholder="kirjuta siia omadussõna tänase päeva kohta">
	<input type="submit" id="todays_adjective_submit" name="todays_adjective_submit" value="Saada omadussõna!"
</form>
<p>Omadussõna tänase kohta: <?php echo $todays_adjective; ?></p>
<hr>
<form method="POST">
	<select id="photo_select" name="photo_select">
		<?php echo $select_html?>
	</select>
	<input type="submit" id="photo_submit" name="photo_submit" value="määra foto">
</form>
<?php echo $photo_html; ?>
</hr>

</body>
</html>