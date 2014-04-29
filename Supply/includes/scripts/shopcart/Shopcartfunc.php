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

if(isset($_GET["submit"])) {
	if(isset($_SESSION['cart'])) {
		$total_list = $_SESSION['cart'];
	}
			
	$unused_keys = array_keys($_POST, '0');
	$prod_list = $_POST;
	foreach($unused_keys as $key => $value) {
		unset($prod_list[$value]);
	}
			
	$cur_cat = $prod_list["cat_id"];
	unset($prod_list["cat_id"]);
			
	if(isset($total_list)) {
		foreach($prod_list as $key => $val) {
			if(array_key_exists($key, $total_list)) {
				$total_list[$key] += $prod_list[$key];
			}
			else {
				$total_list[$key] = $prod_list[$key];
			}
		}
	}
	else {
		$total_list = $prod_list;
	}

	uksort($total_list, "strnatcmp");

	$_SESSION['cart'] = $total_list;
			
	ShowCart();
}
else {
	if(isset($_SESSION['cart'])) {
		uksort($_SESSION['cart'], "strnatcmp");
				
		ShowCart();
	}
    else { ?>
		<p>U hebt nog geen producten klaarstaan voor bestelling!<br />Klik <a href="prodshop.php">hier</a> of op een van de categorie&euml;n aan de linkerzijde<br />om uw bestelling te plaatsen.</p>
    <?php } 
}

function ShowCart() {
    $connect_supply = ConnectDatabase();
     
    $arraykeys = array_keys($_SESSION['cart']);
	
    $emailMessage = "<html><body>";
    
    $message1 = "
    <table style='text-align: center;margin: 0 auto;width: 540px; border-collapse: collapse'><thead><tr style='background: rgb(0,151,166);color: #FFFFFF;margin: 0 auto;padding: 5px 0;font-weight: bold;white-space: nowrap;'><th>Categorie</th><th>Naam</th><th>Plaats</th><th>Kleur</th><th>Aantal</th></tr></thead><tbody> ";
    
    $pageMessage = $message1;
    
	for($i = 0; $i < count($arraykeys); $i++) {
		$key = $arraykeys[$i];
			
		unset($piece);
		$piece = explode("_", $key);

		$color = $piece[1];
        $prodid = $piece[0];
        
        $product = GetProduct($piece[0]);
        $categorie = GetCategorie($product['prod_categorie']);
        $kleur = GetColor(CalcColor($color, $product['prod_kleur']));
        
        foreach($_SESSION['cart'] as $cartkey => $cartvalue) {
            if($key == $cartkey)
                $prod_aantal = $cartvalue;
        }
        
        if($i % 2 == 0) {
            $message2 = "<tr style='background-color: #ebf2fa;'>";
        }
        else {
            $message2 = "<tr style='background-color: #d7e7ff;'>";
        }
        
        $message2 .= "<td>" . $categorie['cat_soort'] . " " . $categorie['cat_beschrijving'] . " " . $categorie['cat_tandkies'] . "</td>";
        $message2 .= "<td>" . $product['prod_naam'] . "</td>"; 
        $message2 .= "<td>" . $product['prod_plaats'] . "</td>";
        $message2 .= "<td>" . $kleur['kleur_naam'] . "</td>";
        $message2 .= "<td>" . $prod_aantal . "</td>";
        $message2 .= "</tr>";

        $pageMessage .= $message2;
	}
    
    $message3 = "
        </tbody>
    </table>";

    $pageMessage .= $message3;

    $emailMessage .= $pageMessage;
    $emailMessage .= "</body></html>";
    
    echo $pageMessage; ?>
    
    <form id="orderform" method="post" action="http://www.supplycvba.be/main/bedankt.php">
        <?php include("../includes/userinfo.php"); ?>
        <input class="submitbutton" type="submit" value="Bestellen" />
        <input type="hidden" name="recipient" value="supply_info@supplycvba.be" />
        <input type="hidden" name="subject" value="Bestelling test" />
        <input type="hidden" name="message" value="<?php echo $pageMessage; ?>" />
    </form>
<?php }

function GetProduct ($prod_id) {
    $connect_supply = ConnectDatabase();

    $prod_var_ProductData = "0";
    if (isset($prod_id)) {
      	$prod_var_ProductData = $prod_id;
	}
    
	$query_ProductData = sprintf("SELECT * FROM products WHERE products.prod_id = %s", GetSQLValueString($prod_var_ProductData, "int"));
	$ProductData = mysql_query($query_ProductData, $connect_supply) or die(mysql_error());
	$row_ProductData = mysql_fetch_assoc($ProductData);
    $totalRows_ProductData = mysql_num_rows($ProductData);

    mysql_free_result($ProductData);
    
    return $row_ProductData;
}

function GetCategorie ($cat_id) {
    $connect_supply = ConnectDatabase();
    
    $cat_var_CategorieData = "0";
    if (isset($cat_id)) {
  		$cat_var_CategorieData = $cat_id;
	}

	$query_CategorieData = sprintf("SELECT * FROM categories WHERE categories.cat_id = %s", GetSQLValueString($cat_var_CategorieData, "int"));
	$CategorieData = mysql_query($query_CategorieData, $connect_supply) or die(mysql_error());
	$row_CategorieData = mysql_fetch_assoc($CategorieData);
    $totalRows_CategorieData = mysql_num_rows($CategorieData);
    
    mysql_free_result($CategorieData);
    
    return $row_CategorieData;
}

function CalcColor($color, $prodkleur) {
    switch($prodkleur) {
        case 1:
            return $color;
            break;
        case 2:
            if($color == 7) {
                return 13;
            }
            else if($color == 6) {
                return 10;
            }
            else {
                return $color;
            }
            break;
        case 3:
            if($color > 6) {
                return ($color + 1);
            }
            else {
                return $color;
            }
            break;
        case 4:
            if($color > 5) {
                return ($color + 2);
            }
            else {
                return ($color + 1);
            }
            break;
        case 5:
            return ($color + 18);
            break;
    } 
}

function GetColor($kleur_id) {
    $connect_supply = ConnectDatabase();
    
    $kleur_var_KleurData = "0";
    if(isset($kleur_id)) {
        $kleur_var_KleurData = $kleur_id;
    }
    
    $query_KleurData = sprintf("SELECT * FROM kleur WHERE kleur.kleur_id = %s", GetSQLValueString($kleur_var_KleurData, "int"));
	$KleurData = mysql_query($query_KleurData, $connect_supply) or die(mysql_error());
	$row_KleurData = mysql_fetch_assoc($KleurData);
    $totalRows_KleurData = mysql_num_rows($KleurData);
    
    mysql_free_result($KleurData);
    
    return $row_KleurData;
}

function ConnectDatabase () {
    $hostname_connect_supply = "supplycvba.be.mysql";
    $database_connect_supply = "supplycvba_be";
    $username_connect_supply = "supplycvba_be";
    $password_connect_supply = "Su12Cv34";
    $connect_supply = mysql_connect($hostname_connect_supply, $username_connect_supply, $password_connect_supply) or trigger_error(mysql_error(),E_USER_ERROR);
    
    mysql_select_db($database_connect_supply, $connect_supply);
    
    return $connect_supply;
}
?>