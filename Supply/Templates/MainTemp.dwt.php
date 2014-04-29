<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!-- TemplateBeginEditable name="doctitle" -->
<title>Supply CVBA</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
<meta name="keywords" content="
Supply, Niel, tanden, tandlabo, tandtechnicus, groothandel tanden, tandprothese, tandmateriaal, porselein, acryl, tandchirurg, [Dentaaltechnische bedrijven]" >
<meta name="description" content="GG Supply in Niel is uw specialist groothandel in tanden uit acryl en porselein prothese. Slijtvastheid en kwaliteit zijn onze troeven voor u de juiste service!" >
<link href="../CSS/main_2col_hdrftr.css" rel="stylesheet" type="text/css">
<link rel="icon" type="image/x-icon" href="../images/favicon.ico">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="../includes/scripts/stickyMojo.js"></script>
</head>

<body>
<div class="container">
  <div class="header">
  	<a href="../main/index.php" class="logoS"></a>
    <img src="../images/headerbody/Enta_Logo.gif" class="logoE"/>
  <!-- end .header --></div>
  <div class="nav">
  	<div class="main_menu"><!-- TemplateBeginEditable name="Edit current class" -->
  	  <ul class="bluebar">
  	  	<li><a href="../main/index.php" title="Home" class="current"><span>Home</span></a></li>
  	    <li><a href="../main/prodshop.php" title="Producten"><span>Producten</span></a></li>
  	    <li><a href="../main/contact.php" title="Contact"><span>Contact</span></a></li>
      </ul>
  	<!-- TemplateEndEditable --><!-- end .main_menu --></div>
    <div class="shopcart">
    	<a href="../main/shoppingcart.php"></a>
    </div>
  <!-- end .nav --></div>
  <div class="sidebar">
	<!-- TemplateBeginEditable name="sidebar" -->
    <div class="subsidebar">
      <?php include("../includes/catalogus.php"); ?>
    </div>
  <!-- TemplateEndEditable -->
  <!-- end .sidebar --></div>
  <div class="content">
  <!-- TemplateBeginEditable name="Content" -->
    <h1>Welkom!</h1>
    <p>Content Hier -></p>
  <!-- TemplateEndEditable -->
  <!-- end .content --></div>
  <div class="footer">
  	<p>footer</p>
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
</html>
