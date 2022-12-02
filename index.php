<!DOCTYPE html>
<html>
    <head>
	<title>Scrape tel + mail</title>
        <meta charset="utf-8">
		<style>
		table,td, tr{margin:0; padding:0; border:1px solid black;}
		.progressbar-text {text-align:center;margin-bottom:10px !important;}
		</style>
		<!--<script src="jquery-2.2.4.min.js"></script>-->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="progressbar.min.js"></script>
    </head>
    <body>
<div id="progressContainer" style="width:100%; position:fixed; top:0; margin:0; padding:0; background:#5f5f5f">
  <div id="progress"></div>
</div>

<form action="" method="post">
<p>Scrape tel + mail from website</p>

<p><textarea name="sprawdzane_linki" style="min-width:600px; min-height:300px;"><?php if(isset($_POST['sprawdzane_linki'])) echo $_POST['sprawdzane_linki'];?></textarea></p>
<p><input type="submit" value="Dokonaj sprawdzenia" name="submit"/></p>
</form>

<?php
if(isset($_POST['submit'])&& !empty($_POST['sprawdzane_linki'])){
				
$wyswietl_dane=$_POST['sprawdzane_linki'];

$dane_grupy=explode("\n", str_replace("\r", "", $wyswietl_dane));

$gdzie_dodano2 = array();	
$i=0;
for ($s=0;$s<count($dane_grupy);$s++){
	//$adres_link[$s]=$szukana_domena;
	$gdzie_dodano[$s]=$dane_grupy[$s];
	$sites[$s]=$dane_grupy[$s];
	
	$i++;
}

?>
<script>
    "use strict";
    const sites = <?php echo json_encode($gdzie_dodano); ?>;

</script>
<script src="script_domena.js"></script>

<?php

echo "<table>";
	echo "<thead>";
	echo "<tr>";
		echo "<td>L.p.</td>";
		echo "<td>WWW</td>";
		echo "<td>Docelowy adres</td>";
		echo "<td>HTTP</td>";
		echo "<td>Nr tel</td>";
		echo "<td>Nr tel + INFO</td>";
		echo "<td>Mail</td>";
		echo "<td>Mail + INFO</td>";
		echo "<td>Podstrona Kontakt</td>";
		echo "<td>Czy WP Shop</td>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";

	 foreach ($sites as $site) {
		echo '<tr></tr>';
	 }

    echo "</tbody>";
echo "</table>";

}
?>
			
    </body>
	</html>