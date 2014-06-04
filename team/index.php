<?php $page_title = "Freezing Moon - Team Members";
require_once("../config.php");
include("../header.php"); ?>
<script>
function missing(source){
    source.src = 'snowman.jpg';
    source.onerror = '';
    return true;
}</script>
<?php
function display_profile($profile_id) {
	$query = "SELECT * FROM fm_team WHERE id='$profile_id'";
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result)) {
		echo '<a id="' . urlencode($row['username']) . '"></a>';
	echo "<div class='segment'>";
		echo '<table><tr><td style="width: 200px; text-align: right;"><i>nickname</i><br>';
		echo '<b>' . $row['username'] . '</b><br><br>';
		echo '<i>name</i><br>';
		echo '<b>' . $row['name'] . '</b><br><br>';
		echo '<i>location</i><br>';
		echo '<b>' . $row['location'] . '</b>';
		echo '</td><td style="padding: 0px 10px 0px 10px;" style="width: 200px;"><img src="../team/pics/' . rawurlencode($row['username']) . '.jpg" title="' . $row['username'] . '" onerror="missing(this);"></td>';
		echo '<td style="width: 480px;"><span style="text-align:justify; display:block;">' . $row['info'] . '</span><br><center>';
		if ($row['deviantart'] != NULL) echo '<a href="http://' . $row['deviantart'] . '.deviantart.com" target="_blank" title="deviantart profile"><img src="../images/deviantart.png"></a>';
		if ($row['facebook'] != NULL) echo '<a href="http://facebook.com/' . $row['facebook'] . '" target="_blank" title="facebook profile"><img src="../images/facebook.png"></a>';
		if ($row['twitter'] != NULL) echo '<a href="http://twitter.com/' . $row['twitter'] . '" target="_blank" title="twitter profile"><img src="../images/twitter.png"></a>';
		if ($row['google'] != NULL) echo '<a href="http://plus.google.com/' . $row['google'] . '" target="_blank" title="google+ profile"><img src="../images/google.png"></a>';
		if ($row['youtube'] != NULL) echo '<a href="http://www.youtube.com/user/' . $row['youtube'] . '" target="_blank" title="YouTube profile"><img src="../images/YouTube.png"></a>'; 
		echo '</center></td></tr></table>';
	echo "</div>";
	}
}

$profile_id = 1;
$team = array(1, 2, 8, 7, 6, 9, 3, 5, 4);

foreach ($team as $profile_id)
	display_profile($profile_id);
?>
</body></html>






