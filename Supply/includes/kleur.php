<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_connect_supply, $connect_supply);
$query_KleurQuery = "SELECT * FROM kleur";
$KleurQuery = mysql_query($query_KleurQuery, $connect_supply) or die(mysql_error());
$row_KleurQuery = mysql_fetch_assoc($KleurQuery);
$totalRows_KleurQuery = mysql_num_rows($KleurQuery);


?>
<?php
// ~~ Kleuren categorie 1 ~~
$counter = 0;
for($c = 0; $c < $totalRows_KleurQuery; $c++)
{
	if ($c < 18) 
	{
		$kleur1[$counter] = $c + 1;
		$counter++;
	}
}

// ~~ Kleuren categorie 2 ~~
$counter = 0;
for($c = 0; $c < $totalRows_KleurQuery; $c++) 
{
	if ($c < 5 or $c == 9 or $c == 12)
	{
		$kleur2[$counter] = $c + 1;
		$counter++;	
	}
}

// ~~ kleuren categorie 3 ~~
$counter = 0;
for($c = 0; $c < $totalRows_KleurQuery; $c++) 
{
	if ($c != 6 and $c < 18)
	{
		$kleur3[$counter] = $c + 1;
		$counter++;	
	}
}

// ~~ kleuren categorie 4 ~~
$counter = 0;
for($c = 0; $c < $totalRows_KleurQuery; $c++) 
{
	if ($c != 0 and $c != 6 and $c < 18)
	{
		$kleur4[$counter] = $c + 1;
		$counter++;	
	}
}

// ~~ kleuren categorie 5 ~~
$counter = 0;
for($c = 0; $c < $totalRows_KleurQuery; $c++) 
{
	if ($c > 17)
	{
		$kleur5[$counter] = $c + 1;
		$counter++;	
	}
} ?>

<?php
function kleur_query_1 ($kleur1, $database_connect_supply, $connect_supply) {
	mysql_select_db($database_connect_supply, $connect_supply);
	$query_KleurQuery1 = "SELECT * FROM kleur WHERE kleur.kleur_id IN (".implode(',',$kleur1).")";
	$KleurQuery1 = mysql_query($query_KleurQuery1, $connect_supply) or die(mysql_error());
	$row_KleurQuery1 = mysql_fetch_assoc($KleurQuery1);
	$totalRows_KleurQuery1 = mysql_num_rows($KleurQuery1);
	
	$col = 0;
?>
	<tr class="kleur">
        <th class="first">Kleur</th>
        <?php do { ?>
        <th><?php echo $row_KleurQuery1['kleur_naam']; ?></th>
        <?php $col++; ?>
        <?php } while ($row_KleurQuery1 = mysql_fetch_assoc($KleurQuery1)); ?>
        <th>Totaal</th>
	</tr>
    <?php return $col; ?>
<?php     
	mysql_free_result($KleurQuery1);	
}
?>

<?php
function kleur_query_2 ($kleur2, $database_connect_supply, $connect_supply) {
	mysql_select_db($database_connect_supply, $connect_supply);
	$query_KleurQuery2 = "SELECT * FROM kleur WHERE kleur.kleur_id IN (".implode(',',$kleur2).")";
	$KleurQuery2 = mysql_query($query_KleurQuery2, $connect_supply) or die(mysql_error());
	$row_KleurQuery2 = mysql_fetch_assoc($KleurQuery2);
	$totalRows_KleurQuery2 = mysql_num_rows($KleurQuery2);
	
	$col = 0;
?>
    <tr class="kleur">
        <th class="first">Kleur</th>
        <?php do { ?>
        <th><?php echo $row_KleurQuery2['kleur_naam']; ?></th>
        <?php $col++; ?>
        <?php } while ($row_KleurQuery2 = mysql_fetch_assoc($KleurQuery2)); ?>
        <th>Totaal</th>
	</tr>
   	<?php return $col; ?>
<?php 
	mysql_free_result($KleurQuery2);
}
?>

<?php
function kleur_query_3 ($kleur3, $database_connect_supply, $connect_supply) {
	mysql_select_db($database_connect_supply, $connect_supply);
	$query_KleurQuery3 = "SELECT * FROM kleur WHERE kleur.kleur_id IN (".implode(',',$kleur3).")";
	$KleurQuery3 = mysql_query($query_KleurQuery3, $connect_supply) or die(mysql_error());
	$row_KleurQuery3 = mysql_fetch_assoc($KleurQuery3);
	$totalRows_KleurQuery3 = mysql_num_rows($KleurQuery3);
		
	$col = 0;
?>
    <tr class="kleur">
        <th class="first">Kleur</th>
        <?php do { ?>
        <th><?php echo $row_KleurQuery3['kleur_naam']; ?></th>
        <?php $col++; ?>
        <?php } while ($row_KleurQuery3 = mysql_fetch_assoc($KleurQuery3)); ?>
        <th>Totaal</th>
    </tr>
    <?php return $col; ?>
<?php 
	mysql_free_result($KleurQuery3);
}
?>

<?php
function kleur_query_4 ($kleur4, $database_connect_supply, $connect_supply) {
	mysql_select_db($database_connect_supply, $connect_supply);
	$query_KleurQuery4 = "SELECT * FROM kleur WHERE kleur.kleur_id IN (".implode(',',$kleur4).")";
	$KleurQuery4 = mysql_query($query_KleurQuery4, $connect_supply) or die(mysql_error());
	$row_KleurQuery4 = mysql_fetch_assoc($KleurQuery4);
	$totalRows_KleurQuery4 = mysql_num_rows($KleurQuery4);
		
	$col = 0;
?>
    <tr class="kleur">
        <th class="first">Kleur</th>
        <?php do { ?>
        <th><?php echo $row_KleurQuery4['kleur_naam']; ?></th>
        <?php $col++; ?>
        <?php } while ($row_KleurQuery4 = mysql_fetch_assoc($KleurQuery4)); ?>
        <th>Totaal</th>
    </tr>
    <?php return $col; ?>
<?php 
	mysql_free_result($KleurQuery4);
}
?>

<?php
function kleur_query_5 ($kleur5, $database_connect_supply, $connect_supply) {
	mysql_select_db($database_connect_supply, $connect_supply);
	$query_KleurQuery5 = "SELECT * FROM kleur WHERE kleur.kleur_id IN (".implode(',',$kleur5).")";
	$KleurQuery5 = mysql_query($query_KleurQuery5, $connect_supply) or die(mysql_error());
	$row_KleurQuery5 = mysql_fetch_assoc($KleurQuery5);
	$totalRows_KleurQuery5 = mysql_num_rows($KleurQuery5);
		
	$col = 0;
?>
    <tr class="kleur">
        <th class="first">Kleur</th>
        <?php do { ?>
        <th><?php echo $row_KleurQuery5['kleur_naam']; ?></th>
        <?php $col++; ?>
        <?php } while ($row_KleurQuery5 = mysql_fetch_assoc($KleurQuery5)); ?>
        <th>Totaal</th>
    </tr>
    <?php return $col; ?>
<?php 
	mysql_free_result($KleurQuery5);
}
?>

<?php
mysql_free_result($KleurQuery);
?>