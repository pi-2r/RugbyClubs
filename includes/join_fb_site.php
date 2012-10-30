<?php
echo $_SESSION['auth'];
	if ($_SESSION['auth'] != true)
	{
		if ($_GET['logplz'] == 'true')
		{
		?>
		<form id="formco" action="connexion.php" method="POST">
		<center>
		<font color="red">Vous n'avez pas encore associé votre compte facebook à un compte Kaapstad. Connectez vous avec vos identifiants habituels Kaapstad.</font><br /><b>Si vous ne disposez pas de compte Kaapstad, <a href="index.php?p=inscription" title="Créer un compte">créer en un</a>!
		<table>
			<tr>
				<td><label>Votre E-mail</label></td>
				<td><input type="text" name="login" id="login" /></td>
			</tr><tr>
				<td><label>Mot de passe : </label></td>
				<td><input type="password" name="password" id="password" /></td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td align="center" colspan="2"><div onClick="document.getElementById('formco').submit()" style="margin-right:30px" class="boutton">Connexion</div></td>
			</tr>
		</table>
		</center>
		<input type="hidden" name="joinfb" value="true" />
		</form>
		<?php
		}
		else
		{
			?>
			<center>
				<font color="red"><b>Possèdez vous un compte Kaapstad ?</b></font>
				<br /><br />
				<div onClick="window.location.assign('index.php?p=join_fb_site&logplz=true')" style="margin-right:30px" class="boutton">Oui</div> <div onClick="window.location.assign('index.php?p=inscription')" style="margin-right:30px" class="boutton">Non</div>
			</center>
			<?php
		}
	}
?>
