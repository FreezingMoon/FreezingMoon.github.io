<?php
$style = "
.banner div {
	display: none;
	position: absolute;
	text-align: center;
	width: 100%;
	top: -10px;
	padding: 0px;
	margin: 0px;
}
.banner:hover div {
	display: block;
}";
//need class for nice button
$tutorials = scandir("../tutorials");
//display specific tutorial
if(isset($_GET['view'])) {
	$tut = str_replace('_', ' ', $view);
	$page_title = "Freezing Moon - Tutorials - " . $tut;
	include("../header.php");
	echo "<div class='segment'>";
	//$dates = "Added date&#10;Updated date";
	echo "<div class='banner'><a href='/tutorials/#" . $view . "'><img src='" . $tut . "/banner.jpg' title='" . $tut . "' class='rounded'></a></div>";
	//$size = 32; // Size, in pixels

	//TODO: fix relative image links
	echo "</div><div class='segment'>";
	include($tut . "/index.html");
	echo "</div>";

	//	$gravatar = "<img src='http://www.gravatar.com/avatar/" . md5(strtolower($row2["email"])) . "?s=" . $size . "'>";
	//	echo "<div><a href='" . $row2["website"] . "' target='_blank'><h1>" . $gravatar . $row2["username"] . "</h1></a>";

	//echo "</div></div>" . separate_segment() . $row[3] . separate_segment();
}
//list all tutorials
else {
	$page_title = "Freezing Moon - Tutorials";
	include("../header.php");

	// Display results

	natsort($tutorials);
	foreach($tutorials as $tut) {
		if($tut == "." || $tut == ".." || $tut == is_file($tut)) continue;
		$URL = str_replace(' ', '_', $tut);
		$tut = str_replace(' ', '%20', $tut);

		echo "<div class='segment'>";
		echo "<div class='banner'><a href='?view=" . $URL . "'><img src='" . $tut . "/banner.jpg' title='" . $tut . " by name &#10;Added date ' class='rounded'></a></div>";
		echo "</div>";
	}
}
echo "<div class='segment'>";
include("../disqus.php"); ?>
</div></body></html>
