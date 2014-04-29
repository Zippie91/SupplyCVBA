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
<link href="../CSS/AdminCSSMainSite.css" rel="stylesheet" type="text/css">
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
      <li><a href="tekst.php" class="current">Teksten</a></li>
      <li><a href="db.php">Database</a></li>
      <li><a href="stats.php">Statistieken</a></li>
    </ul>
  <!-- InstanceEndEditable --><!-- end .sidebar1 -->
  </div>
  <!-- InstanceBeginEditable name="Content" -->
  <div class="content">
    <h1>Teksten</h1>
    <p>Kies een plaats om aan te passen.</p>
    <h2>Home</h2>
    <div class="tekstdiv">
        <div class="sitecontainer">
            <div class="siteheader">
          	<a href="index.php" class="logoS"></a>
            <img src="../images/headerbody/Enta_Logo.gif" alt="Enta" class="logoE"/>
          <!-- end .header --></div>
          <div class="nav">
          	<div class="main_menu"><!-- InstanceBeginEditable name="Edit current class" -->
          	  <ul class="bluebar">
          	    <li><a href="" title="Home" class="current"><span>Home</span></a></li>
          	    <li><a href="" title="Producten"><span>Producten</span></a></li>
          	    <li><a href="" title="Contact"><span>Contact</span></a></li>
              </ul>
          	<!-- InstanceEndEditable --><!-- end .main_menu --></div>
            <div class="shopcart">
            	<a href=""></a>
            </div>
          <!-- end .nav --></div>
          <a href="">
          <div class="sitesidebar" title="Verander de zijbalk">
        	<!-- InstanceBeginEditable name="sidebar" -->
        	<div class="sitesubsidebar">
                <h3>Lanceringsactie</h3>
                <p>Wegens het opstarten van onze website willen wij met onze klanten deze lancering vieren!</p>
                <p>Geniet nu van <strong>10&#37;</strong> korting op al onze artikelen!<br />(enkel bij online bestellingen)</p>
            </div>
          <!-- InstanceEndEditable -->
          <!-- end .sidebar --></div>
          </a>
          <a href="" title="Verander de welkomsttekst">
          <div class="sitecontent">
          <!-- InstanceBeginEditable name="Content" -->
            <h1>Welkom bij Supply CVBA</h1>
            <p>Sinds 1990 werken wij samen met Enta (Pritidenta). Zij beschikken over een grote ervaring in productontwikkeling en de vervaardiging van porselein en acryl-prothese elementen.</p>
        	<p>Enta producten voldoen aan alle internationale standaarden en normen.</p>
        	<p>De A1 &ndash; D4 benaming correspondeert met de Vita kleuring. Dit is bedoeld als ori&euml;ntatie, niet als vergelijking. Vita is geen geregistreed merk van Enta (Pritidenta).</p>
        	<p>Onze tanden en kiezen voldoen aan de hoogste eisen wat betreft sterkte, slijtvastheid, anatomische vormgeving en natuurgetrouwe karakterisering en kleur!</p>
        
          <!-- InstanceEndEditable -->
          <!-- end .content --></div>
          </a>
          <div class="sitefooter">
          	<div class="fltlft">
                <p>Copyright &#169; Supply CVBA, Raf Smits</p>
            </div>
            <div class="sitefootercontact">
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
    </div>
    <h2>Contact</h2>
    <div class="tekstdiv">
        <div class="sitecontainer">
          <div class="siteheader">
          	<a href="index.php" class="logoS"></a>
            <img src="../images/headerbody/Enta_Logo.gif" alt="Enta" class="logoE"/>
          <!-- end .header --></div>
          <div class="nav">
          	<div class="main_menu"><!-- InstanceBeginEditable name="Edit current class" -->
          	  <ul class="bluebar">
          	    <li><a href="" title="Home"><span>Home</span></a></li>
          	    <li><a href="" title="Producten"><span>Producten</span></a></li>
          	    <li><a href="" title="Contact" class="current"><span>Contact</span></a></li>
              </ul>
          	<!-- InstanceEndEditable --><!-- end .main_menu --></div>
            <div class="shopcart">
            	<a href=""></a>
            </div>
          <!-- end .nav --></div>
          <div class="sitesidebar">
        	<!-- InstanceBeginEditable name="sidebar" -->
            
          <!-- InstanceEndEditable -->
          <!-- end .sidebar --></div>
          <div class="sitecontent">
          <!-- InstanceBeginEditable name="Content" -->
            <a href="" title="Verander de contactgegevens">
            <h2>Supply CVBA</h2>
            <p>
        	<div class="sitecontactinfo">
        		Matteottistraat 65<br /> 
        		2845 Niel<br />
        		België <br />
        		<br />
        		Tel.: +32(0)3 888 68 61<br />
        		GSM:  +32(0)483 08 33 22
        	</div>
        	</a>
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
          <div class="sitefooter">
            <div class="fltlft">
          	    <p>Copyright &#169; Supply CVBA, Raf Smits</p>
            </div>
            <div class="sitefootercontact">
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
