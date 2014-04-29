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
      <li><a href="index.php">Admin</a></li>
      <li><a href="cat.php">Categorie&euml;n</a></li>
      <li><a href="prod.php">Producten</a></li>
      <li><a href="kleur.php">Kleuren</a></li>
      <li><a href="klanten.php">Klanten</a></li>
      <li><a href="users.php">Users</a></li>
      <li><a href="bestelling.php">Bestellingen</a></li>
      <li><a href="tekst.php">Teksten</a></li>
      <li><a href="db.php" class="current">Database</a></li>
      <li><a href="stats.php">Statistieken</a></li>
    </ul>
  <!-- InstanceEndEditable --><!-- end .sidebar1 -->
  </div>
  <!-- InstanceBeginEditable name="Content" -->
  <div class="content">
    <?php if(isset($_GET['id'])) {
    	if($_GET['id'] == "backup") {
			echo "<h1>Database back-up</h1>";
			echo "<p>Ga naar <a href='http://www.one.com'>www.one.com</a> meld je aan en ga naar phpMyAdmin.</p>";
        }
        else if($_GET['id'] == "restore") {
        	echo "<h1>Database terugzetten</h1>";
			echo "<p>Ga naar <a href='http://www.one.com'>www.one.com</a> meld je aan en ga naar phpMyAdmin.</p>";
        }
    }
    else { ?>
    <h1>Database</h1>
    <div class="images">
        <a href="db.php?id=<?php echo "backup";?>" class="linkimg"><img src="../images/linkimages/Database_backup.png" />Back-up</a>
        <a href="db.php?id=<?php echo "restore";?>" class="linkimg"><img src="../images/linkimages/Database_restore.png" />Terugzetten</a>
        <br class="clearfloat" />
   	</div>
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
