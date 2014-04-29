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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO categories (cat_soort, cat_beschrijving, cat_tandkies, cat_actief) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['cat_soort'], "text"),
                       GetSQLValueString($_POST['cat_beschrijving'], "text"),
                       GetSQLValueString($_POST['cat_tandkies'], "text"),
                       GetSQLValueString(isset($_POST['cat_actief']) ? "true" : "", "defined","1","0"));

  mysql_select_db($database_connect_supply, $connect_supply);
  $Result1 = mysql_query($insertSQL, $connect_supply) or die(mysql_error());

  $insertGoTo = "cat.php";
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE categories SET cat_soort=%s, cat_beschrijving=%s, cat_tandkies=%s, cat_actief=%s WHERE cat_id=%s",
                       GetSQLValueString($_POST['cat_soort'], "text"),
                       GetSQLValueString($_POST['cat_beschrijving'], "text"),
                       GetSQLValueString($_POST['cat_tandkies'], "text"),
                       GetSQLValueString(isset($_POST['cat_actief']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['cat_id'], "int"));

  mysql_select_db($database_connect_supply, $connect_supply);
  $Result1 = mysql_query($updateSQL, $connect_supply) or die(mysql_error());

  $updateGoTo = "cat.php";
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_connect_supply, $connect_supply);
$query_Cat_Query = "SELECT * FROM categories";
$Cat_Query = mysql_query($query_Cat_Query, $connect_supply) or die(mysql_error());
$row_Cat_Query = mysql_fetch_assoc($Cat_Query);
$totalRows_Cat_Query = mysql_num_rows($Cat_Query);

$cat_var_CatData = "0";
if (isset($_GET['recordID'])) {
  $cat_var_CatData = $_GET['recordID'];
}
mysql_select_db($database_connect_supply, $connect_supply);
$query_CatData = sprintf("SELECT * FROM categories WHERE categories.cat_id = %s", GetSQLValueString($cat_var_CatData, "int"));
$CatData = mysql_query($query_CatData, $connect_supply) or die(mysql_error());
$row_CatData = mysql_fetch_assoc($CatData);
$totalRows_CatData = mysql_num_rows($CatData);
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
      <li><a href="cat.php" class="current">Categorie&euml;n</a></li>
      <li><a href="prod.php">Producten</a></li>
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
	 <?php if(isset($_GET['recordID']) && $_GET['recordID'] != 'new') { ?>
    <h1><?php echo $row_CatData['cat_soort'] . " " . $row_CatData['cat_beschrijving'] . " " . $row_CatData['cat_tandkies']; ?></h1>
    <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
      <table align="center">
        <tr valign="baseline">
          <td nowrap align="right">Soort:</td>
          <td><input type="text" name="cat_soort" value="<?php echo htmlentities($row_CatData['cat_soort'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Beschrijving:</td>
          <td><input type="text" name="cat_beschrijving" value="<?php echo htmlentities($row_CatData['cat_beschrijving'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Tandsoort</td>
          <td><select name="cat_tandkies">
            <option value="Molaren" <?php if (!(strcmp("Molaren", htmlentities($row_CatData['cat_tandkies'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Molaren</option>
            <option value="Tanden" <?php if (!(strcmp("Tanden", htmlentities($row_CatData['cat_tandkies'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Tanden</option>
          </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Actief:</td>
          <td><input type="checkbox" name="cat_actief" value=""  <?php if (!(strcmp(htmlentities($row_CatData['cat_actief']),1))) {echo "checked=\"checked\"";} ?>></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td><input type="submit" value="Aanpassen" class="submitbutton"></td>
        </tr>
        <tr>
            <td colspan="2"><a href="cat_delete.php?recordID=<?php echo $row_CatData['cat_id']; ?>">Deze categorie verwijderen?</a></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form1">
      <input type="hidden" name="cat_id" value="<?php echo $row_CatData['cat_id']; ?>">
    </form>
    <p>&nbsp;</p>
<p><a href="cat.php">Terug naar de lijst</a></p>
    <?php } 
     else if(isset($_GET['recordID']) && $_GET['recordID'] == 'new') { ?>
	<h1>Nieuwe categorie toevoegen</h1>
    <form method="post" name="form2" action="<?php echo $editFormAction; ?>">
      <table align="center">
        <tr valign="baseline">
          <td nowrap align="right">Soort:</td>
          <td><select name="cat_soort">
            <option value="CERAM" <?php if (!(strcmp("CERAM", ""))) {echo "SELECTED";} ?>>CERAM</option>
            <option value="ACRYL" <?php if (!(strcmp("ACRYL", ""))) {echo "SELECTED";} ?>>ACRYL</option>
          </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Beschrijving:</td>
          <td><input type="text" name="cat_beschrijving" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Tandsoort:</td>
          <td><select name="cat_tandkies">
            <option value="Molaren" <?php if (!(strcmp("Molaren", ""))) {echo "SELECTED";} ?>>Molaren</option>
            <option value="Tanden" <?php if (!(strcmp("Tanden", ""))) {echo "SELECTED";} ?>>Tanden</option>
          </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Actief</td>
          <td><input type="checkbox" name="cat_actief" value="" checked></td>
        </tr>
        <tr valign="baseline">
          <td><input type="submit" value="Toevoegen" class="submitbutton"></td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form2">
    </form>
    <p><a href="cat.php">Terug naar de lijst</a></p>
<?php }
	 else { ?>
    <h1>Categorie&euml;n</h1>
    <table class="infotable">
    	    <tr>
    	      <th>ID</th>
    	      <th>Naam</th>
    	      <th>Actief</th>
    	      </tr>
			<?php do { ?>  	    
            <tr>
    	      <td><a href="cat.php?recordID=<?php echo $row_Cat_Query['cat_id'];?>"><?php echo $row_Cat_Query['cat_id']; ?></a></td>
    	      <td><a href="cat.php?recordID=<?php echo $row_Cat_Query['cat_id'];?>"><?php echo $row_Cat_Query['cat_soort'] . " " . $row_Cat_Query['cat_beschrijving'] . " " . $row_Cat_Query['cat_tandkies']; ?></a></td>
             <?php if( $row_Cat_Query['cat_actief'] == 1 ) { ?>
				 <td><a href="cat.php?recordID=<?php echo $row_Cat_Query['cat_id'];?>">Ja</a></td>
			 <?php } 
			 else { ?>
				 <td><a href="cat.php?recordID=<?php echo $row_Cat_Query['cat_id'];?>">Nee</a></td>
			 <?php } ?>
    	    </tr>
			<?php } while ($row_Cat_Query = mysql_fetch_assoc($Cat_Query)); ?>
                    
    	   </table>
    		<form method="get" id="new">
                <input type="hidden" value="new" name="recordID" />
                <input type="submit" class="submitbutton" value="Nieuw" />
            </form>
           
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
mysql_free_result($Cat_Query);

mysql_free_result($CatData);
?>
