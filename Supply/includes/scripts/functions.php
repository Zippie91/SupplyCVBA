<?php 
date_default_timezone_set("Europe/Brussels");

function BuildHTMLEmail() {
    $email = "  <html>
                    <body style='        background-color: #fff; 
                            			margin: 0; 
                                        padding: 0;
                                        font-family: 'Helvetica Neue', Arial, Helvetica, Geneva, sans-serif;'>

                    	<table cellpadding='0' cellspacing='0' width='540px' align='center' style='border-collapse: collapse;'>
                    		<tr>
                    			<td colspan='3' height= '10px'></td>
                    		</tr>
                    		<tr style='	color: #e7cba3;
                    					font-size: 12px;'>
                    			<td width='5px' style='	border-radius:6px 0px 0px 0px;
                    									-moz-border-radius: 6px 0px 0px 0px; 
                    									-webkit-border-radius:6px 0px 0px 0px; 
                    									-webkit-font-smoothing: antialiased; 
                    									background-color: #043948;
                                                        width: 5px;'>&nbsp;</td>
                    			<td height='5px' style='background-color: #043948;
                    									text-align: right;'>
                    				<a 	style='	font-weight: bold; 
                    							color: #e7cba3; 
                    							text-decoration: none;' 
                    					href='http://www.supplycvba.be'>Webversie</a>
                    				</div>
                    			</td>
                    			<td width='5px' style='	border-radius:0px 6px 0px 0px;
                    									-moz-border-radius: 0px 6px 0px 0px; 
                    									-webkit-border-radius:0px 6px 0px 0px; 
                    									-webkit-font-smoothing: antialiased; 
                    									background-color: #043948;
                                                        width: 5px;'>&nbsp;</td>
                    		</tr>
                    		<tr>
                    			<td colspan='3' height='67px'>
                    				<div style='	background-color:#0093D3; '>
                    					<a href='http://www.supplycvba.be' style='width: 540px; height: 67px;'><img src='http://www.supplycvba.be/images/emailheader/header_new2.png' width='540px' height='67px' style='border: none;' alt='Supply CVBA'/></a>
                    				</div>
                    			</td
                    		</tr>
                    		<tr>
                    			<td width='5px'>&nbsp;</td>
                    			<td class='emailboven'>
                        		    <h1>Bedankt voor uw bestelling</h1>";
    
                                    
                                    
    $email .= "                      <p>Hier komt tekst met meer informatie</p>
                    			</td>
                    			<td width='5px'>&nbsp;</td>
                    		</tr>
                    		<tr height='5px'>			
                    			<td width='5px'>&nbsp;</td>
                    			<td class='ordertable'>
                                    <div style='text-align: center;'>";
    $email .= $_POST['message'];
    $email .="                      </div>
                    			</td>
                    			<td width='5px'>&nbsp;</td>
                    		</tr>
                    		<tr>
                    			<td width='5px'></td>
                    			<td class='emailonder'>&nbsp;</td>
                    			<td width='5px'>&nbsp;</td>
                    		</tr>
                    		<tr>
                    			<td width='5px' style='	border-radius:0px 0px 0px 6px;
                    									-moz-border-radius: 0px 0px 0px 6px; 
                    									-webkit-border-radius:0px 0px 0px 6px; 
                    									-webkit-font-smoothing: antialiased; 
                    									background-color: #043948;'>&nbsp;</td>
                    			<td height='5px' style='	background-color: #043948;
                    										color: #e2e2e2;
                    										font-size: 12px; 
                    										line-height: 15px; 
                    										color: #e2e2e2;'>
                    				<div style='float: left;'>Copyright &#169; Supply CVBA</div>
                    				<div style='float: right; 
                    							text-align: right;'>Datum bestelling: " . date("d-m-Y H:i:s") ."</div>
                    			</td>
                    			<td width='5px' style='	border-radius:0px 0px 6px 0px;
                    									-moz-border-radius: 0px 0px 6px 0px; 
                    									-webkit-border-radius:0px 0px 6px 0px; 
                    									-webkit-font-smoothing: antialiased; 
                    									background-color: #043948;'>&nbsp;</td>
                    		</tr>
                    	</table>
                    </body>
                </html>";

    return $email;
}

function WriteOrderDatabase() {
    require_once("../../../Connections/connect_supply.php");
    
    if (!function_exists("GetSQLValueString")) {
        function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
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
    
    mysql_select_db($database_connect_supply, $connect_supply);
}
/*
function GetClientID() {
    
    require_once("../../../Connections/connect_supply.php");
    
    mysql_select_db($database_connect_supply, $connect_supply);
    $query_Klanten = "SELECT * FROM klanten";
    $Klanten = mysql_query($query_Klanten, $connect_supply) or die(mysql_error());
    $row_Klanten = mysql_fetch_assoc($Klanten);
    
    $foundItem = false;
    
    do {
        $btw_klant = $_POST['btw'];
        $email_Klant = $_POST['email'];
        
        if($btw_klant == $row_Klanten) {
            echo "BTW gevonden";
            if($email_Klanten == $row_Klanten['Email']) {
                echo "juiste klant gevonden! " . $row_Klanten['klant_id'] . " " . $row_Klanten['Naam'];
                $klantID = $row_Klanten['klant_id'];
                $foundItem = true;
            }
        }
    
    } while ($row_Klanten = mysql_fetch_assoc($Klanten));
    
    if($foundItem == false) {
        echo "Inserting...";
    }
    else {
        echo "Gevonden!";
    }
    
    mysql_free_result($Klanten);
    return $klantID;
    */
?>