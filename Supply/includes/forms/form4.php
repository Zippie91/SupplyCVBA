<?php include('../includes/kleur.php'); ?>
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

$prod_var_ProdBoven5 = "0";
if (isset($_GET["recordID"])) {
  $prod_var_ProdBoven5 = $_GET["recordID"];
}
mysql_select_db($database_connect_supply, $connect_supply);
$query_ProdBoven5 = sprintf("SELECT * FROM products WHERE products.prod_plaats = 'boven' AND products.prod_kleur = '5' AND products.prod_categorie = %s AND products.prod_actief = '1'", GetSQLValueString($prod_var_ProdBoven5, "int"));
$ProdBoven5 = mysql_query($query_ProdBoven5, $connect_supply) or die(mysql_error());
$row_ProdBoven5 = mysql_fetch_assoc($ProdBoven5);
$totalRows_ProdBoven5 = mysql_num_rows($ProdBoven5);

$prod_var_ProdOnder5 = "0";
if (isset($_GET["recordID"])) {
  $prod_var_ProdOnder5 = $_GET["recordID"];
}
mysql_select_db($database_connect_supply, $connect_supply);
$query_ProdOnder5 = sprintf("SELECT * FROM products WHERE products.prod_plaats = 'onder' AND products.prod_kleur = '5' AND products.prod_categorie = %s AND products.prod_actief = '1'", GetSQLValueString($prod_var_ProdOnder5, "int"));
$ProdOnder5 = mysql_query($query_ProdOnder5, $connect_supply) or die(mysql_error());
$row_ProdOnder5 = mysql_fetch_assoc($ProdOnder5);
$totalRows_ProdOnder5 = mysql_num_rows($ProdOnder5);

$i = 0;
$row = 0;
$col = 0;
?>
<input type="hidden" name="cat_id" value="<?php echo $_GET["recordID"]; ?>" />
<table class="bestelling">
    <thead>   
      <?php $i = kleur_query_5($kleur5, $database_connect_supply, $connect_supply); ?>
    </thead>
    <tbody>
      <tr class="title">
        <td colspan="<?php echo ($i + 2) ?>">BOVEN</td>
      </tr>
      <?php do { ?>
      <?php if($row == 6) { ?>
      <?php kleur_query_5($kleur5, $database_connect_supply, $connect_supply); ?>
		  	<tr class="title">
        		<td colspan="<?php echo ($i + 2) ?>">CA-vormen</td>
      		</tr>
	  <?php }?>
      <?php if($row == 7) { ?>
		  	<tr class="title">
        		<td colspan="<?php echo ($i + 2) ?>">FA-vormen</td>
      		</tr>
	  <?php }?>
      <?php $col = 0; ?>
      <tr class="<?php if($row % 2 == 0) echo 'oneven'; else echo 'even'; ?>">
        <td class="first"><?php echo $row_ProdBoven5['prod_naam']; ?></td>
        <?php do { ?>
        <td><input id="<?php echo ($row + 1) . '_' . ($col + 1); ?>" name="<?php echo $row_ProdBoven5['prod_id'] . '_' . ($col + 1); ?>" type="text" value="0" size="1" /></td>
        <?php $col++; ?>
        <?php } while ($col < $i); ?>
        <td id=<?php echo "rowtotal-" . ($row + 1); ?>>0</td>
      </tr>
      <?php $row++; ?>
      <?php } while ($row_ProdBoven5 = mysql_fetch_assoc($ProdBoven5)); ?>
      <?php kleur_query_5($kleur5, $database_connect_supply, $connect_supply); ?>
      <tr class="title">
        <td colspan="<?php echo ($i + 2) ?>">ONDER</td>
      </tr>
      <?php do { ?>
      <?php $col = 0; ?>
      <tr class="<?php if($row % 2 == 0) echo 'oneven'; else echo 'even'; ?>">
        <td class="first"><?php echo $row_ProdOnder5['prod_naam']; ?></td>
        <?php do { ?>
        <td><input id="<?php echo ($row + 1) . '_' . ($col + 1); ?>" name="<?php echo $row_ProdOnder5['prod_id'] . '_' . ($col + 1); ?>" type="text" value="0" size="1" /></td>
        <?php $col++; ?>
        <?php } while($col < $i); ?>
        <td id=<?php echo "rowtotal-" . ($row + 1); ?>>0</td>
      </tr>
      <?php $row++; ?>
      <?php } while ($row_ProdOnder5 = mysql_fetch_assoc($ProdOnder5)); ?>
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
<?php
mysql_free_result($ProdBoven5);

mysql_free_result($ProdOnder5);
?>