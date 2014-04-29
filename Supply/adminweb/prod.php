<?php
session_start();
if(!isset($_SESSION['adminlogin'])) {
	header("location: login.php");	
}
?>
<?php require_once('../Connections/connect_supply.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE products SET prod_naam=%s, prod_categorie=%s, prod_plaats=%s, prod_kleur=%s, prod_actief=%s WHERE prod_id=%s",
                       GetSQLValueString($_POST['prod_naam'], "text"),
                       GetSQLValueString($_POST['prod_categorie'], "int"),
                       GetSQLValueString($_POST['prod_plaats'], "text"),
                       GetSQLValueString($_POST['prod_kleur'], "int"),
                       GetSQLValueString(isset($_POST['prod_actief']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['prod_id'], "int"));

  mysql_select_db($database_connect_supply, $connect_supply);
  $Result1 = mysql_query($updateSQL, $connect_supply) or die(mysql_error());

  $updateGoTo = "prod.php?cat=" . $_GET['cat'];
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO products (prod_naam, prod_categorie, prod_plaats, prod_kleur, prod_actief) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['prod_naam'], "text"),
                       GetSQLValueString($_POST['prod_categorie'], "int"),
                       GetSQLValueString($_POST['prod_plaats'], "text"),
                       GetSQLValueString($_POST['prod_kleur'], "int"),
                       GetSQLValueString(isset($_POST['prod_actief']) ? "true" : "", "defined","1","0"));

  mysql_select_db($database_connect_supply, $connect_supply);
  $Result1 = mysql_query($insertSQL, $connect_supply) or die(mysql_error());

  $insertGoTo = "prod.php?cat=" . $_GET['cat'];
  header(sprintf("Location: %s", $insertGoTo));
}

$prod_var_ProdQuery = "0";
if (isset($_GET['cat'])) {
  $prod_var_ProdQuery = $_GET['cat'];
}
mysql_select_db($database_connect_supply, $connect_supply);
$query_ProdQuery = sprintf("SELECT * FROM products WHERE products.prod_categorie = %s", GetSQLValueString($prod_var_ProdQuery, "int"));
$ProdQuery = mysql_query($query_ProdQuery, $connect_supply) or die(mysql_error());
$row_ProdQuery = mysql_fetch_assoc($ProdQuery);
$totalRows_ProdQuery = mysql_num_rows($ProdQuery);

$cat_var_CatQuery = "0";
if (isset($_GET['cat'])) {
  $cat_var_CatQuery = $_GET['cat'];
}
mysql_select_db($database_connect_supply, $connect_supply);
$query_CatQuery = sprintf("SELECT * FROM categories WHERE categories.cat_id = %s", GetSQLValueString($cat_var_CatQuery, "int"));
$CatQuery = mysql_query($query_CatQuery, $connect_supply) or die(mysql_error());
$row_CatQuery = mysql_fetch_assoc($CatQuery);
$totalRows_CatQuery = mysql_num_rows($CatQuery);

mysql_select_db($database_connect_supply, $connect_supply);
$query_CatData = "SELECT * FROM categories";
$CatData = mysql_query($query_CatData, $connect_supply) or die(mysql_error());
$row_CatData = mysql_fetch_assoc($CatData);
$totalRows_CatData = mysql_num_rows($CatData);

$prod_var_ProdData = "0";
if (isset($_GET['recordID'])) {
  $prod_var_ProdData = $_GET['recordID'];
}
mysql_select_db($database_connect_supply, $connect_supply);
$query_ProdData = sprintf("SELECT * FROM products WHERE products.prod_id = %s", GetSQLValueString($prod_var_ProdData, "int"));
$ProdData = mysql_query($query_ProdData, $connect_supply) or die(mysql_error());
$row_ProdData = mysql_fetch_assoc($ProdData);
$totalRows_ProdData = mysql_num_rows($ProdData);
?>
<!doctype html>
<html lang='nl'><!-- InstanceBegin template="/Templates/AdminTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<title>Supply CVBA &#124;&#124; Administratie</title>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="../CSS/twoColFixLtHdr.css" rel="stylesheet" type="text/css">
</head>

<body>

