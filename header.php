<!DOCTYPE html>
<!--
____ ____ ____ ____ ___  _ _  _ ____    _  _ ____ ____ _  _ 
|___ |__/ |___ |___   /  | |\ | | __    |\/| |  | |  | |\ | 
|    |  \ |___ |___  /__ | | \| |__]    |  | |__| |__| | \| 

-->
<html>
<head>
<!--set page title-->
<title><?php
if (isset($page_title)) {
	echo $page_title;
}
else {
	echo "FreezingMoon - Open Source Game Development";
}?></title>
<link rel="stylesheet" href="/stylesheet.css">
<?php
if (isset($style)) {
	echo "<style>$style</style>";
}
if (isset($stylesheet)) {
	echo "<link rel='stylesheet' href='$stylesheet'>";
}?>
<!--flattr.com-->
<script type="text/javascript" src="http://api.flattr.com/js/0.6/load.js?mode=auto"></script>
<!--jquery-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" src="http://freezingmoon.org/js/slides-min.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="google-site-verification" content="GR9UdKhkKHHvF6HAg9TlDWxWBXSDJVGCaIOHoKf6nxQ">
<meta name="description" content="Open Source Game Development">
<meta name="keywords" content="foundation, free, foss, games, blender, 3d, animation, tutorials, multiplayer, online, fun, open source">
<meta name="author" content="Dread Knight">
<script>
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-2840181-3']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</head>
<body>
<header>
<table style="width: 98%; font-size:18px; margin:2px; padding:0px;" class="center"><tr>
<td style="height: 175px; width: 175px;"><a href="/"><img src="/images/Freezing_Moon.png" title="Open Source Game Development"></a></td>
<?php $menu = array("projects", "team", "shop", "tutorials", "contact");
$the_style = "<td class='center' style='width: 126px; background-image: url(/images/button.png); background-position: center; background-repeat: no-repeat;'>";
foreach ($menu as $menuItem)
	echo "$the_style<a href='/$menuItem'><div><img src='/images/$menuItem.png'><br><b>" . ucfirst($menuItem) . "</b></div></a></td>";
?>
</nav></tr></table>
</header>
<!--main area-->
<div id="wrapper">
