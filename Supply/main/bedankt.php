<?php
session_start();
include('../includes/scripts/functions (2).php');

/*
if(isset($_POST['remember'])) {
    $verval = 60 * 60 * 24 * 30; 
    
    setcookie("naam", $_POST['naam'], time() + $verval);
    setcookie("btw", $_POST['btw'], time() + $verval);
    setcookie("straat", $_POST['straat'], time() + $verval);
    setcookie("nummer", $_POST['nummer'], time() + $verval);
    setcookie("bus", $_POST['bus'], time() + $verval);
    setcookie("postcode", $_POST['postcode'], time() + $verval);
    setcookie("plaats", $_POST['plaats'], time() + $verval);
    setcookie("email", $_POST['email'], time() + $verval);
    
    print_r($_COOKIE);
}*/
if(isset($_POST['email'])) {
   
    $to =  strip_tags($_POST['email']);
    
	$subject = 'Bestelling bij Supply CVBA';
    
	$headers = "From: " . strip_tags($_POST['recipient']) . "\r\n";
	$headers .= "Reply-To: ". strip_tags($_POST['recipient']) . "\r\n";
    $headers .= "Cc: " . strip_tags($_POST['recipient']) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
    
    //GetClientID();
    
    $message = BuildHTMLEmail();
    
    mail($to, $subject, $message, $headers);
    
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    session_destroy();
    
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
    
  <!-- InstanceEndEditable -->
  <!-- end .sidebar --></div>
  <div class="content">
  <!-- InstanceBeginEditable name="Content" -->
    <h3>Uw bestelling is verzonden.</h3>
    <p>U zal een email ontvangen met de informatie van uw bestelling. <br />
    Als u de email niet heeft ontvangen, kijk dan bij uw spamfolder of <br />
    neem <a href="http://www.supplycvba.be/main/contact.php" >hier</a> contact op met ons via het formulier  Bedankt!</p>
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
<?php } ?>