<div class="container">
  <div class="header"> 
  	<a class="logoS" href="#"></a>
  <!-- end .header --></div>
  <div class="sidebar1"><!-- InstanceBeginEditable name="Sidebar1" -->
    <ul class="nav">
      <li><a href="index.php">Admin</a></li>
      <li><a href="cat.php">Categorie&euml;n</a></li>
      <li><a href="prod.php" class="current">Producten</a></li>
   	  <?php include("../includes/catalogus_lijst.php"); ?>
      <li><a href="kleur.php">Kleuren</a></li>
      <li><a href="klanten.php">Klanten</a></li>
      <li><a href="users.php">Users</a></li>
      <li><a href="bestelling.php">Bestellingen</a></li>
      <li><a href="tekst.php">Teksten</a></li>
      <li><a href="db.php">Database</a></li>
      <li><a href="stats.php">Statistieken</a></li>
    </ul>
  <!-- InstanceEndEditable --><!-- end .sidebar1 -->
  </div>
  <!-- InstanceBeginEditable name="Content" -->
  <div class="content">
    <?php if(isset($_GET['cat'])) { ?>
    	<?php if(isset($_GET['recordID'])) { ?>
			<?php if($_GET['recordID'] != 'new') { ?>
            <h1><?php echo $row_ProdData['prod_naam']; ?></h1>
            <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
              <table align="center">
                <tr valign="baseline">
                  <td nowrap align="right">Naam:</td>
                  <td><input type="text" name="prod_naam" value="<?php echo htmlentities($row_ProdData['prod_naam'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right">Categorie:</td>
                  <td><select name="prod_categorie">
                    <?php 
do {  
?>
                    <option value="<?php echo $row_CatData['cat_id']?>" <?php if (!(strcmp($row_CatData['cat_id'], htmlentities($row_ProdData['prod_categorie'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_CatData['cat_soort'] . " " . $row_CatData['cat_beschrijving'] . " " . $row_CatData['cat_tandkies'];?></option>
                    <?php
} while ($row_CatData = mysql_fetch_assoc($CatData));
?>
                  </select></td>
                <tr>
                <tr valign="baseline">
                  <td nowrap align="right">Plaats:</td>
                  <td><select name="prod_plaats">
                    <option value="boven" <?php if (!(strcmp("boven", htmlentities($row_ProdData['prod_plaats'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Boven</option>
                    <option value="onder" <?php if (!(strcmp("onder", htmlentities($row_ProdData['prod_plaats'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Onder</option>
                  </select></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right">Kleuren: </td>
                  <td><select name="prod_kleur">
                    <option value="1" <?php if (!(strcmp(1, htmlentities($row_ProdData['prod_kleur'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>1</option>
                    <option value="2" <?php if (!(strcmp(2, htmlentities($row_ProdData['prod_kleur'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>2</option>
                    <option value="3" <?php if (!(strcmp(3, htmlentities($row_ProdData['prod_kleur'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>3</option>
                    <option value="4" <?php if (!(strcmp(4, htmlentities($row_ProdData['prod_kleur'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>4</option>
                    <option value="5" <?php if (!(strcmp(5, htmlentities($row_ProdData['prod_kleur'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>5</option>
                  </select></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right">Prod_actief:</td>
                  <td><input type="checkbox" name="prod_actief" value=""  <?php if (!(strcmp(htmlentities($row_ProdData['prod_actief'], ENT_COMPAT, 'utf-8'),1))) {echo "checked=\"checked\"";} ?>></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right">&nbsp;</td>
                  <td><input type="submit" value="Aanpassen" class="submitbutton"></td>
                </tr>
                <tr>
            <td colspan="2"><a href="prod_delete.php?cat=<?php echo $_GET['cat']; ?>&amp;recordID=<?php echo $row_ProdData['prod_id']; ?>">Dit product verwijderen?</a></td>
        		</tr>
              </table>
              <input type="hidden" name="MM_update" value="form1">
              <input type="hidden" name="prod_id" value="<?php echo $row_ProdData['prod_id']; ?>">
            </form>
            <p>&nbsp;</p>
    <p><a href="prod.php?cat=<?php echo $_GET['cat']; ?>">Terug naar de lijst</a></p>
<?php } 
			else if ($_GET['recordID'] == 'new') { ?>
            <h1>Een nieuw product toevoegen</h1>
            <form method="post" name="form2" action="<?php echo $editFormAction; ?>">
              <table align="center">
                <tr valign="baseline">
                  <td nowrap align="right">Naam:</td>
                  <td><input type="text" name="prod_naam" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right">Categorie:</td>
                  <td><select name="prod_categorie">
                    <?php 
            do {  
            ?>
                    <option value="<?php echo $row_CatData['cat_id']?>" <?php if (!(strcmp($row_CatData['cat_id'], $_GET['cat']))) {echo "SELECTED";} ?>><?php echo $row_CatData['cat_soort'] . " " . $row_CatData['cat_beschrijving'] . " " . $row_CatData['cat_tandkies'];?></option>
                    <?php
            } while ($row_CatData = mysql_fetch_assoc($CatData));
            ?>
                  </select></td>
                <tr>
                <tr valign="baseline">
                  <td nowrap align="right">Plaats:</td>
                  <td><select name="prod_plaats">
                    <option value="boven" <?php if (!(strcmp("boven", ""))) {echo "SELECTED";} ?>>Boven</option>
                    <option value="onder" <?php if (!(strcmp("onder", ""))) {echo "SELECTED";} ?>>Onder</option>
                  </select></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right">Kleur:</td>
                  <td><select name="prod_kleur">
                    <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>1</option>
                    <option value="2" <?php if (!(strcmp(2, ""))) {echo "SELECTED";} ?>>2</option>
                    <option value="3" <?php if (!(strcmp(3, ""))) {echo "SELECTED";} ?>>3</option>
                    <option value="4" <?php if (!(strcmp(4, ""))) {echo "SELECTED";} ?>>4</option>
                    <option value="5" <?php if (!(strcmp(5, ""))) {echo "SELECTED";} ?>>5</option>
                  </select></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right">Actief:</td>
                  <td><input type="checkbox" name="prod_actief" value="" checked></td>
                </tr>
                <tr valign="baseline">
                  <td><input type="submit" value="Toevoegen" class="submitbutton"></td>
                  <td nowrap align="right">&nbsp;</td>
                </tr>
              </table>
              <input type="hidden" name="MM_insert" value="form2">
            </form>
            <p>&nbsp;</p>
            <p><a href="prod.php?cat=<?php echo $_GET['cat']; ?>">Terug naar de lijst</a></p>
			<?php } 
        }
		else { ?>
		<?php echo "<h1>" . $row_CatQuery['cat_soort'] . " " . $row_CatQuery['cat_beschrijving'] . " " . $row_CatQuery['cat_tandkies'] . "</h1>"; ?>
    <table class="infotable">
        	<tr>
            	<th>ID</th>
                <th>Naam</th>
                <th>Plaats</th>
                <th>Actief</th>
            </tr>
        <?php do { ?>
          <tr>
                <td><a href="prod.php?cat=<?php echo $_GET['cat']; ?>&amp;recordID=<?php echo $row_ProdQuery['prod_id']; ?>"><?php echo $row_ProdQuery['prod_id']; ?></a></td>
                <td><a href="prod.php?cat=<?php echo $_GET['cat']; ?>&amp;recordID=<?php echo $row_ProdQuery['prod_id']; ?>"><?php echo $row_ProdQuery['prod_naam']; ?></a></td>
                <td><a href="prod.php?cat=<?php echo $_GET['cat']; ?>&amp;recordID=<?php echo $row_ProdQuery['prod_id']; ?>"><?php echo $row_ProdQuery['prod_plaats']; ?></a></td>
                <td><a href="prod.php?cat=<?php echo $_GET['cat']; ?>&amp;recordID=<?php echo $row_ProdQuery['prod_id']; ?>"><?php echo $row_ProdQuery['prod_actief']; ?></a></td>
        </tr>
              <?php } while ($row_ProdQuery = mysql_fetch_assoc($ProdQuery)); ?>
      </table>
      <form method="get" id="new">
      	<input type="hidden" value="<?php echo $_GET['cat']; ?>" name="cat" />
        <input type="hidden" value="new" name="recordID" />
        <input type="submit" class="submitbutton" value="Nieuw" />
      </form>
      <?php }
   	} 
	else { ?>
    <h1>Producten</h1>
    <p>Kies een categorie uit de lijst in de navigatiebalk.</p>
    <?php } ?>
   	<!-- end .content -->
  </div>
  <div class="footer">
     <div class="fltlft">
  	    <p>Copyright &#169; Supply CVBA</p>
    </div>
    <div class="footercontact">
    	Matteottistraat 65<br /> 
		2845 Niel<br />
		België <br />
		<br />
		Tel.: +32(0)3 888 68 61<br />
		GSM:  +32(0)483 08 33 22
	</div>
    <br class="clearfloat" />
    <!-- end .footer -->
  </div>
  <!-- InstanceEndEditable --><!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($ProdQuery);

mysql_free_result($CatQuery);

mysql_free_result($CatData);

mysql_free_result($ProdData);
?>
