<?php include('secusql/exec.php'); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

	<head>
		<title>Kaapstad Maps</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
		<!-- Elément Google Maps indiquant que la carte doit être affiché en plein écran et
		qu'elle ne peut pas être redimensionnée par l'utilisateur -->
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<!-- Inclusion de l'API Google MAPS -->
		<!-- Le paramètre "sensor" indique si cette application utilise détecteur pour déterminer la position de l'utilisateur -->
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=fr"></script>
		<script src="js/prototype.js" type="text/javascript"></script>
		<script src="js/scriptaculous.js" type="text/javascript"></script>
		<script src="js/function.js" type="text/javascript"></script>
		<link rel="stylesheet" href="css/template.css" media="screen" type="text/css"/>
		<link rel="stylesheet" href="css/main.css" media="screen" type="text/css"/>
		<script type="text/javascript">
		//variable globale
infowindow = null;

function createXmlHttpRequest() {
	try {
		if (typeof ActiveXObject != 'undefined') {
			return new ActiveXObject('Microsoft.XMLHTTP');
		} else if (window["XMLHttpRequest"]) {
			return new XMLHttpRequest();
		}
	} catch (e) {
		changeStatus(e);
	}
	return null;
};

function downloadUrl(url, callback) {
	var status = -1;
	var request = createXmlHttpRequest();
	if (!request) {
		return false;
	}

	request.onreadystatechange = function() {
		if (request.readyState == 4) {
			try {
				status = request.status;
			} catch (e) {
			}
			if (status == 200) {
				callback(request.responseText, request.status);
				request.onreadystatechange = function() {};
			}
		}
	}
	request.open('GET', url, true);
	try {
		request.send(null);
	} catch (e) {
		changeStatus(e);
	}
};

function xmlParse(str) {
  if (typeof ActiveXObject != 'undefined' && typeof GetObject != 'undefined') {
    var doc = new ActiveXObject('Microsoft.XMLDOM');
    doc.loadXML(str);
    return doc;
  }

  if (typeof DOMParser != 'undefined') {
    return (new DOMParser()).parseFromString(str, 'text/xml');
  }

  return createElement('div', null);
}

			function initialiser() {
				var latlng = new google.maps.LatLng(46.779231, 6.659431);

				//objet contenant des propriétés avec des identificateurs prédéfinis dans Google Maps permettant
				//de définir des options d'affichage de notre carte
				var options = {
					center: latlng,
					zoom: 3,
					minZoom: 3,
					zoomControl: true,
					panControl: true,
					panControlOptions: {
						position: google.maps.ControlPosition.TOP_RIGHT
					},
					mapTypeId: google.maps.MapTypeId.TERRAIN,
					disableDefaultUI: true
				};

				//constructeur de la carte qui prend en paramêtre le conteneur HTML
				//dans lequel la carte doit s'afficher et les options
				carte = new google.maps.Map(document.getElementById("carte"), options);

				downloadUrl("getPoi.php", function(data) {

					var xml = xmlParse(data);
					var markers = xml.documentElement.getElementsByTagName("marker");

					for (var i = 0; i < markers.length; i++) {
						createMarker(parseFloat(markers[i].getAttribute("lat")), parseFloat(markers[i].getAttribute("lng")), markers[i].getAttribute('titre'), markers[i].getAttribute('ville'), markers[i].getAttribute('couleur'),  markers[i].getAttribute('zoomAff'),  markers[i].getAttribute('idd'));
					}
				});
				downloadUrl("getPoi2.php", function(data) {

					var xml = xmlParse(data);
					var markers = xml.documentElement.getElementsByTagName("marker");

					for (var i = 0; i < markers.length; i++) {
						createfede(parseFloat(markers[i].getAttribute("lat")), parseFloat(markers[i].getAttribute("lng")), markers[i].getAttribute('titre'), markers[i].getAttribute('zoomAff'),  markers[i].getAttribute('idd'));
					}
				});


/*
				createMarker('45.162356', '1.549416', 'C A BRIVE CORREZE', 'Brive', 'noir-blanc');
				createMarker('43.6129', '1.436205', 'Stade Toulousain Rugby', 'Toulouse', 'rouge-noir');
				createMarker('47.6728832', '-2.9826306', 'R AURAY C', 'Auray', 'gris');
				createMarker('0', '0', ' A C AUBIGNY ', 'AUBIGNY SUR NERE', 'gris');
*/

				nordMAX = '67'; //Noth
				nordMIN = '42'; //South
				ouestMAX = '26'; //West
				ouestMIN = '0'; //East

			}


			function createMarker(lat, lng, titre, ville, couleur, zoomAff, idd){
						positionclub = new google.maps.LatLng(lat, lng);

					var marker = new google.maps.Marker({
						position: positionclub,
						map: carte,
						visible: false,
						icon: 'images/drapeaux/'+couleur+'.png'
					});
					google.maps.event.addListener(marker, 'click', function() {
						Effect.Grow('details');
						Updatejs('content','ajax/info_club.php?id='+idd);
					});
					google.maps.event.addListener(marker, 'mouseover', function() {
						if (infowindow)
						infowindow.close();
						infowindow = new google.maps.InfoWindow();
						infowindow.setContent(titre+'<br /><br /><center><font color="gray" size="1.1em"><i>Cliquez pour consulter le profil du club</i></font></center>');
						infowindow.open(carte,marker);
					});
					google.maps.event.addListener(marker, 'mouseout', function() {
						infowindow.close();
					});
					zoom = carte.getZoom();
					if (zoom >= zoomAff)
							marker.setVisible(true);
					google.maps.event.addListener(carte, 'zoom_changed', function() {
						zoom = carte.getZoom();
						if (zoom >= zoomAff)
							marker.setVisible(true);
						else
							marker.setVisible(false);
					});


			}
			function createfede(lat, lng, titre, zoomAff, idd){
						positionclub = new google.maps.LatLng(lat, lng);

					var marker = new google.maps.Marker({
						position: positionclub,
						map: carte,
						visible: false,
						icon: 'fedeimg.php?id='+idd
					});
					google.maps.event.addListener(marker, 'click', function() {
						Effect.Grow('details');
						Updatejs('content','ajax/info_fede.php?id='+idd);
					});
					google.maps.event.addListener(marker, 'mouseover', function() {
						if (infowindow)
						infowindow.close();
						infowindow = new google.maps.InfoWindow();
						infowindow.setContent(titre+'<br /><br /><center><font color="gray" size="1.1em"><i>Cliquez pour consulter le profil du club</i></font></center>');
						infowindow.open(carte,marker);
					});
					google.maps.event.addListener(marker, 'mouseout', function() {
						infowindow.close();
					});
					zoom = carte.getZoom();
					if (zoom = zoomAff)
							marker.setVisible(true);
					google.maps.event.addListener(carte, 'zoom_changed', function() {
						zoom = carte.getZoom();
						if (zoom < 5)
							marker.setVisible(true);
						else
							marker.setVisible(false);
					});


			}
		</script>
	</head>

	<body onload="initialiser();">


		<br />

		<div id="carte" style="width:99%; height:690px;border: 1px solid #c42835;"></div>
		<div id="fede" style="position: absolute;bottom: 560px;left: 0px;">
			<div onClick="carte.setZoom(3)" style="margin: 10px;bomargin-right:30px;font-size:0.8em;" class="boutton-guide">Fédérations</div>
		</div>
		</div>
		<div id="1erediv" style="position: absolute;bottom: 500px;left: 0px;">
			<div onClick="carte.setZoom(5)" style="margin: 10px;bomargin-right:30px;font-size:0.8em;" class="boutton-guide">1ère Division</div>
		</div>
		<div id="tous" style="position: absolute;bottom: 470px;left: 0px;">
			<div onClick="carte.setZoom(6)" style="margin: 10px;bomargin-right:30px;font-size:0.8em;" class="boutton-guide">Tous les clubs</div>
		</div>
		<div style="position: absolute;bottom: 141px;background: #c42835;border:2px solid #c42835;left: 1px; width: 231px;border-radius: 0 15px 15px 0px;  margin: 0px auto;">
			<legend style="cursor:pointer" onClick="document.getElementById('searchbox').focus();ToogleBox('seekclub');"><font color="gray">Rechercher un club</font></legend>
