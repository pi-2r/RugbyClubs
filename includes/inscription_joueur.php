<script src="js/validation.js" type="text/javascript"></script>

<a href="index.php?p=inscription" title="Retour au menu"><img src="images/retour.png" alt="Retour" /> Retour au menu d'inscription</a>
<form id="inscriptionjoueur" method="POST" action="index.php?p=inscription_joueur_valider">
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
			<td>Téléphone<font color="red">*</font></td>
			<td><input class="required validate-digits" name="tel" id="tel" type="text" /></td>
		</tr>
		<tr>
			<td>E-mail<font color="red">*</font></td>
			<td><input class="required validate-email" id="mail" name="mail" type="text" value="" /></td>
		</tr>
		<tr>
			<td>Confirmer E-mail<font color="red">*</font></td>
			<td><input class="required validate-mail-same" id="mailconfirm" name="mailconfirm" type="text" value="" /></td>
		</tr>
		<tr>
			<td>Date de naissance<font color="red">*</font></td>
			<td><input class="required validate-date-au" type="text" id="ddn" name="ddn" value="JJ/MM/AAAA" /></td>
		</tr>
		<tr>
			<td>Nationalité</td>
			<td>
				<?php
					liste_nationalite();
				?>
			</td>
		</tr>
		<tr>
			<td>Status matrimonial</td>
			<td>
				<select name="smat" id="smat">
					<option>Choisissez</option>
					<option value="c">Célibataire</option>
					<option value="ec">En couple</option>
					<option value="m">Marié(e)</option>
					<option value="d">Divorcé(e)</option>
					<option value="v">Veuf/Veuve</option>
				</select>
			</td>
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
<fieldset class="bgjaune">
	<legend>Informations sportives</legend>
	<table style="float: left;">
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td>Club actuel</td>
			<td><input class="validate-nomclub" type="text" onKeyUp="if(this.value==''){document.getElementById('seekclub').style.display='none'}else{Updatejs('seekclub', 'ajax/seekclub.php?nom='+this.value)}" id="nomclub" name="nomclub" value="" /></td>
		</tr>
		<tr>
			<td>Niveau actuel<font color="red">*</font></td>
			<td>
				<?php liste_niveau(); ?>
			</td>
		</tr>
		<tr>
			<td>Votre meilleur niveau<font color="red">*</font></td>
			<td>
				<?php
				$res = mysql_query("SELECT * FROM `niveau`");
				$premier='Choisissez';
	?>
	<select onChange="<?php echo $onchange; ?>"class="required validate-selection" id="mniveau" name="mniveau">
		<option><?php echo $premier; ?></option>
		<?php
			while ($data = mysql_fetch_array($res))
				if ($select == $data['id_niv'] && !empty($select))
					echo '<option selected=selected value="'.$data['id_niv'].'">'.$data['lib_niv'].'</option>';
				else
					echo '<option value="'.$data['id_niv'].'">'.$data['lib_niv'].'</option>';
		?>
	</select>
			</td>
		</tr>
		<tr>
			<td>Spécialité</td>
			<td>
				<?php liste_specialite(); ?>
			</td>
		</tr>
		<tr>
			<td>Taille (cm)<font color="red">*</font></td>
			<td><input class="required validate-digits" type="text" name="taille" id="taille" /></td>
		</tr>
		<tr>
			<td>Poid (kg)<font color="red">*</font></td>
			<td><input class="required validate-digits" type="text" name="poid" id="poid" /></td>
		</tr>
	</table>
	<div class="bgbleu" style="position: absolute; left: 25px; top: 50px; height: 300px;" id="seekclub2"></div>
	<div class="bgbleu" style="position: absolute; right: 25px; top: 450px; height: 280px;" id="seekclub"></div>
	<table style="float: right;">
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td>Poste préféré<font color="red">*</font></td>
			<td>
				<?php liste_poste(); ?>
			</td>
		</tr>
		<tr>
			<td colspan="2"><u>Poste secondaire ( 2 choix maximum )</u></td>
		</tr>
		<tr valign="top">
			<td>
				<?php
					$res = $sql->lire('poste', "1 ORDER BY `id` LIMIT 0,6", FALSE);
					while ($data = mysql_fetch_array($res))
						echo "<input type=\"checkbox\" name=\"postes[]\" />$data[poste] <br />";
				?>
			</td>
			<td>
				<?php
					$res = $sql->lire('poste', "1 ORDER BY `id` LIMIT 6,11", FALSE);
					while ($data = mysql_fetch_array($res))
						echo "<input type=\"checkbox\" name=\"postes[]\" />$data[poste] <br />";
				?>
			</td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
	</table>
</fieldset>
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
