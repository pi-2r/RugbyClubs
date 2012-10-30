<?php
include 'classes/phpmailer/class.phpmailer.php';
if ($_POST['poster'] == 'true')
{
	$civilite = $_POST['civilite'];
	$nom = $_POST['nompre'];
	$prenom = $_POST['prenompre'];
	$mail = $_POST['adresse'];
	$sujet = $_POST['sujet'];
	$message = $_POST['message'];

	$sujet = "[KAAPSTAD] $civilite $nom $prenom - $sujet";
	$message = "Adresse de réponse: $mail<br /><br /><br />".$message;

	// ENVOI DU MAIL
	$mail = new PHPMailer();
	$mail->AddAddress('contact@kaapstad.fr', 'contact@kaapstad.fr');
	$mail->IsSMTP();
	$mail->IsHTML(true);
	$mail->Host = "localhost";
	//$mail->Host = "smtp.free.fr";
	$mail->From = 'noreply@kaapstad.fr';
	$mail->FromName = 'Kaapstad';
	$mail->Subject = $sujet;
	$mail->Body = $message;
	if($mail->Send())
		echo '<center>Votre message a bien été envoyé. Nous vous répondrons dans les plus bref délais<br /><br /><a href="index.php">Retour</a></center>';
	else
		echo 'Désolé, une erreur s\'est produite pendant l\'envoi du message. Veuillez réessayer.<br ><br ><a href="index.php?p=contact">Retour</a>';
	$mail->SmtpClose();
}
else
{
?>
<script src="js/validation.js" type="text/javascript"></script>

<fieldset>
	<legend>Nous contacter par Internet</legend>
	<form id="contact" action="index.php?p=contact" method="POST">
<table style="float: left">
	<tr>
		<td>Civilité<font color="red">*</font></td>
		<td>
			<select class="required validate-one" id="civilite" name="civilite">
				<option value="">Choisissez</option>
				<option value="Madame">Madame</option>
				<option value="Mademoiselle">Mademoiselle</option>
				<option value="Monsieur">Monsieur</option>
			</select>
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>Nom<font color="red">*</font></td>
		<td><input class="required validate-alpha" id="nompre" name="nompre" type="text" /></td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>Prénom<font color="red">*</font></td>
		<td><input class="required validate-alpha" id="prenompre" name="prenompre" type="text" /></td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>Adresse e-mail<font color="red">*</font></td>
		<td><input class="required validate-email" id="adresse" name="adresse" type="text" value="" /></td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
			<td>Sujet<font color="red">*</font></td>
		<td>
			<select name="sujet" class="required validate-one">
				<option value="">Choisissez</option>
				<option value="Offre d'emploi'">Offre d'emploi</option>
				<option value="Joueur de rugby">Joueur de rugby</option>
				<option value="Club de rugby">Club de rugby</option>
				<option value="Commercial">Commercial</option>
				<option value="Fournisseurs">Fournisseurs</option>
				<option value="Autres">Autres</option>
			</select>
		</td>
	</tr>

</table>
<table style="float:right">
	<tr>
		<td>
			<center>Votre message<font color="red">*</font></center>
			<textarea name="message" class="required" rows="15" cols="60"></textarea>
		</td>
	</tr>
</table>
<div class="clear">
<input type="hidden" name="poster" value="true" />
<center><input type="image" src="images/env.png" /></center>
</form>
<script type="text/javascript">
  new Validation('contact', {immediate : true});
</script>
</fieldset>
<fieldset>
	<legend>Nos coordonées</legend>
	<div style="float:left;">
		<table width="700px">
			<tr><td width="40%">
		<img src="images/tel.png" alt="Fixe"> <strong>Tél</strong> : 05 87 01 15 78
		<br />
		<img src="images/tel.png" alt="Mobile"> <strong>Port</strong> : 06 01 99 72 70
		<br />
		<img src="images/skype.png" alt="Skype"> <strong>Skype</strong> : kaapstad.rh
		<br /><br />
		<img src="images/enveloppe.png" title="Courrier"> <strong>Adresse</strong> : Kaapstad
		<br /><span style="margin-left: 76px">18 rue Barbecane</span>
		<br/><span style="margin-left: 76px">19100 Brive la Gaillarde</span>
		</td><td>Pour toutes demandes de renseignement, vous pouvez nous contacter par le formulaire ci-dessus, par téléphone ou par voie postale. Nous vous répondrons dans les plus bref délais.
		</td></tr></table>
	</div>

	<img style="float:right" src="images/contact.png" alt="Contacter nous!" />
</fieldset>
<?php
}
