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

$cat_var_CategorieData = "0";
if (isset($_GET["recordID"])) {
  $cat_var_CategorieData = $_GET["recordID"];
}
mysql_select_db($database_connect_supply, $connect_supply);
$query_CategorieData = sprintf("SELECT * FROM categories WHERE categories.cat_id = %s", GetSQLValueString($cat_var_CategorieData, "int"));
$CategorieData = mysql_query($query_CategorieData, $connect_supply) or die(mysql_error());
$row_CategorieData = mysql_fetch_assoc($CategorieData);
$totalRows_CategorieData = mysql_num_rows($CategorieData);

$prod_var_ProductData = "0";
if (isset($_GET["recordID"])) {
  $prod_var_ProductData = $_GET["recordID"];
}
mysql_select_db($database_connect_supply, $connect_supply);
$query_ProductData = sprintf("SELECT * FROM products WHERE products.prod_categorie = %s", GetSQLValueString($prod_var_ProductData, "int"));
$ProductData = mysql_query($query_ProductData, $connect_supply) or die(mysql_error());
$row_ProductData = mysql_fetch_assoc($ProductData);
$totalRows_ProductData = mysql_num_rows($ProductData);
?>
<!doctype html>
<html lang='nl'><!-- InstanceBegin template="../Templates/MainTemp.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Supply CVBA</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<meta name="keywords" content="
Supply, Niel, tanden, tandlabo, tandtechnicus, groothandel tanden, tandprothese, tandmateriaal, porselein, acryl, tandchirurg, [Dentaaltechnische bedrijven]" >
<meta name="description" content="GG Supply in Niel is uw specialist groothandel in tanden uit acryl en porselein prothese. Slijtvastheid en kwaliteit zijn onze troeven voor u de juiste service!" >
<link href="../CSS/main_2col_hdrftr.css" rel="stylesheet" type="text/css">
<link rel="icon" type="image/x-icon" href="../images/favicon.ico">

<script src="../lib/jquery.js"></script>
<script src="../includes/scripts/stickyMojo.js"></script>
</head>

<body>
<div class="container">
  <div class="header">
  	<a href="index.php" class="logoS"></a>
    <img src="../images/headerbody/Enta_Logo.gif" alt="Enta" class="logoE"/>
  <!-- end .header --></div>
  <div class="nav">
  	<div class="main_menu"><!-- InstanceBeginEditable name="Edit current class" -->
  	  <ul class="bluebar">
  	    <li><a href="../main/index.php" title="Home"><span>Home</span></a></li>
  	    <li><a href="../main/prodshop.php" title="Producten" class="current"><span>Producten</span></a></li>
  	    <li><a href="../main/contact.php" title="Contact"><span>Contact</span></a></li>
      </ul>
  	<!-- InstanceEndEditable --><!-- end .main_menu --></div>
    <div class="shopcart">
    	<a href="shoppingcart.php"></a>
    </div>
  <!-- end .nav --></div>
  <div class="sidebar">
	<!-- InstanceBeginEditable name="sidebar" -->
    <div class="subsidebar">
      <?php include("../includes/catalogus.php"); ?>
    </div>
  <!-- InstanceEndEditable -->
  <!-- end .sidebar --></div>
  <div class="content">
  <!-- InstanceBeginEditable name="Content" -->
  	<?php if(isset($_GET["recordID"])) {
		echo "<h1>" . $row_CategorieData['cat_soort'] . " " . $row_CategorieData['cat_beschrijving'] . " " . $row_CategorieData['cat_tandkies'] . "</h1>"; 
        if($_GET['recordID'] == 4 || $_GET['recordID'] == 11 ) { ?>
        <h5>*Langere levertijd</h5>
  	    <?php } ?>
		<form method="post" name="form" class="formclass" autocomplete="off" action="shoppingcart.php?submit=true">
		<?php if ($totalRows_ProductData > 0) { // Show if recordset not empty
  			include("../includes/formswitch.php"); ?>
			<input type="submit" value="Toevoegen" class="submitbutton">
  	 	<?php } // Show if recordset not empty
		else { ?>
			<p>Deze categorie is momenteel leeg.</p>	
		<?php } ?>
        </form>
        <?php include('../includes/scripts/calcRow.php'); ?>
	<?php }
    else { ?>
    <h1>Welkom!</h1>
    <p>Kies een categorie aan de linkerzijde.</p>
    <?php } ?>
  <!-- InstanceEndEditable -->
  <!-- end .content --></div>
  <div class="footer">
  	 <div class="fltlft">
          <p>Copyright &#169; Supply CVBA, Raf Smits</p>
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
  <!-- end .footer -->  </div>
<!-- end .container --></div>
<script>
$(document).ready(function(){
    $('.sidebar').stickyMojo({footerID: '.footer', contentID: '.content'});
});
  
$('.bestelling input').change( function() {
	calcRows();
});

<?php if(isset($j)) { ?>
$('.bestelling2 input').change( function() {
	calcRows();
});
<?php } ?>
</script>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($CategorieData);

mysql_free_result($ProductData);

mysql_close($connect_supply);
?>