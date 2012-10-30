<div id="content">
<fieldset>
	<legend>Quel type de visiteur êtes vous ?</legend>
	<br />
	<center>
		<table>
			<tr>
				<td><div id="club" onClick="window.location.assign('index.php?p=inscription_club')" style="margin-right:30px" class="boutton">Un club</div></td>
				<td><div onClick="ToogleVisiBox('details');ToogleVisiBox('club');ToogleVisiBox('sup')" style="margin-right:30px" class="boutton">Un pratiquant</div></td>
				<td><div id="sup" onClick="window.location.assign('index.php?p=inscription_sup')" class="boutton">Un supporter</div></td>
			</tr>
			</table>
			<br /><br />
			<table>
			<tr id="details" style="visibility:hidden;">
				<td><div onClick="window.location.assign('index.php?p=inscription_joueur')" style="margin-right:30px" class="boutton">Joueur</div></td>
				<td><div onClick="window.location.assign('index.php?p=inscription_kine')" style="margin-right:30px" class="boutton">Kiné</div></td>
				<td><div onClick="window.location.assign('index.php?p=inscription_osteo')" style="margin-right:30px" class="boutton">Ostéo</div></td>
				<td><div onClick="window.location.assign('index.php?p=inscription_nutri')" style="margin-right:30px" class="boutton">Nutritioniste</div></td>
		</table>
	<br /><br />
</fieldset>
</div>
