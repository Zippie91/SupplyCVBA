<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connect_supply = "supplycvba.be.mysql";
$database_connect_supply = "supplycvba_be";
$username_connect_supply = "supplycvba_be";
$password_connect_supply = "Su12Cv34";
$connect_supply = mysql_connect($hostname_connect_supply, $username_connect_supply, $password_connect_supply) or trigger_error(mysql_error(),E_USER_ERROR);
?>