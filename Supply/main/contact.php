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
  	    <li><a href="../main/contact.php" title="Contact" class="current"><span>Contact</span></a></li>
      </ul>
  	<!-- InstanceEndEditable --><!-- end .main_menu --></div>
    <div class="shopcart">
    	<a href="shoppingcart.php"></a>
    </div>
  <!-- end .nav --></div>
  <div class="sidebar">
	<!-- InstanceBeginEditable name="sidebar" -->
    
  <!-- InstanceEndEditable -->
  <!-- end .sidebar --></div>
  <div class="content">
  <!-- InstanceBeginEditable name="Content" -->
    <h2>Supply CVBA</h2>
    <p>
	<div class="contactinfo">
		Matteottistraat 65<br /> 
		2845 Niel<br />
		België <br />
		<br />
		Tel.: +32(0)3 888 68 61<br />
		GSM:  +32(0)483 08 33 22
		
	</div>
	<div>
		<iframe width="325" height="280" frameborder="0" src="http://www.bing.com/maps/embed/viewer.aspx?v=3&amp;cp=51.114288~4.329966&amp;lvl=16&amp;w=325&amp;h=280&amp;sty=r&amp;typ=d&amp;pp=~~51.114267~4.329981&amp;ps=&amp;dir=0&amp;mkt=en-us&amp;src=SHELL&amp;form=BMEMJS"></iframe>
		<div style="margin: 12px 0 0 0;">
			<a target="_blank" href="http://www.bing.com/maps/?cp=51.114288~4.329966&amp;sty=r&amp;lvl=16&amp;where1=51.114267,4.329981&amp;mm_embed=map">Grotere kaart bekijken</a>
			&nbsp; |&nbsp; 
			<a target="_blank" href="http://www.bing.com/maps/?cp=51.114288~4.329966&amp;sty=r&amp;lvl=16&amp;rtp=~pos.51.114267_4.329981__&amp;mm_embed=dir">Routebeschrijving</a>
		</div>
	</div>
	<div>
		<form id="commentform" action="http://www.supplycvba.be/cgi-bin/FormMail.pl" method="POST">
			<?php include("../includes/userinfo2.php"); ?>
		</form>
	</div>
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

$("#commentform").validate({
    rules: {
        achternaam: {
            required: true
        },
        email: {
            required: true,
            email: true
        },
        opmerking: {
            required: true
        }
    },
    messages: {
        achternaam: "Gelieve uw naam in te vullen",
        email: {
            required: "Gelieve uw emailadres in te vullen",
            email: "Gelieve een correct emailadres in te geven"
        },
        opmerking: "Gelieve een vraag of opmerking in te geven"
    }   
});

</script>
</body>
<!-- InstanceEnd --></html>
