<?php
$i = 0;
$col = 0;
$row = 0;

switch($_GET["recordID"]) {
	case 1:
		include("../includes/forms/form1.php");
		break;
	case 2:
		include("../includes/forms/form2.php");
		break;
	case 3:
		include("../includes/forms/form3.php");
		break;
	case 4:
		include("../includes/forms/form4.php");
		break;
	case 5:
		include("../includes/forms/form5.php");
		break;
	case 6:
	case 7:
		include("forms/formkleur3.php");
		break;
	case 8:
	case 9:
		include("forms/formkleur1.php");
		break;
	case 10:
	case 12:
		include("forms/formkleur4.php");
		break;
	case 11:
		include("../includes/forms/form11.php");
		break;
}
?>