<?php include("../includes/kleur.php"); ?>
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

$prod_var_ProdBoven1 = "0";
if (isset($_GET["recordID"])) {
  $prod_var_ProdBoven1 = $_GET["recordID"];
}
mysql_select_db($database_connect_supply, $connect_supply);
$query_ProdBoven1 = sprintf("SELECT * FROM products WHERE products.prod_plaats = 'boven'  AND products.prod_categorie = %s AND products.prod_kleur = '1' AND products.prod_actief = 1", GetSQLValueString($prod_var_ProdBoven1, "int"));
$ProdBoven1 = mysql_query($query_ProdBoven1, $connect_supply) or die(mysql_error());
$row_ProdBoven1 = mysql_fetch_assoc($ProdBoven1);
$totalRows_ProdBoven1 = mysql_num_rows($ProdBoven1);

$prod_var_ProdOnder1 = "0";
if (isset($_GET["recordID"])) {
  $prod_var_ProdOnder1 = $_GET["recordID"];
}
mysql_select_db($database_connect_supply, $connect_supply);
$query_ProdOnder1 = sprintf("SELECT * FROM products WHERE products.prod_plaats = 'onder'  AND products.prod_kleur = '1' AND products.prod_categorie = %s AND products.prod_actief = 1", GetSQLValueString($prod_var_ProdOnder1, "int"));
$ProdOnder1 = mysql_query($query_ProdOnder1, $connect_supply) or die(mysql_error());
$row_ProdOnder1 = mysql_fetch_assoc($ProdOnder1);
$totalRows_ProdOnder1 = mysql_num_rows($ProdOnder1);

$prod_var_ProdBoven2 = "0";
if (isset($_GET["recordID"])) {
  $prod_var_ProdBoven2 = $_GET["recordID"];
}
mysql_select_db($database_connect_supply, $connect_supply);
$query_ProdBoven2 = sprintf("SELECT * FROM products WHERE products.prod_plaats = 'boven' AND products.prod_kleur = '2' AND products.prod_categorie = %s AND products.prod_actief = 1", GetSQLValueString($prod_var_ProdBoven2, "int"));
$ProdBoven2 = mysql_query($query_ProdBoven2, $connect_supply) or die(mysql_error());
$row_ProdBoven2 = mysql_fetch_assoc($ProdBoven2);
$totalRows_ProdBoven2 = mysql_num_rows($ProdBoven2);

$prod_var_ProdOnder2 = "0";
if (isset($_GET["recordID"])) {
  $prod_var_ProdOnder2 = $_GET["recordID"];
}
mysql_select_db($database_connect_supply, $connect_supply);
$query_ProdOnder2 = sprintf("SELECT * FROM products WHERE products.prod_plaats = 'onder' AND products.prod_kleur = '2' AND products.prod_categorie = %s AND products.prod_actief = 1", GetSQLValueString($prod_var_ProdOnder2, "int"));
$ProdOnder2 = mysql_query($query_ProdOnder2, $connect_supply) or die(mysql_error());
$row_ProdOnder2 = mysql_fetch_assoc($ProdOnder2);
$totalRows_ProdOnder2 = mysql_num_rows($ProdOnder2);

