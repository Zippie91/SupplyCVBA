<?php include('../Connections/connect_supply.php'); ?>
<?php session_start() ?>

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
<script src="../lib/jquery.validate.js"></script>
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
  	    <li><a href="../main/prodshop.php" title="Producten"><span>Producten</span></a></li>
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
    <h1>Uw artikelen</h1>
    <?php include("../includes/scripts/shopcart/Shopcartfunc.php"); ?>
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

$("#orderform").validate({
    rules: {
        naam: {
            required: true
        },
        straat: {
            required: true
        },
        nummer: {
            required: true
        },
        postcode: {
            required: true
        },
        plaats: {
            required: true
        },
        email: {
            required: true,
            email: true
        },
        tel: {
            required: true
        }
    },
    messages: {
        naam: {
            required: "Vul uw (firma)naam in"
        },
        straat: {
            required: "Vul uw straatnaam in"
        },
        nummer: {
            required: "Vul uw huisnr. in"
        },
        postcode: {
            required: "Vul uw postcode in"
        },
        plaats: {
            required: "Vul uw plaatsnaam in"
        },
        email: {
            required: "Vul uw emailadres in",
            email: "Gelieve een correct emailadres in te geven"
        },
        tel: {
            required: "Vul uw telefoonnr. in"
        }
    }
});

</script>
</body>
<!-- InstanceEnd --></html>