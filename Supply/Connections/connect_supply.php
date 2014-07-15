<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connect_supply = "Enter hostname here";
$database_connect_supply = "Enter database here";
$username_connect_supply = "Enter user name here";
$password_connect_supply = "Enter password here";
$connect_supply = mysql_connect($hostname_connect_supply, $username_connect_supply, $password_connect_supply) or trigger_error(mysql_error(),E_USER_ERROR);
?>
