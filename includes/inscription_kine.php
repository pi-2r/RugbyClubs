<script src="js/validation.js" type="text/javascript"></script>

<a href="index.php?p=inscription" title="Retour au menu"><img src="images/retour.png" alt="Retour" /> Retour au menu d'inscription</a>
<form id="inscriptionkine" method="POST" action="index.php?p=inscription_kine_valider">
<fieldset class="bgbleu">
	<legend>Informations personnelles</legend>
	<table style="float: left">
		<tr>
			<td>Civilité<font color="red">*</font></td>
			<td>
				<select class="required validate-one" id="civilite" name="civilite">
					<option>Choisissez</option>
					<option value="f">Madame</option>
					<option value="v">Mademoiselle</option>
					<option value="h">Monsieur</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Nom<font color="red">*</font></td>
			<td><input class="required validate-alpha" id="nompre" name="nompre" type="text" /></td>
		</tr>
		<tr>
			<td>Prénom<font color="red">*</font></td>
			<td><input class="required validate-alpha" id="prenompre" name="prenompre" type="text" /></td>
		</tr>
		<tr>
			<td>Adresse<font color="red">*</font></td>
			<td><input class="required" id="adresse" name="adresse" type="text" value="" /></td>
		</tr>
		<tr>
			<td>Code postal<font color="red">*</font></td>
			<td><input class="required validate-digits" autocomplete="off" onkeyup="Updatejs('contentjs', 'ajax/villes.php?ville='+this.value)" type="text" name="cp" id="cp" value="<?php echo $ville['id']; ?>" />
			</td>
		</tr>
		<tr>
			<td>Ville<font color="red">*</font></td>
			<td><div id="contentjs"></div>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td>Pseudonyme<font color="red">*</font></td>
			<td><input class="required validate-alphanum" type="text" name="pseudo" id="pseudo" value="" /></td>
		</tr>
		<tr>
			<td>Mot de passe<font color="red">*</font></td>
			<td><input class="required" id="password" name="password" type="password" />
		</tr>
		<tr>
			<td>Confirmation<font color="red">*</font></td>
			<td><input class="required validate-password" id="password2" name="password2" type="password" />
		</tr>
	</table>
	<table style="float:right;">
		<tr>
			<td>E-mail<font color="red">*</font></td>
			<td><input class="required validate-email" id="mail" name="mail" type="text" value="" /></td>
		</tr>
		<tr>
			<td>Confirmer E-mail<font color="red">*</font></td>
			<td><input class="required validate-mail-same" id="mailconfirm" name="mailconfirm" type="text" value="" /></td>
		</tr>
		<tr>
			<td>Téléphone<font color="red">*</font></td>
			<td><input class="required validate-digits" name="tel" id="tel" type="text" /></td>
		</tr>
		<tr>
			<td>Date de naissance<font color="red">*</font></td>
			<td><input class="required validate-date-au" type="text" id="ddn" name="ddn" value="JJ/MM/AAAA" /></td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td>Votre club favori (TOP14)</td>
			<td><input class="validate-nomclub" onKeyUp="if(this.value==''){document.getElementById('seekclub2').style.display='none'}else{Updatejs('seekclub2', 'ajax/seekclubtopfav.php?nom='+this.value)}" type="text" name="clubfavtop" id="clubfavtop" /></td>
		</tr>
		<tr>
			<td>Votre club favori (local)</td>
			<td><input class="validate-nomclub" onKeyUp="if(this.value==''){document.getElementById('seekclub2').style.display='none'}else{Updatejs('seekclub2', 'ajax/seekclublocalfav.php?nom='+this.value)}" type="text" name="clubfav" id="clubfav" /></td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td>Votre photo</td>
			<td><input type="file" name="photo" id="photo" />
		</tr>
	</table>
</fieldset>
<div class="bgbleu" style="position: absolute; left: 25px; top: 50px; height: 300px;" id="seekclub2"></div>
<br />
<div style="padding-left: 30px;">
<input name="offreco" value="1" type="checkbox" /> J'accepte de recevoir des offres commerciales de la part de Kaapstad et ses partenaires.<br />
<input class="required" type="checkbox" /> J'accepte les <a href="#">conditions générales d'utilisation</a>.
</div>
<br />
<input type="hidden" id="idville" name="idville" value="" />
<center>
	<input type="image" src="images/ins.png" value="S'inscrire !" />
</center>
</form>
