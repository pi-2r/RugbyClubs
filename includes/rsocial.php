<?php
$url = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
?>
<a href="http://www.facebook.com/sharer.php?u=<?php echo $url ?>" target="_blank"><img src="css/images/facebook.png" border=0 alt="Facebook" title="Partager sur Facebook"></a>
					<a href="http://twitthis.com/twit?url=<?php echo $url ?>" target="_blank"><img src="css/images/twitter.png" border=0 alt="Twitter" title="Partager sur Twitter"></a>
					<a href="http://www.wikio.fr/vote?url=<?php echo $url ?>" target="_blank"><img src="css/images/wikio.png" border=0 alt="Wikio" title="Partager sur Wikio"></a>
					<a href="http://digg.com/submit?phase=2&url=<?php echo $url ?>" target="_blank"><img src="css/images/digg.png" border=0 alt="Digg" title="Partager sur Digg"></a>
					<a href="http://www.scoopeo.com/scoop/new?newurl=<?php echo $url ?>" target="_blank"><img src="css/images/scoopeo.png" border=0 alt="Scoopeo" title="Partager sur Scoopeo"></a>
					<a href="http://technorati.com/faves?add=<?php echo $url ?>" target="_blank"><img src="css/images/technorati.png" border=0 alt="Technorati" title="Partager sur Technorati"></a>
					<a href="http://www.myspace.com/Modules/PostTo/Pages/?c=<?php echo $url ?>" target="_blank"><img src="css/images/myspace.png" border=0 alt="myspace" title="Partager sur myspace"></a>
