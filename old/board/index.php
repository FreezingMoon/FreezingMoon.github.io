<?php
require_once("../global.php");
$page_title = "Freezing Moon - Board";
include("../header.php");
$query = "SELECT * FROM fm_bugs";
$result = mysql_query($query);
echo $start_div;
?>

<div>
<img src="/images/coming soon.jpg">
</div>

<?php echo $end_div . $the_end; ?>
