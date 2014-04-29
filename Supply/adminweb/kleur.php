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
  $updateSQL = sprintf("UPDATE kleur SET kleur_naam=%s, kleur_actief=%s WHERE kleur_id=%s",
                       GetSQLValueString($_POST['kleur_naam'], "text"),
                       GetSQLValueString(isset($_POST['kleur_actief']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['kleur_id'], "int"));

  mysql_select_db($database_connect_supply, $connect_supply);
  $Result1 = mysql_query($updateSQL, $connect_supply) or die(mysql_error());

  $updateGoTo = "kleur.php";
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO kleur (kleur_naam, kleur_actief) VALUES (%s, %s)",
                       GetSQLValueString($_POST['kleur_naam'], "text"),
					   GetSQLValueString(isset($_POST['kleur_actief']) ? "true" : "", "defined","1","0"));

  mysql_select_db($database_connect_supply, $connect_supply);
  $Result1 = mysql_query($insertSQL, $connect_supply) or die(mysql_error());

  $insertGoTo = "kleur.php";
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_connect_supply, $connect_supply);
$query_KleurQuery = "SELECT * FROM kleur";
$KleurQuery = mysql_query($query_KleurQuery, $connect_supply) or die(mysql_error());
$row_KleurQuery = mysql_fetch_assoc($KleurQuery);
$totalRows_KleurQuery = mysql_num_rows($KleurQuery);

$kleur_var_KleurData = "0";
if (isset($_GET['recordID'])) {
  $kleur_var_KleurData = $_GET['recordID'];
}
mysql_select_db($database_connect_supply, $connect_supply);
$query_KleurData = sprintf("SELECT * FROM kleur WHERE kleur.kleur_id = %s", GetSQLValueString($kleur_var_KleurData, "int"));
$KleurData = mysql_query($query_KleurData, $connect_supply) or die(mysql_error());
$row_KleurData = mysql_fetch_assoc($KleurData);
$totalRows_KleurData = mysql_num_rows($KleurData);
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
      <li><a href="kleur.php" class="current">Kleuren</a></li>
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
      <?php if(isset($_GET['recordID'])) {
		  if($_GET['recordID'] != 'new') { ?>
        <h1>Kleur <?php echo $row_KleurData['kleur_naam']; ?></h1>
		<form method="post" name="form1" action="<?php echo $editFormAction; ?>"> 
        <table align="center">
          <tr valign="baseline">
            <td nowrap align="right">Naam:</td>
            <td><input type="text" name="kleur_naam" value="<?php echo htmlentities($row_KleurData['kleur_naam'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">Actief:</td>
            <td><input type="checkbox" name="kleur_actief" value=""  <?php if (!(strcmp(htmlentities($row_KleurData['kleur_actief'], ENT_COMPAT, 'utf-8'),1))) {echo "checked=\"checked\"";} ?>></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">&nbsp;</td>
            <td><input type="submit" value="Aanpassen" class="submitbutton"></td>
          </tr>
          <tr>
            <td colspan="2"><a href="kleur_delete.php?recordID=<?php echo $row_KleurData['kleur_id']; ?>">Deze kleur verwijderen?</a></td>
        	</tr>
        </table>
        <input type="hidden" name="MM_update" value="form1">
        <input type="hidden" name="kleur_id" value="<?php echo $row_KleurData['kleur_id']; ?>">
      </form> 
      <p>&nbsp;</p>
    <p><a href="kleur.php">Terug naar de lijst</a></p>
			<?php }
		  else if ($_GET['recordID'] == 'new') { ?>
          	<h1>Een nieuwe kleur toevoegen</h1>
				<form method="post" name="form2" action="<?php echo $editFormAction; ?>">
              <table align="center">
                <tr valign="baseline">
                  <td nowrap align="right">Naam:</td>
                  <td><input type="text" name="kleur_naam" value="" size="32"></td>
                </tr>
                 <tr valign="baseline">
                  <td nowrap align="right">Actief</td>
                  <td><input type="checkbox" name="kleur_actief" value="" checked></td>
                </tr>
               <tr valign="baseline">
                  <td nowrap align="right">&nbsp;</td>
                  <td><input type="submit" value="Toevoegen" class="submitbutton"></td>
                </tr>
              </table>
              <input type="hidden" name="MM_insert" value="form2">
            </form>
            <p>&nbsp;</p> 
            <p><a href="kleur.php">Terug naar de lijst</a></p> 
		  <?php }
	  } 
	  else { ?>
      <h1>Kleuren</h1>
		<table class="infotable">
      <tr>
          <th>ID</th>
          <th>Naam</th>
          <th>Actief</th>
      </tr>
        <?php do { ?>  
        <tr>
          <td><a href="kleur.php?recordID=<?php echo $row_KleurQuery['kleur_id']; ?>"><?php echo $row_KleurQuery['kleur_id']; ?></a></td>
          <td><a href="kleur.php?recordID=<?php echo $row_KleurQuery['kleur_id']; ?>"><?php echo $row_KleurQuery['kleur_naam']; ?></a></td>
          <?php if( $row_KleurQuery['kleur_actief'] == 1 ) { ?>
				 <td><a href="kleur.php?recordID=<?php echo $row_KleurQuery['kleur_id'];?>">Ja</a></td>
			 <?php } 
			 else { ?>
				 <td><a href="kleur.php?recordID=<?php echo $row_KleurQuery['kleur_id'];?>">Nee</a></td>
			 <?php } ?>
          </tr>
          <?php } while ($row_KleurQuery = mysql_fetch_assoc($KleurQuery)); ?>
    </table>
		<form method="get" id="new">
            <input type="hidden" value="new" name="recordID" />
            <input type="submit" class="submitbutton" value="Nieuw" />
        </form>
        <?php } ?>
  <!-- end .content --></div>
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
mysql_free_result($KleurQuery);

mysql_free_result($KleurData);
?>