$i = 0;
$row = 0;
$col = 0;
?>
<input type="hidden" name="cat_id" value="<?php echo $_GET["recordID"]; ?>" />
<table class="bestelling">
	<thead>   
		<?php $i = kleur_query_1($kleur1, $database_connect_supply, $connect_supply); ?>
    </thead>
    <tbody>
      <tr class="title">
        <td colspan="<?php echo ($i + 2) ?>">BOVEN</td>
      </tr>
      <?php do { ?>
      <?php $col = 0; ?>
      <tr class="<?php if($row % 2 == 0) echo 'oneven'; else echo 'even'; ?>">
        <td class="first"><?php echo $row_ProdBoven1['prod_naam']; ?></td>
        <?php do { ?>
        <td><input id="<?php echo ($row + 1) . '_' . ($col + 1); ?>" name="<?php echo $row_ProdBoven1['prod_id'] . '_' . ($col + 1); ?>" type="text" value="0" size="1" /></td>
        <?php $col++; ?>
        <?php } while ($col < $i); ?>
        <td id=<?php echo "rowtotal-" . ($row + 1); ?>>0</td>
      </tr>
      <?php $row++; ?>
      <?php } while ($row_ProdBoven1 = mysql_fetch_assoc($ProdBoven1)); ?>
      <?php kleur_query_1($kleur1, $database_connect_supply, $connect_supply); ?>
      <tr class="title">
        <td colspan="<?php echo ($i + 2) ?>">ONDER</td>
      </tr>
      <?php do { ?>
      <?php $col = 0; ?>
      <tr class="<?php if($row % 2 == 0) echo 'oneven'; else echo 'even'; ?>">
        <td class="first"><?php echo $row_ProdOnder1['prod_naam']; ?></td>
        <?php do { ?>
        <td><input id="<?php echo ($row + 1) . '_' . ($col + 1); ?>" name="<?php echo $row_ProdOnder1['prod_id'] . '_' . ($col + 1); ?>" type="text" value="0" size="1" /></td>
        <?php $col++; ?>
        <?php } while($col < $i); ?>
        <td id=<?php echo "rowtotal-" . ($row + 1); ?>>0</td>
      </tr>
      <?php $row++; ?>
      <?php } while ($row_ProdOnder1 = mysql_fetch_assoc($ProdOnder1)); ?>
    </tbody>
  <tfoot class="foot">
    <tr>
      <td class="first">Totaal</td>
      <?php $col = 0; ?>
      <?php do { ?>
      <td id=<?php echo "coltotal-" . ($col + 1); ?>>0</td>
      <?php $col++; ?>
      <?php } while ($col < $i); ?>
      <td id="settotal">0</td>
    </tr>
  </tfoot>
</table>
<br />
<?php 
$j = 0;
$col = 0;
$row2 = 0;
?>
<?php if ($totalRows_ProdBoven2 > 0) { // Show if recordset not empty ?>	
<table class="bestelling2">
    <thead>   
      <?php $j = kleur_query_2($kleur2, $database_connect_supply, $connect_supply); ?>
    </thead>
    <tbody>
      <tr class="title">
        <td colspan="<?php echo ($j + 2) ?>">BOVEN</td>
      </tr>
      <?php do { ?>
      <?php $col = 0; ?>
      <tr class="<?php if(($row + $row2) % 2 == 0) echo 'oneven'; else echo 'even'; ?>">
        <td class="first"><?php echo $row_ProdBoven2['prod_naam']; ?></td>
        <?php do { ?>
        <td><input id="<?php echo ($row + $row2 + 1) . '_' . ($col + 1); ?>" name="<?php echo $row_ProdBoven2['prod_id'] . '_' . ($col + 1); ?>" type="text" value="0" /></td>
        <?php $col++; ?>
        <?php } while ($col < $j); ?>
        <td id=<?php echo "b2-rowtotal-" . ($row + $row2 + 1); ?>>0</td>
      </tr>
      <?php $row2++; ?>
      <?php } while ($row_ProdBoven2 = mysql_fetch_assoc($ProdBoven2)); ?>
      <tr class="title">
        <td colspan="<?php echo ($j + 2) ?>">ONDER</td>
      </tr>
      <?php do { ?>
      <?php $col = 0; ?>
      <tr class="<?php if(($row + $row2) % 2 == 0) echo 'oneven'; else echo 'even'; ?>">
        <td class="first"><?php echo $row_ProdOnder2['prod_naam']; ?></td>
        <?php do { ?>
        <td><input id="<?php echo ($row + $row2 + 1) . '_' . ($col + 1); ?>" name="<?php echo $row_ProdOnder2['prod_id'] . '_' . ($col + 1); ?>" type="text" value="0" /></td>
        <?php $col++; ?>
        <?php } while($col < $j); ?>
        <td id=<?php echo "b2-rowtotal-" . ($row + $row2 + 1); ?>>0</td>
      </tr>
      <?php $row2++; ?>
      <?php } while ($row_ProdOnder2 = mysql_fetch_assoc($ProdOnder2)); ?>
    </tbody>
  <tfoot class="foot">
    <tr>
      <td class="first">Totaal</td>
      <?php $col = 0; ?>
      <?php do { ?>
      <td id=<?php echo "b2-coltotal-" . ($col + 1); ?>>0</td>
      <?php $col++; ?>
      <?php } while ($col < $j); ?>
      <td id="b2-settotal">0</td>
    </tr>
  </tfoot>
</table>
<?php } // Show if recordset not empty ?>
<?php
mysql_free_result($ProdBoven1);

mysql_free_result($ProdOnder1);

mysql_free_result($ProdBoven2);

mysql_free_result($ProdOnder2);
?>