<?php
require_once("../global.php");
$page_title = "Freezing Moon - About";
include("../header.php");
echo $start_div; ?>
<p><strong>Freezing Moon</strong> is a <strong>foundation</strong> (aka <strong>N</strong>on-<strong>P</strong>rofit <strong>O</strong>rganization), started around the fall of <strong>2007</strong> by
<strong>Valentin Anastase</strong>, a cg artist known around various parts of the Internet as <strong><a href="http://www.DreadKnight666.com" target="_blank" title="If you're 5 5 5... then I'm 6 6 6!"><img src="DreadKnight.png">Dread Knight</a></strong>.
</p>

<p>
His vision is to create an <strong>art &amp; gaming oriented community</strong> that will <strong>develop open projects</strong> over the internet, projects such as <strong>games</strong> and <strong>cinematics</strong>, by making good usage of <strong>free open source cross platform software</strong> in the development pipeline.
</p>

<p>
Secondary goals are to <strong>provide with training material</strong>, helping enthusiasts get better glimpse of the pipeline tools in order to achieve similar results to different elements from the open projects and therefore spread the use of <strong>free open source software</strong>, as well as to <strong>improve the pipeline tools</strong>.
</p>

<p>
Inspiration for the name of the NPO came from the song by the black-metal band called <a href="http://www.youtube.com/watch?v=58o17dnB6hk" target="_blank" title="Everything here is so cold Everything here is so dark I remember it as from a dream... \m/"><b>Mayhem</b></a>.
</p>

<?php
echo $end_div;
//loop the array with users to show up
include('../account/profile.php');
$profile_id = 1;
$staff = array('1','4','2','5');
foreach ($staff as $profile_id) {
	display_profile($profile_id, $start_div, $end_div);
}
echo $the_end;
?>
