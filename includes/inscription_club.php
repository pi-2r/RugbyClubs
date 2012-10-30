<script src="js/validation.js" type="text/javascript"></script>

<a href="index.php?p=inscription" title="Retour au menu"><img src="images/retour.png" alt="Retour" /> Retour au menu d'inscription</a>
<form id="inscriptionclub" method="POST" action="index.php?p=inscription_club_valider">
<fieldset class="bgbleu">
	<legend>Informations du club</legend>
		<table style="float: left;">
			<tr>
				<td>Votre comité<font color="red">*</font> : </td>
				<td><?php liste_comite(); ?></td>
			</tr>
			<tr>
				<td>Nom du club<font color="red">*</font></td>
				<td><input class="required validate-nomclub" type="text" onKeyUp="if (this.value==''){document.getElementById('seekclub').style.display='none'}else{Updatejs('seekclub', 'ajax/seekclub.php?nom='+this.value)}" id="nomclub" name="nomclub" value="" /></td>
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
			<tr>
				<td>Numéro d'affilié</td>
				<td><input id="numero" name="numero" type="text" /></td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td>Mot de passe<font color="red">*</font></td>
				<td><input class="required" id="password" name="password" type="password" />
			</tr>
			<tr>
				<td>Confirmation<font color="red">*</font></td>
				<td><input class="required validate-password" id="password2" name="password2" type="password" />
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td>Votre Logo<font color="red">*</font></td>
				<td>
					<input class="required" type="file" id="logo" name="logo" />
				</td>
			</tr>
		</table>
		<table style="float: right;">
			<tr>
				<td>Téléphone<font color="red">*</font></td>
				<td><input class="required validate-digits" name="tel" id="tel" type="text" /></td>
			</tr>
			<tr>
				<td>Fax</td>
				<td><input class="validate-digits" name="fax" id="tel" type="text" /></td>
			</tr>
			<tr>
				<td>Site Internet</td>
				<td><input class="validate-url" id="site" name="site" type="text" value="" /></td>
			</tr>
			<tr>
				<td>E-mail<font color="red">*</font></td>
				<td><input class="required validate-email" id="mail" name="mail" type="text" value="" /></td>
			</tr>
			<tr>
				<td>Confirmer E-mail<font color="red">*</font></td>
				<td><input class="required validate-mail-same" id="mailconfirm" name="mailconfirm" type="text" value="" /></td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td>Couleur principale<font color="red">*</font></td>
				<td>
					<select class="required validate-selection" id="couleur1"  name="couleur1">
						<option>Choisissez</option>
						<option value="black">Noir</option>
						<option value="white">Blanc</option>
						<option value="green">Vert</option>
						<option value="red">Rouge</option>
						<option value="blue">Bleu</option>
						<option value="yellow">Jaune</option>
						<option value="orange">Orange</option>
						<option value="purple">Violet</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Couleur secondaire<font color="red">*</font></td>
				<td>
					<select class="required validate-selection" id="couleur2" name="couleur2">
						<option>Choisissez</option>
						<option value="black">Noir</option>
						<option value="white">Blanc</option>
						<option value="green">Vert</option>
						<option value="red">Rouge</option>
						<option value="blue">Bleu</option>
						<option value="yellow">Jaune</option>
						<option value="orange">Orange</option>
						<option value="purple">Violet</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Niveau<font color="red">*</font></td>
				<td>
					<?php liste_niveau(); ?>
				</td>
			</tr>


		</table>
		<div class="bgbleu" style="position: absolute; right: 25px; top: 50px; height: 300px;" id="seekclub"></div>
		</div>
</fieldset>
<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
	<td>
		<fieldset class="bgrouge">
	<legend>Président</legend>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<td>Nom<font color="red">*</font></td>
			<td><input class="required validate-alpha" id="nompre" name="nompre" type="text" /></td>
		</tr>
		<tr>
			<td>Prénom<font color="red">*</font></td>
			<td><input class="required validate-alpha" id="prenompre" name="prenompre" type="text" /></td>
		</tr>
		<tr>
			<td>E-mail<font color="red">*</font></td>
			<td><input class="required validate-mail" id="mailpre" name="mailpre" type="text" /></td>
		</tr>
		<tr>
			<td>Téléphone<font color="red">*</font></td>
			<td><input class="required validate-digits" id="telpre" name="telpre" type="text" /></td>
		</tr>
	</table>
	<center><input onClick="ToogleVisiBox('contact')" type="checkbox" />&nbsp;&nbsp;Le contact est différent du président.</center>
		</fieldset>
	</td>
	<td>
		<fieldset style="visibility:hidden;" class="bgvert" id="contact">
	<legend>Contact</legend>
		<table cellpadding="0" cellspacing="0">
		<tr>
			<td>Nom</td>
			<td><input class="validate-alpha" id="nomcon" name="nomcon" type="text" /></td>
		</tr>
		<tr>
			<td>Prénom</td>
			<td><input class="validate-alpha" id="prenomcon" name="prenomcon" type="text" /></td>
		</tr>
		<tr>
			<td>E-mail</td>
			<td><input class="validate-mail" id="mailcon" name="mailcon" type="text" /></td>
		</tr>
		<tr>
			<td>Téléphone</td>
			<td><input class="validate-digits" id="telcon" name="telcon" type="text" /></td>
		</tr>
	</table>
	<br />
		</fieldset>
	</td>
	<td>
		<fieldset class="bgjaune">
	<legend>Coach</legend>
		<table cellpadding="0" cellspacing="0">
		<tr>
			<td>Nom</td>
			<td><input class="validate-alpha" id="nomcoa" name="nomcoa" type="text" /></td>
		</tr>
		<tr>
			<td>Prénom</td>
			<td><input class="validate-alpha" id="prenomcoa" name="prenomcoa" type="text" /></td>
		</tr>
		<tr>
			<td>E-mail</td>
			<td><input class="validate-mail" id="mailcoa" name="mailcoa" type="text" /></td>
		</tr>
		<tr>
			<td>Téléphone</td>
			<td><input class="validate-digits" id="telcoa" name="telcoa" type="text" /></td>
		</tr>
	</table>
	<br />
		</fieldset>
	</td>
</tr>
</table>

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
<script type="text/javascript">
  Validation.add('validate-nomclub', 'Ce club n\'existe pas', function(){
		value = document.getElementById('nomclub').value;
		reponse = file('ajax/checkclub.php?club='+value);
		if (reponse == 'ok')
			return true;
		else
			return false;
	  });
  new Validation('inscriptionclub', {immediate : true});
</script>
