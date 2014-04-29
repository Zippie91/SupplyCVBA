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

$maxRows_CEMol = 10;
$pageNum_CEMol = 0;
if (isset($_GET['pageNum_CEMol'])) {
  $pageNum_CEMol = $_GET['pageNum_CEMol'];
}
$startRow_CEMol = $pageNum_CEMol * $maxRows_CEMol;

mysql_select_db($database_connect_supply, $connect_supply);
$query_CEMol = "SELECT * FROM categories WHERE categories.cat_soort ='CERAM'  AND categories.cat_tandkies = 'Molaren' AND categories.cat_actief = '1' ORDER BY categories.cat_beschrijving ASC";
$query_limit_CEMol = sprintf("%s LIMIT %d, %d", $query_CEMol, $startRow_CEMol, $maxRows_CEMol);
$CEMol = mysql_query($query_limit_CEMol, $connect_supply) or die(mysql_error());
$row_CEMol = mysql_fetch_assoc($CEMol);

if (isset($_GET['totalRows_CEMol'])) {
  $totalRows_CEMol = $_GET['totalRows_CEMol'];
} else {
  $all_CEMol = mysql_query($query_CEMol);
  $totalRows_CEMol = mysql_num_rows($all_CEMol);
}
$totalPages_CEMol = ceil($totalRows_CEMol/$maxRows_CEMol)-1;

$maxRows_CETand = 10;
$pageNum_CETand = 0;
if (isset($_GET['pageNum_CETand'])) {
  $pageNum_CETand = $_GET['pageNum_CETand'];
}
$startRow_CETand = $pageNum_CETand * $maxRows_CETand;

mysql_select_db($database_connect_supply, $connect_supply);
$query_CETand = "SELECT * FROM categories WHERE categories.cat_soort = 'CERAM' AND categories.cat_tandkies = 'Tanden'  AND categories.cat_actief = '1' ORDER BY categories.cat_beschrijving ASC";
$query_limit_CETand = sprintf("%s LIMIT %d, %d", $query_CETand, $startRow_CETand, $maxRows_CETand);
$CETand = mysql_query($query_limit_CETand, $connect_supply) or die(mysql_error());
$row_CETand = mysql_fetch_assoc($CETand);

if (isset($_GET['totalRows_CETand'])) {
  $totalRows_CETand = $_GET['totalRows_CETand'];
} else {
  $all_CETand = mysql_query($query_CETand);
  $totalRows_CETand = mysql_num_rows($all_CETand);
}
$totalPages_CETand = ceil($totalRows_CETand/$maxRows_CETand)-1;

$maxRows_CRMol = 10;
$pageNum_CRMol = 0;
if (isset($_GET['pageNum_CRMol'])) {
  $pageNum_CRMol = $_GET['pageNum_CRMol'];
}
$startRow_CRMol = $pageNum_CRMol * $maxRows_CRMol;

mysql_select_db($database_connect_supply, $connect_supply);
$query_CRMol = "SELECT * FROM categories WHERE categories.cat_soort = 'ACRYL' AND categories.cat_tandkies = 'Molaren' AND categories.cat_actief = '1' ORDER BY categories.cat_beschrijving ASC";
$query_limit_CRMol = sprintf("%s LIMIT %d, %d", $query_CRMol, $startRow_CRMol, $maxRows_CRMol);
$CRMol = mysql_query($query_limit_CRMol, $connect_supply) or die(mysql_error());
$row_CRMol = mysql_fetch_assoc($CRMol);

if (isset($_GET['totalRows_CRMol'])) {
  $totalRows_CRMol = $_GET['totalRows_CRMol'];
} else {
  $all_CRMol = mysql_query($query_CRMol);
  $totalRows_CRMol = mysql_num_rows($all_CRMol);
}
$totalPages_CRMol = ceil($totalRows_CRMol/$maxRows_CRMol)-1;

$maxRows_CRTand = 10;
$pageNum_CRTand = 0;
if (isset($_GET['pageNum_CRTand'])) {
  $pageNum_CRTand = $_GET['pageNum_CRTand'];
}
$startRow_CRTand = $pageNum_CRTand * $maxRows_CRTand;

mysql_select_db($database_connect_supply, $connect_supply);
$query_CRTand = "SELECT * FROM categories WHERE categories.cat_soort = 'ACRYL' AND categories.cat_tandkies = 'Tanden' AND categories.cat_actief = '1' ORDER BY categories.cat_beschrijving ASC";
$query_limit_CRTand = sprintf("%s LIMIT %d, %d", $query_CRTand, $startRow_CRTand, $maxRows_CRTand);
$CRTand = mysql_query($query_limit_CRTand, $connect_supply) or die(mysql_error());
$row_CRTand = mysql_fetch_assoc($CRTand);

if (isset($_GET['totalRows_CRTand'])) {
  $totalRows_CRTand = $_GET['totalRows_CRTand'];
} else {
  $all_CRTand = mysql_query($query_CRTand);
  $totalRows_CRTand = mysql_num_rows($all_CRTand);
}
$totalPages_CRTand = ceil($totalRows_CRTand/$maxRows_CRTand)-1;
?>

<h3>Categorieën</h3>
<h4>CERAM</h4>
<h5>Molaren</h5>
<ul>
    <?php do { ?>
	<li><a href="../main/prodshop.php?recordID=<?php echo $row_CEMol['cat_id']; ?>"><?php echo $row_CEMol['cat_beschrijving']; ?></a></li>
      <?php } while ($row_CEMol = mysql_fetch_assoc($CEMol)); ?>
</ul>
<h5>Tanden</h5>
<ul>
	<?php do { ?>
	  <li><a href="../main/prodshop.php?recordID=<?php echo $row_CETand['cat_id']; ?>"><?php echo $row_CETand['cat_beschrijving']; ?></a></li>
	  <?php } while ($row_CETand = mysql_fetch_assoc($CETand)); ?>
</ul>

<h4>ACRYL</h4>
<h5>Molaren</h5>
<ul>
	<?php do { ?>
	  <li><a href="../main/prodshop.php?recordID=<?php echo $row_CRMol['cat_id']; ?>"><?php echo $row_CRMol['cat_beschrijving']; ?></a></li>
	  <?php } while ($row_CRMol = mysql_fetch_assoc($CRMol)); ?>
</ul>
<h5>Tanden</h5>
<ul>
	<?php do { ?>
	  <li><a href="../main/prodshop.php?recordID=<?php echo $row_CRTand['cat_id']; ?>"><?php echo $row_CRTand['cat_beschrijving']; ?></a></li>
	  <?php } while ($row_CRTand = mysql_fetch_assoc($CRTand)); ?>
</ul>

<?php
mysql_free_result($CEMol);
mysql_free_result($CETand);
mysql_free_result($CRMol);
mysql_free_result($CRTand);
?>