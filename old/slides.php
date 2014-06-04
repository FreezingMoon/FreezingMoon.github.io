<?php
require_once("config.php");
function GenerateSlides($numberSlides = 6) {
	$out = '<div id="slides" style="margin-bottom: 15px; height: 240px;">
	<script type="text/javascript">
		$(document).ready(function(){
			var s = new Slides({slides: ' . $numberSlides . ', timeout: 3000, elementType: "#", slideElement: "slides", imageElement: "image", buttonElement: "button", on: {src: "/images/navigation/on.png"}, off: {src: "/images/navigation/off.png"} });
			s.init();
		});
	</script>
';
	if(1==1)
		$result = mysql_query("(SELECT 'tutorials' AS `Type`, `ID`, `Title`, `Date` FROM `fm_tutorials` ORDER BY `Date` DESC LIMIT $numberSlides) UNION (SELECT 'board' AS `Type`, `ID`, `Title`, `Date` FROM `fm_board` ORDER BY `Date` DESC LIMIT $numberSlides) ORDER BY `Date` DESC LIMIT $numberSlides");
	else
		$result = mysql_query("SELECT '$pageType' AS `Type`, `ID`, `Title`, `Date` FROM `fm_$pageType` ORDER BY RAND() DESC LIMIT $numberSlides");
	for ($i = 1; $i <= $numberSlides; $i++) {
		$row = mysql_fetch_row($result);
		$out .= "\t<div id=\"image$i\" style=\"z-index: 4; position: absolute;\">
		<a href=\"/{$row[0]}/" . URLPageTitle($row[2]) . "\">
			<img src=\"/{$row[0]}/banners/{$row[1]}.jpg\" alt=\"{$row[2]}\" title=\"{$row[2]} | {$row[3]}\">
		</a>\n\t</div>\n";
	}
	$out .= "</div>\n<table style=\"width:100%;\" class=\"center\">\n\t<tr>\n";
	for ($i = 1; $i <= $numberSlides; $i++) {
		$out .= "\t\t<td><img id=\"button$i\" src=\"/images/navigation/off.png\" alt=\"button\"></td>\n";
	}
	$out .= "\t</tr>\n</table>\n";
	return $out;
}
?>
