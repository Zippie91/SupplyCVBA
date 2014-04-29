<?php
session_start();
if(!isset($_SESSION['adminlogin'])) {
	header("location: login.php");	
}
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
      <li><a href="index.php" class="current">Admin</a></li>
      <li><a href="cat.php">Categorieën</a></li>
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
    <h1>Administratie</h1>
    	<div class="images">
        <a href="cat.php" class="linkimg"><img src="../images/linkimages/Categorie.png" />Categorie&euml;n</a>
    	  <a href="prod.php" class="linkimg"><img src="../images/linkimages/Product.png" />Producten</a>
    	  <a href="kleur.php" class="linkimg"><img src="../images/linkimages/Kleur.png" />Kleuren</a>
    	  <a href="klanten.php" class="linkimg"><img src="../images/linkimages/Klanten.png" />Klanten</a>
          <a href="users.php" class="linkimg"><img src="../images/linkimages/Users.png" />Gebruikers</a>
          <a href="tekst.php" class="linkimg"><img src="../images/linkimages/Tekst.png" />Teksten</a>
          <a href="bestelling.php" class="linkimg"><img src="../images/linkimages/Bestelling.png" />Bestelling</a>
          <a href="db.php" class="linkimg"><img src="../images/linkimages/Database.png" />Database</a>
          <a href="stats.php" class="linkimg"><img src="../images/linkimages/Stats.png" />Statistieken</a>
          <br class="clearfloat" />
   	</div>
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
