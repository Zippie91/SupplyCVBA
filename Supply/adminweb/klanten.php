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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO klanten (Naam, Straat, Nr, Postcode, Woonplaats, Email, Ondernemingsnr) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Naam'], "text"),
                       GetSQLValueString($_POST['Straat'], "text"),
                       GetSQLValueString($_POST['Nr'], "text"),
                       GetSQLValueString($_POST['Postcode'], "text"),
                       GetSQLValueString($_POST['Woonplaats'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['Ondernemingsnr'], "text"));

  mysql_select_db($database_connect_supply, $connect_supply);
  $Result1 = mysql_query($insertSQL, $connect_supply) or die(mysql_error());

  $insertGoTo = "klanten.php";
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE klanten SET Naam=%s, Alfacode=%s, Straat=%s, Nr =%s, Postcode=%s, Woonplaats=%s, Email=%s, Ondernemingsnr =%s WHERE klant_id=%s",
                       GetSQLValueString($_POST['Naam'], "text"),
                       GetSQLValueString($_POST['Alfacode'], "text"),
                       GetSQLValueString($_POST['Straat'], "text"),
                       GetSQLValueString($_POST['Nr'], "text"),
                       GetSQLValueString($_POST['Postcode'], "text"),
                       GetSQLValueString($_POST['Woonplaats'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['Ondernemingsnr'], "text"),
                       GetSQLValueString($_POST['klant_id'], "int"));

  mysql_select_db($database_connect_supply, $connect_supply);
  $Result1 = mysql_query($updateSQL, $connect_supply) or die(mysql_error());

  $updateGoTo = "klanten.php";
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_connect_supply, $connect_supply);
$query_KlantQuery = "SELECT * FROM klanten";
$KlantQuery = mysql_query($query_KlantQuery, $connect_supply) or die(mysql_error());
$row_KlantQuery = mysql_fetch_assoc($KlantQuery);
$totalRows_KlantQuery = mysql_num_rows($KlantQuery);

$klant_var_KlantData = "0";
if (isset($_GET['recordID'])) {
  $klant_var_KlantData = $_GET['recordID'];
}
mysql_select_db($database_connect_supply, $connect_supply);
$query_KlantData = sprintf("SELECT * FROM klanten WHERE klanten.klant_id = %s", GetSQLValueString($klant_var_KlantData, "int"));
$KlantData = mysql_query($query_KlantData, $connect_supply) or die(mysql_error());
$row_KlantData = mysql_fetch_assoc($KlantData);
$totalRows_KlantData = mysql_num_rows($KlantData);
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
      <li><a href="prod.php">Producten</a></li>
      <li><a href="kleur.php">Kleuren</a></li>
      <li><a href="klanten.php" class="current">Klanten</a></li>
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
  	<?php if(isset($_GET['recordID'])) {
    	if($_GET['recordID'] != 'new') { ?>
    <form method="post" name="form2" action="<?php echo $editFormAction; ?>">
      <table align="center">
        <tr valign="baseline">
          <td nowrap align="right">Naam:</td>
          <td><input type="text" name="Naam" value="<?php echo htmlentities($row_KlantData['Naam'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Alfacode:</td>
          <td><input type="text" name="Alfacode" value="<?php echo htmlentities($row_KlantData['Alfacode'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Straat:</td>
          <td><input type="text" name="Straat" value="<?php echo htmlentities($row_KlantData['Straat'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Nr.:</td>
          <td><input type="text" name="Nr" value="<?php echo htmlentities($row_KlantData['Nr'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Postcode:</td>
          <td><input type="text" name="Postcode" value="<?php echo htmlentities($row_KlantData['Postcode'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Woonplaats:</td>
          <td><input type="text" name="Woonplaats" value="<?php echo htmlentities($row_KlantData['Woonplaats'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Email:</td>
          <td><input type="text" name="Email" value="<?php echo htmlentities($row_KlantData['Email'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Ondernemingsnr.:</td>
          <td><input type="text" name="Ondernemingsnr" value="<?php echo htmlentities($row_KlantData['Ondernemingsnr'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td><input type="submit" value="Aanpassen" class="submitbutton"></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2"><a href="klanten_delete.php?recordID=<?php echo $row_KlantData['klant_id']; ?>">Deze klant verwijderen?</a></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form2">
      <input type="hidden" name="klant_id" value="<?php echo $row_KlantData['klant_id']; ?>">
    </form>
    <p>&nbsp;</p>
    <p><a href="klanten.php">Terug naar de lijst</a></p>
<?php }
		else if($_GET['recordID'] == 'new') { ?>
        <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
          <table align="center">
            <tr valign="baseline">
              <td nowrap align="right">Naam:</td>
              <td><input type="text" name="Naam" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">Straat:</td>
              <td><input type="text" name="Straat" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">Nr.:</td>
              <td><input type="text" name="Nr" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">Postcode:</td>
              <td><input type="text" name="Postcode" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">Woonplaats:</td>
              <td><input type="text" name="Woonplaats" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">Email:</td>
              <td><input type="text" name="Email" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">Ondernemingsnr.:</td>
              <td><input type="text" name="Ondernemingsnr" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">&nbsp;</td>
              <td><input type="submit" value="Toevoegen" class="submitbutton"></td>
            </tr>
          </table>
          <input type="hidden" name="MM_insert" value="form1">
    </form>
        <p>&nbsp;</p>
        <p><a href="klanten.php">Terug naar de lijst</a></p>
<?php } 
    }
	else { ?>
    <h1>Klanten</h1>
      <form method="get" id="new">
        <input type="hidden" value="new" name="recordID" />
        <input type="submit" class="submitbutton" value="Nieuw" />
   	</form> 
    <table class="infotable klanttable">
        <tr>
          <th>ID</th>
          <th>Naam</th>
          <th>Straat</th>
          <th>Nr.</th>
          <th>Postcode</th>
          <th>Woonplaats</th>
          <th>Email</th>
          <th>BTW-nummer</th>
        </tr>
        <?php do { ?>
        <tr>
          <td><a href="klanten.php?recordID=<?php echo $row_KlantQuery['klant_id']; ?>"><?php echo $row_KlantQuery['klant_id']; ?></a></td>
          <td><a href="klanten.php?recordID=<?php echo $row_KlantQuery['klant_id']; ?>"><?php echo $row_KlantQuery['Naam']; ?></a></td>
          <td><a href="klanten.php?recordID=<?php echo $row_KlantQuery['klant_id']; ?>"><?php echo $row_KlantQuery['Straat']; ?></a></td>
          <td><a href="klanten.php?recordID=<?php echo $row_KlantQuery['klant_id']; ?>"><?php echo $row_KlantQuery['Nr']; ?></a></td>
          <td><a href="klanten.php?recordID=<?php echo $row_KlantQuery['klant_id']; ?>"><?php echo $row_KlantQuery['Postcode']; ?></a></td>
          <td><a href="klanten.php?recordID=<?php echo $row_KlantQuery['klant_id']; ?>"><?php echo $row_KlantQuery['Woonplaats']; ?></a></td>
          <td><a href="klanten.php?recordID=<?php echo $row_KlantQuery['klant_id']; ?>"><?php echo $row_KlantQuery['Email']; ?></a></td>
          <td><a href="klanten.php?recordID=<?php echo $row_KlantQuery['klant_id']; ?>"><?php echo $row_KlantQuery['Ondernemingsnr']; ?></a></td>
        </tr>
        <?php } while ($row_KlantQuery = mysql_fetch_assoc($KlantQuery)); ?> 
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
mysql_free_result($KlantQuery);

mysql_free_result($KlantData);
?>