<input id="searchbox" onKeyUp="if (this.value==''){document.getElementById('seekclub').style.display='none'}else{Updatejs('seekclub', 'ajax/seekclub_guide.php?nom='+this.value)};" onClick="this.value='';ToogleBox('seekclub');" style="width:230px;border:none;" type="text" value="Tapez le nom du club recherché..." />
			<br /><br />
			<div style="display:none; height:492px;width:230px;" align="center" id="seekclub"></div>
		</div>
		<div style="display:none; position: absolute; top:19px; left: 1; width:99%; height:690px; background:rgba(0,0,0,0.85);color:white;" id="details">
		<div style="float:left;"><iframe style="float:left;padding-top: 15px;padding-left:30px;" src="http://www.facebook.com/plugins/like.php?href=www.kaapstad.fr&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=recommend&amp;colorscheme=light&amp;font=arial&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe>
	<iframe style="float:left; padding-top: 15px;" allowtransparency="true" frameborder="0" scrolling="no"
src="http://platform.twitter.com/widgets/tweet_button.html?url=www.kaapstad.fr"
style="width:130px; height:50px;"></iframe></div>
	<div style="float:right">
		<div onClick="Effect.SlideUp('details');" style="margin: 10px;bomargin-right:30px;font-size:0.8em;" class="boutton">Revenir à la carte</div>
	</div>
	<div id="content"></div>
	</div>
	<div style="border-radius:20px;position:absolute; left: 300px;top:100px; background:rgba(0,0,0,0.85);color:white; width:50%;padding:10px;" id="ccm">
		<?php
			$texte = $sql->requete("SELECT valeur FROM `config` WHERE id='texteccm'");
			echo $texte['valeur'];
		?>
	<div onClick="document.getElementById('ccm').style.display='none';carte.setZoom(4)"style="margin: 10px;margin-right:30px;font-size:0.8em;margin:0 auto;" class="boutton">Naviguer sur la carte</div>
	</div>

	<center><a onClick="window.top.location='index.php?p=contact'" href="#"><img width="10px" src="images/erreur.png" alt="Erreur?" /> <b>Une erreur s'est glisée sur la carte? Contactez nous.</b></a>
	</body>
</html>
